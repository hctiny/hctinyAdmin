<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\UserRole;
use App\RoleMenu;
use App\Http\Common\Tree;
use Request;

class BaseController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log');
    }

    protected function view($view, $data=[]){
    	if(Auth::user()->id == 1){
    		$data['role'] = '超级管理员';
    	}else{
    		$roleNames = [];
    		foreach (Auth::user()->roles as $role) {
    			array_push($roleNames, $role->role_name);
    		}
    		$data['role'] = join('、', $roleNames);
    	}
    	$data['leftMenus'] = $this->leftMenus();
    	return view($view, $data);
    }

    protected function leftMenus(){
    	$menus = $this->authMenus();
    	$cur_url = Request::path();
    	$currentId = 0;
    	$parentIds = [];
    	foreach ($menus as $menu) {
    		if(strpos($menu['menu_url'], $cur_url) !== false){
    			$currentId = $menu['id'];
    			$parentIds = $this->parentMenuIds($currentId, $menus);
    		}
    	}

        $menus = $menus->toArray();
    	$tree = new Tree($menus);

    	$text_base_one   = "<li class='treeview";
        $text_hover      = " active";
        $text_base_two   = "'><a href='javascript:void(0);'><i class='\$menu_icon'></i><span>\$menu_name</span>
                             <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>
                             </a><ul class='treeview-menu";
        $text_open       = " menu-open";
        $text_base_three = "'>";

        $text_base_four = "<li";
        $text_hover_li  = " class='active'";
        $text_base_five = ">
                            <a href='\$menu_url'>
                            <i class='\$menu_icon'></i>
                            <span>\$menu_name</span>
                            </a>
                         </li>";

    	$tree->parentBegin = $text_base_one . $text_base_two . $text_base_three;
    	$tree->parentActiveBegin = $text_base_one . $text_hover . $text_open . $text_base_two . $text_base_three;
    	$tree->parentEnd = '</ul></li>';
    	$tree->childActive = $text_base_four . $text_hover_li . $text_base_five;
    	$tree->child = $text_base_four . $text_base_five;

    	return $tree->getTree(0, $currentId, $parentIds);
    }

    protected function parentMenuIds($curId, $menus, $parentIds = array()){
    	if(is_array($menus)){
    		foreach ($menus as $menu) {
    			if($menu['id'] == $curId){
    				if($menu['parent_id'] != 0){
    					array_push($parentIds, $menu['parent_id']);
    					$this->parentMenuIds($menu['parent_id'], $menus, $parentIds);
    				}
    			}
    		}
    	}
    	return !empty($parentIds) ? $parentIds : false;
    }

    protected function authMenus(){
    	if(Auth::user()->id == 1){
    		$menus = Menu::all();
    	}else{
    		$roleIds = UserRole::where('user_id', Auth::user()->id)->get(['role_id']);
    		if($roleIds->count() == 0){
    			$roleIds = [];
    		}
    		$menuIds = RoleMenu::where('role_id', 'in', $roleIds)->get(['menu_id']);
    		if($menuIds->count() == 0){
    			$menuIds = [];
    		}
    		$menuIds = array_unique($menuIds);
    		$menus = Menu::where('id', 'in', $menuIds)->select();
    	}
    	return $menus;
    }
}
