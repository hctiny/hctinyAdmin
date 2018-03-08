<?php

namespace App\Http\Services\Admin;

use App\Role;
use App\RoleMenu;

use App\Http\Common\Tree;

class RoleService extends CommonService{
	public function getIndexDatas($keyword = null){
		if($keyword){
            $keyword = '%'.$keyword.'%';
            $roles = Role::where('role_name', 'like', $keyword)->paginate($this->listRows);
        }else{
            $roles = Role::paginate($this->listRows);
        }
        return $roles;
	}

	public function getMenuTree($roleId){
		$authMenus = $this->getAuthMenus();

		$roleMenuIds = RoleMenu::where('role_id', $roleId)->get(['menu_id']);
        $roleMenuIds = array_pluck($roleMenuIds->toArray(), 'menu_id');

        $tree = new Tree($authMenus);

        $menuTree = $tree->getTree(0, $roleMenuIds, true);

        $twoColMenus = [[],[]];
        foreach ($menuTree as $index => $menu) {
        	array_push($twoColMenus[$index % 2], $menu);
        }
        return $twoColMenus;
	}
}