<?php

namespace App\Http\Services\Admin;

use App\Menu;
use App\Http\Common\Tree;

class MenuService extends CommonService{
	public function getIndexDatas($keyword = null){
		if($keyword){
            $keyword = '%'.$keyword.'%';
            $menus = Menu::where('menu_name', 'like', $keyword)->paginate($this->listRows);
        }else{
    	    $menus = Menu::paginate($this->listRows);
        }
        return $menus;
	}

	public function getMenuTree($selectedId=0, $currentId=0, $parentId = -1){
		$array = [];
    	if(!is_array($currentId)){
    		array_push($array, $currentId);
    		$currentId = $array;
    	}
        $result = Menu::whereNotIn('id', $currentId)->orderBy('sort', 'asc')->get();
        $result = $result->toArray();
        array_unshift ($result, ['id'=>0, 'menu_name'=>'根节点', 'parent_id'=>-1]);

        $tree = new Tree($result);
        return $tree->getSelectTree($parentId, $selectedId);
	}
}