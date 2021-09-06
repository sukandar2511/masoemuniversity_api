<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table = 'menu_role';
    protected $fillable = [
        'id_role',
        'id_menu'
    ];
    
    public function menu()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'id_menu');
    }
    
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'id_role', 'id');
    }
}
