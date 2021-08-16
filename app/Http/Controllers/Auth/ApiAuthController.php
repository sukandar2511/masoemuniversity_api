<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name'      => 'required|string|max:255',
        //     'email'     => 'required|string|email|max:255|unique:users',
        //     'password'  => 'required|string|min:6|confirmed',
        //     'nik'       => 'required',
        // ]);

        // if ($validator->fails()) {
        //     $returnData = array(
        //         "status" => "not found",
        //         "code" => "404",
        //         "data" => [
        //             "message" => "Daftar gagal",
        //             "error" => [
        //                 "email"     => "Email harus di isi",
        //                 "password"  => "Password harus di isi"
        //             ]
        //         ]
        //     );
        //     return response($returnData, 404);
        // }

        $request['password']            = Hash::make($request['password']);
        $request['remember_token']      = Str::random(10);
        $request['activation_token']    = Str::random(60);
        $user = User::create($request->toArray());
        $user->notify(new SignupActivate($user));
        // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        // $user->sendEmailVerificationNotification();
        // $response = ['token' => $token];
        $returnData = array(
            "status"    => "sukses",
            "code"      => "201",
            "data" => [
                "message"           => "Data berhasil terdaftar",
                "activation_token"  => $request['activation_token']
            ]
        );
        return response($returnData, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|string|email|max:255',
            'password'      => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            $returnData = array(
                "status"=> "not found",
                "code"  => "404",
                "data"  => [
                    "message" => "Login gagal",
                    "error" => [
                        "email" => "Email harus di isi",
                        "password" => "Password harus di isi"
                    ]
                ]
            );
            return response($returnData, 404);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {

            $user_active = User::where('active', 1)->first();

            if (!$user_active) {
                return response()->json([
                    "status" => "not found",
                    "code" => "404",
                    "data" => [
                        "message" => 'Maaf akun anda belum aktif',
                        "email" => $request->email
                    ]
                ], 404);
            } else {
                if (Hash::check($request->password, $user->password)) {
                    $tokenResult    = $user->createToken('Laravel Password Grant Client');
                    $token          = $tokenResult->accessToken;
                    $response       = ['token' => $token];

                    $user->api_token         = $token;
                    $user->api_token_expires = $tokenResult->token->expires_at;
                    $user->save();

                    $returnData = array(
                        "status" => "ok",
                        "code" => "200",
                        "data" => [
                            "message" => "Login berhasil",
                            "access_token" => [
                                "name"          => $user['name'],
                                "email"         => $user['email'],
                                "token"         => $token,
                                "expired_time"  => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                            ]
                        ]
                    );
                    return response($returnData, 200);
                } else {
                    $returnData = array(
                        "status" => "not found",
                        "code" => "404",
                        "data" => [
                            "message" => "Login gagal",
                            "error" => [
                                "message" => "Email atau password tidak sesuai",
                            ]
                        ]
                    );
                    return response($returnData, 404);
                }
            }
        } else {
            // $response = ["message" =>'User does not exist'];
            $returnData = array(
                "status" => "not found",
                "code" => "404",
                "data" => [
                    "message" => "User tidak ditemukan",
                ]
            );
            return response($returnData, 404);
        }
    }
}
