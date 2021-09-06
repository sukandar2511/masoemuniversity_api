<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMs;

class MenuMsController extends Controller
{
    public function index()
    {
        $data   = MenuMs::get();
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
        $data = MenuMs::findOrFail($req->id);
        if ($data) {
            $returnData = array(
                "status" => "created",
                "code" => "201",
                "data" => $data
            );
            return response($returnData, 201);
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
        MenuMs::create($request->toArray());

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
        $berita = MenuMs::find($id);
        $berita->name   = $request->name;
        $berita->icon   = $request->icon;
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
        $data = MenuMs::find($id);
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
