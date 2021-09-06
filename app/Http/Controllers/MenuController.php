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

class MenuController extends Controller
{
    public function menu_ms($id)
    {
        $data   = MenuMs::findOrFail($id);
        if ($data) {
            $returnData = array(
                "status"    => "sukses",
                "code"      => "200",
                "data"      => $data
            );
            return response()->json($returnData, 200);
        }
        
        $returnData = array(
            "status"    => "internal server error",
            "code"      => "500"
        );
        return response()->json($returnData, 500);
    }

    public function menu_manage()
    {
        $data = MenuManage::orderBy('sort', 'asc')->get();
        if ($data) {
            $returnData = array(
                "status"    => "sukses",
                "code"      => "200",
                "data"      => $data
            );
            return response()->json($returnData, 200);
        }
        
        $returnData = array(
            "status"    => "internal server error",
            "code"      => "500"
        );
        return response()->json($returnData, 500);
    }

    public function menu_role(Request $req, $id)
    {
        $user   = User::where('api_token', $this->genereate_header_token($req))->first();
        $menu   = Menu::findOrFail($id);
        if ($menu) {
            if ($menu->menu_role->id_role == $user->id_role) {
                    $returnData = array(
                        "status"    => "sukses",
                        "code"      => "200",
                        "data"      => $menu
                    );
                    return response()->json($returnData, 200);
            }else {
                    $returnData = array(
                        "status"    => "sukses",
                        "code"      => "200",
                        "data"      => NULL
                    );
                    return response()->json($returnData, 200);
            }
        }

        $returnData = array(
            "status"    => "internal server error",
            "code"      => "500"
        );
        return response()->json($returnData, 500);
    }

    public function data_menu_ms(Request $req, $id)
    {
        $user   = User::where('api_token', $this->genereate_header_token($req))->first();
        if ($user) {
            $no = 0;
            $array = array();
            foreach ($user->role->menu_role as $role) {
                if ($role->menu->id_ms == $id) {
                    $array[ $no ] = array(
                        'name'  => $role->menu->name,
                        'url'   => $role->menu->url,
                        'icon'  => $role->menu->icon
                    );
                    $no++;
                }
            }
            
            $returnData = array(
                "status"    => "sukses",
                "code"      => "200",
                "data"      => $array
            );
            return response()->json($returnData, 200);
        }
        
        $returnData = array(
            "status"    => "internal server error",
            "code"      => "500"
        );
        return response()->json($returnData, 500);
    }

    public function get_master(Request $id)
    {
        $returnData = array(
            "status"    => "success",
            "code"      => "200",
            "data"      => MenuMs::get()
        );

        return response($returnData, 200);
    }

    public function get_menu(Request $id)
    {
        $returnData = array(
            "status"    => "success",
            "code"      => "200",
            "data"      => Menu::get()
        );

        return response($returnData, 200);
    }

    // Resource 
    public function index()
    {
        $data   = Menu::get();
        $array  = array();
        $no     = 0;
        foreach ($data as $item) {
            $ms_name = NULL;
            if ($item->id_ms) {
                $ms_name = $item->menu_ms->name;
            }
            $array[$no] = array(
                'id'        => $item->id,
                'name'      => $item->name,
                'url'       => $item->url,
                'icon'      => $item->icon,
                'ms_name'   => $ms_name
            );
            $no++;
        }
        if ($data) {
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
        $data = Menu::findOrFail($req->id);
        if ($data->id_ms == 0) {
            $menu_ms     = 'TANPA MASTER MENU';
        }else {
            $menu_ms     = $data->menu_ms->name;
        }
        $returnData = array(
            "status" => "created",
            "code" => "201",
            "data" => [
                "name"      => $data->name,
                "url"       => $data->url,
                "icon"      => $data->icon,
                "id_ms"     => $data->id_ms,
                "name_ms"   => $menu_ms
            ]
        );

        return response($returnData, 201);
    }

    public function create(Request $request)
    {
        Menu::create($request->toArray());

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
        $berita = Menu::find($id);
        $berita->name   = $request->name;
        $berita->url    = $request->url;
        $berita->icon   = $request->icon;
        $berita->id_ms  = $request->id_ms;
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
        $data = Menu::find($id);
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
