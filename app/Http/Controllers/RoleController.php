<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuMs;
use App\Models\MenuManage;
use App\Models\MenuRole;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::get();
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

    public function get_id(Request $req)
    {
        $data = Role::find($req->id);
        $returnData = array(
            "status" => "created",
            "code" => "201",
            "data" => [
                "role_name" => $data->role_name
            ]
        );

        return response($returnData, 201);
    }

    public function create(Request $request)
    {
        Role::create([
            'role_name'   => $request->role_name
        ]);

        $returnData = array(
            "status" => "created",
            "code"   => "201",
            "data"   => [
                "message" => "Data berhasil tersimpan"
            ]
        );
        return response($returnData, 201);
    }

    public function update(Request $request, $id)
    {
        $berita = Role::find($id);
        $berita->role_name = $request->role_name;
        $berita->save();

        $returnData = array(
            "status" => "created",
            "code" => "201",
            "data" => [
                "message" => "Data berhasil diupdate"
            ]
        );
        return response($returnData, 201);
    }

    public function delete($id)
    {
        $data = Role::find($id);
        $data->delete();
        $returnData = array(
            "status" => "sukses",
            "code" => "201",
            "data" => [
                "message" => "Data berhasil dihapus"
            ]
        );
        return response($returnData, 201);
    }
}
