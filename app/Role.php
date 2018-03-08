<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];

    public function menus(){
    	return $this->belongsToMany('App\Menu', 'role_menus');
    }
}
