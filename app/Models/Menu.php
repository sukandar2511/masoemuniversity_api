<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'name',
        'url',
        'icon',
        'id_ms'
    ];
    
    public function menu_ms()
    {
        return $this->belongsTo('App\Models\MenuMS', 'id_ms', 'id');
    }
    
    public function menu_role()
    {
        return $this->belongsTo('App\Models\MenuRole', 'id', 'id_menu');
    }
    
    public function menu_manage()
    {
        return $this->belongsTo('App\Models\MenuManage', 'id', 'id_menu');
    }
}
