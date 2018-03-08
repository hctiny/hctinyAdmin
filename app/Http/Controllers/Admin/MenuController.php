<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Common\Tree;
use App\Http\Common\ErrorMessage;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Services\Admin\MenuService;

use App\Menu;

class MenuController extends BaseController
{
    protected $indexUrl = 'admin/menu';
    protected $viewPath = 'admin.menu';

	public function __construct(MenuService $service, Menu $menu)
    {
    	parent::__construct($service);
        $this->model = $menu;
    }

    // 创建
    public function create(){
    	return $this->_create(['parents'=>$this->service->getMenuTree(0), 'showTypes'=>$this->model->showTypes, 'powerTypes'=>config('power')]);
    }

    // 存储
    public function store(MenuRequest $request){
        return $this->_store($request);
    }

    // 编辑
    public function edit($id){
        if($result = $this->nopower($this->powerTypes['edit']['value'])){
            return $result;
        }
        $info = $this->model->find($id);
        return $this->view($this->viewPath.'.edit', ['info'=>$info, 'parents'=>$this->service->getMenuTree($info->parent_id, $info->id), 'showTypes'=>$this->model->showTypes, 'powerTypes'=>config('power')]);
    }

    // 更新
    public function update(MenuRequest $request, $id){
        return $this->_update($request, $id);
    }
}
