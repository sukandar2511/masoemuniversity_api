<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrasiMail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{
    public function get_token($user)
    {
        $tokenResult                = $user->createToken('users');
        $token                      = $tokenResult->accessToken;
        $response                   = ['token' => $token];
        $user->api_token            = $token;
        $user->api_token_expires    = $tokenResult->token->expires_at;
        $user->save();
        return $tokenResult;
    }

    public function register(Request $request)
    {
        $cek = User::where('email', $request->email)->first();
        if (!$cek) {
            $request['password']            = Hash::make($request['password']);
            $request['remember_token']      = Str::random(10);
            $request['activation_token']    = Str::random(60);
            $request['level']               = "user";
            $user = User::create($request->toArray());
            Mail::to($user->email)->send(new RegistrasiMail($user));
            $returnData = array(
                "status"    => "sukses",
                "code"      => "201",
                "data"      => [
                    "message"   => "Data berhasil terdaftar",
                    "user_id"   => $this->encrypt($user->id)
                ]
            );
            return response()->json($returnData, 201);
        }else {
            $returnData = array(
                "status"    => "accepted",
                "code"      => "202",
                "data"      => [
                    "message" => "User sudah terdaftar"
                ]
            );
            return response()->json($returnData, 202);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->active == 0) {
                return response()->json([
                    "status" => "not found",
                    "code" => "404",
                    "data" => [
                        "message" => "Login gagal",
                        "error" => [
                            "message" => "Maaf akun anda belum aktif",
                        ]
                    ]
                ], 404);
            } else {
                if (Hash::check($request->password, $user->password)) {
                    $tokenResult = $this->get_token($user);
                    $returnData = array(
                        "status" => "ok",
                        "code" => "200",
                        "data" => [
                            "message" => "Login berhasil",
                            "session" => [
                                "name"          => $user['name'],
                                "email"         => $user['email'],
                                "token"         => $tokenResult->accessToken,
                                "level"         => $user['level'],
                                // "id_role"       => $user['id_role'],
                                "role"          => $user->role->role_name
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
                    return response()->json($returnData, 404);
                }
            }
        }else {
            $returnData = array(
                "status" => "not found",
                "code" => "404",
                "data" => [
                    "message" => "Login gagal",
                    "error" => [
                        "message" => "User tidak ditemukan",
                    ]
                ]
            );
            return response()->json($returnData, 404);
        }
    }

    public function verification($token)
    {
        $data       = User::where('activation_token', $token)->first();
        $date_now   = date('Y-m-d');

        if ($data) {
            $data->active = 1;
            $data->activation_token = NULL;
            $data->email_verified_at = Carbon::now();
            $this->verify($data);
            $tokenResult = $this->get_token($data);
            $returnData = array(
                "status" => "ok",
                "code" => "200",
                "data" => [
                    "message" => "Login berhasil",
                    "access_token" => [
                        "name"          => $data['name'],
                        "email"         => $data['email'],
                        "token"         => $tokenResult->accessToken,
                        "expired_time"  => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                    ]
                ]
            );
            return response()->json($returnData, 200);
        }
        $returnData = array(
            "status" => "not found",
            "code" => "404",
            "data" => [
                "message" => "User tidak ditemukan",
            ]
        );
        return response()->json($returnData, 404);
    }
    
    public function get_activation_token($id)
    {
        $user = User::findOrFail($this->dencrypt($id));
        if ($user) {
            $user->activation_token = Str::random(60);
            $user->remember_token = Str::random(10);
            $user->save();
            Mail::to($user->email)->send(new RegistrasiMail($user));
            $returnData = array(
                "status"    => "sukses",
                "code"      => "201",
                "data"      => [
                    "message"   => "token sudah di refresh",
                    "user_id"   => $this->encrypt($user->id)
                ]
            );
            return response()->json($returnData, 201);
        }
        $returnData = array(
            "status" => "not found",
            "code" => "404",
            "data" => [
                "message" => "User tidak ditemukan",
            ]
        );
        return response()->json($returnData, 404);
    }
    
    public function verify($data) 
    {
        $data->email_verified_at = Carbon::now()->timestamp;
        $data->save();
    }

    public function cek_session(Request $request)
    {
        $data = User::where('api_token', $request['token'])->first();
        $date_now   = date('Y-m-d');
        if ($data) {
            if (!$data->active == 1) {
                return response()->json([
                    "status" => "Unauthorized",
                    "code" => "401",
                    "data" => [
                        "message" => 'Maaf akun anda belum aktif',
                        "email" => $data->email
                    ]
                ], 401);
            } else {
                if ($data->api_token_expires >= $date_now) {
                    $returnData = array(
                        "status" => "sukses",
                        "code" => "200",
                        "data" => [
                            "id" => $data->id,
                            "name" => $data->name,
                            "email" => $data->email,
                            "level" => $data->level,
                            "api_token" => $data->api_token,
                            "expires_api_token" => $data->api_token_expires,
                        ]
                    );
                    return response($returnData, 200);
                }
            }
        }
        $returnData = array(
            "status" => "Unauthorized",
            "code" => "401",
            "data" => [
                "message" => "Token sudah expire",
            ]
        );
        return response($returnData, 401);
    }

    public function logout(Request $request)
    {
        $token      = $this->genereate_header_token($request);
        $user       = User::where('api_token', $token)->first();
        if ($user) {
            $token = $request->user()->token();
            $token->revoke();;
            $user->api_token = '';
            $user->save();
            $returnData = array(
                "status" => "sukses",
                "code" => "200",
                "data" => [
                    "message" => 'Akun sudah logout',
                ]
            );
            return response($returnData, 200);
        }else {
            $returnData = array(
                "status" => "not found",
                "code" => "404",
                "data" => [
                    "message" => 'Akun tidak ditemukan',
                ]
            );
            return response($returnData, 404);
        }
    }
}
