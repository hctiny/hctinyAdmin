<?php

namespace App\Http\Services\Admin;

use Illuminate\Support\Facades\Auth;
use Request;

use App\Http\Common\Tree;
use App\Menu;
use App\RoleMenu;
use App\UserRole;
use App\User;
use App\Profile;
use App\SystemInfo;

class CommonService
{
	protected $authUser = null;

	protected $curMenuName = '';
	protected $listRows = 10;

	public function getIndexDatas($keyword = null){
		return [];
	}

	// 获取登录用户的角色信息
	public function getAuthRoles(){
		if(!$this->authUser){
			$this->authUser = Auth::user();
		}

		if($this->authUser->id == 1){
			return '超级管理员';
		}else{
			$roleNames = [];
    		foreach ($this->authUser->roles as $role) {
    			array_push($roleNames, $role->role_name);
    		}
    		return join('、', $roleNames);
		}
	}

	public function getAuthAvatar(){
		if(!$this->authUser){
			$this->authUser = Auth::user();
		}
		if($this->authUser->profile){
			return $this->authUser->profile->avatar;
		}else{
			return null;
		}
	}

	public function getAuthProfile(){
		if(!$this->authUser){
			$this->authUser = Auth::user();
		}
		if($this->authUser->profile){
			return $this->authUser->profile;
		}else{
			return new Profile();
		}
	}

	public function getAuthMenus(){
		if(!$this->authUser){
			$this->authUser = Auth::user();
		}

		if($this->authUser->id == 1){
			$menus = Menu::orderBy('sort', 'asc')->get();
		}else{
			$roleIds = UserRole::where('user_id', $this->authUser->id)->get(['role_id']);
            $roleIds = array_pluck($roleIds->toArray(), 'role_id');

    		$menuIds = RoleMenu::whereIn('role_id', $roleIds)->get(['menu_id']);
            $menuIds = array_pluck($menuIds->toArray(), 'menu_id');

    		$menuIds = array_unique($menuIds);
    		$menus = Menu::whereIn('id', $menuIds)->orderBy('sort', 'asc')->get();
		}
		return $menus->toArray();
	}

	public function getLeftMenus($curUrl){
		$authMenus = $this->getAuthMenus();
		$curMenuId = $this->getCurMenuId($curUrl, $authMenus);
		
		$tree = new Tree($authMenus);

		$menuTree = $tree->getTree(0, $curMenuId, true);
		return $this->removeHidden($menuTree);
	}

	public function getCurMenuId($curUrl, $menus){
		foreach ($menus as $menu) {
			$menuUrl = $this->transformUrl($menu['menu_url']);
			if(url($menuUrl) == url($curUrl)){
				$this->curMenuName = $menu['menu_name'];
				return $menu['id'];
			}
		}
	}

	public function getCurMenuName(){
		return $this->curMenuName;
	}

	public function getSystemInfos(){
		$systemInfos = SystemInfo::all();

		$result = [];
		foreach ($systemInfos as $value) {
			$result[$value->info_name] = $value->info_value;
		}
		return $result;
	}

	protected function removeHidden($menuTree, &$newTree = []){
		foreach ($menuTree as $menu) {
			if($menu['is_show'] == 1){
				$child = $this->removeHidden($menu['child']);
				$menu['child'] = $child;
				array_push($newTree, $menu);
			}
		}
		return $newTree;
	}

	protected function transformUrl($url){
        $regex = '/\{\w+\}/';
        $result = preg_match($regex, $url, $matches);
        if($result > 0){
            foreach ($matches as $match) {
                $param = substr($match, 1, strlen($match) - 2);
                $paramValue = Request::route($param);
                if($paramValue){
                    $url = str_replace($match, $paramValue, $url);
                }
            }
        }
        return $url;
    }
}