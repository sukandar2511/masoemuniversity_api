<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMs;
use App\Models\Menu;
use App\Models\MenuManage;

class MenuManagementController extends Controller
{
    public function index()
    {
        $data   = MenuManage::orderBy('sort', 'asc')->get();
        $no     = 0;
        $array  = array();
        foreach ($data as $item) {
            if ($item->id_menu) {
                $menu   = $item->menu->name;
                $ms     = '-';
            }else {
                $menu   = '-';
                $ms     = $item->menu_ms->name;
            }
            $array[$no++] = array(
                'id'    => $item->id,
                'id_menu'   => $item->id_menu,
                'id_ms'     => $item->id_menu_ms,
                'name_menu' => $menu,
                'name_ms'   => $ms,
                'name'      => $item->sort
            );
        }

        if (!empty($array)) {
            $returnData = array(
                "status"    => "success",
                "code"      => "200",
                "data"      => $array
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
        $data = MenuManage::findOrFail($req->id);
        if ($data) {
            if ($data->id_menu) {
                $menu   = $data->menu->name;
                $ms     = 'TANPA MASTER MENU';
            }else {
                $menu   = 'TANPA MENU';
                $ms     = $data->menu_ms->name;
            }
            $returnData = array(
                "status" => "created",
                "code" => "201",
                "data" => [
                    'sort'      => $data->sort,
                    'id_menu'   => $data->id_menu,
                    'name_menu' => $menu,
                    'id_menu_ms'=> $data->id_menu_ms,
                    'name_ms'   => $ms
                ]
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
        MenuManage::create($request->toArray());

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
        $berita = MenuManage::find($id);
        $berita->id_menu    = $request->id_menu;
        $berita->id_menu_ms = $request->id_menu_ms;
        $berita->sort       = $request->sort;
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
        $data = MenuManage::find($id);
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

    public function check_sort(Request $req)
    {
        $data = MenuManage::where('sort', $req->id)->count();
        if ($data) {
            if ($data > 0) {
                $code = 1;
            }else {
                $code = 0;
            }
            $returnData = array(
                "status"    => "created",
                "code"      => "201",
                "data"      => $code
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
}
