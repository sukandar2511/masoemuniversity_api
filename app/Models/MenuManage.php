<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuManage extends Model
{
    protected $table = 'menu_manage';
    protected $fillable = [
        'id_menu',
        'id_menu_ms',
        'sort'
    ];
    
    public function menu()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'id_menu');
    }
    
    public function menu_ms()
    {
        return $this->hasOne('App\Models\MenuMS', 'id', 'id_menu_ms');
    }
}
