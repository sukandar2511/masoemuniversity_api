<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = [
        'role_name'
    ];
    
    public function menu_role()
    {
        return $this->hasMany('App\Models\MenuRole', 'id_role', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'id_role');
    }
}
