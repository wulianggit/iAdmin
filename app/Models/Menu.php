<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 
        'parent_id', 
        'icon', 
        'url',
        'hightlight_url', 
        'slug', 
        'sort'
    ];
}
