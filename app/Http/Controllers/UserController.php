<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('level', 'admin')->get();
        if ($data) {
            $returnData = array(
                "status"    => "success",
                "code"      => "200",
                "data"      => $data
            );
            return response()->json($returnData, 200);
        }
        
        $returnData = array(
            "status"    => "not found",
            "code"      => "404",
            "data"      => NULL
        );
        return response()->json($returnData, 404);
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if (!$check) {
            $request['password']            = Hash::make($request['password']);
            $request['active']              = 1;
            $request['level']               = "admin";
            $request['email_verified_at']   = Carbon::now();
            $user = User::create($request->toArray());
            $returnData = array(
                "status"    => "created",
                "code"      => "201",
                "data"      => [
                    "message"   => "Data berhasil terdaftar",
                    "data"      => $user
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
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $check = User::findOrFail($id);
        if (!$check) {
            $returnData = array(
                "status"    => "success",
                "code"      => "200",
                "data"      => [
                    "message"   => "User edit",
                    "data"      => $check
                ]
            );
            return response()->json($returnData, 200);
        }else {
            $returnData = array(
                "status"    => "not found",
                "code"      => "404",
                "data"      => [
                    "message" => "User tidak ditemukan"
                ]
            );
            return response()->json($returnData, 404);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
