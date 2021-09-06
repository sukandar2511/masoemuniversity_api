<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

class Controller extends BaseController
{
    public static function encrypt($id)
    {
        $id = Crypt::encryptString($id);
        return $id;
    }
    
    public static function dencrypt($id)
    {
        $id = Crypt::decryptString($id);
        return $id;
    }

    public static function genereate_header_token($data)
    {
        $response   = explode(' ', $data->header('authorization'));
        return trim($response[1]);
    }
}
