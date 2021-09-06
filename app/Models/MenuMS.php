<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMS extends Model
{
    protected $table = 'menu_ms';
    protected $fillable = [
        'name',
        'icon'
    ];
    
    public function menu()
    {
        return $this->hasMany('App\Models\Menu', 'id_ms', 'id');
    }
    
    public function menu_manage()
    {
        return $this->belongsTo('App\Models\MenuManage', 'id', 'id_menu_ms');
    }
}
