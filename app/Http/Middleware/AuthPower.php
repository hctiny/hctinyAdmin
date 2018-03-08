<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use App\Menu;
use App\RoleMenu;
use App\UserRole;

class AuthPower
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $indexUrl)
    {
    	$powers = [];
    	if(Auth::id() == 1){
    		array_push($powers, 'all');
    	}else{
    		$authUser = Auth::user();
    		$roleIds = [];
    		foreach ($authUser->roles as $role) {
    			array_push($roleIds, $role->id);
    		}
    		$menuIds = RoleMenu::where('role_id', $roleIds)->get(['menu_id']);
    		$menuIds = array_pluck($menuIds->toArray(), 'menu_id');
    		$menus = Menu::whereIn('id', $menuIds)->where('menu_url', 'like', '%'.$indexUrl.'%')->get();
    		foreach ($menus as $menu) {
    			array_push($powers, $menu['power_name']);
    		}

    		$powers = array_unique($powers);
    	}
    	session(['authPower'=>$powers]);
        return $next($request);
    }
}
