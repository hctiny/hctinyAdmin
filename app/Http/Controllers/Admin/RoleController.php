<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Services\Admin\RoleService;

use App\Role;

class RoleController extends BaseController
{
    const POWER_POWER = 'power';

    protected $indexUrl = 'admin/role';
    protected $viewPath = 'admin.role';

	public function __construct(RoleService $service, Role $role)
    {
    	parent::__construct($service);
        $this->model = $role;
    }

    // 存储
    public function store(RoleRequest $request){
        return $this->_store($request);
    }

    // 更新
    public function update(RoleRequest $request, $id){
        return $this->_update($request, $id);
    }

    // 权限列表
    public function power($id){
        if($result = $this->nopower($this->powerTypes['power']['value'])){
            return $result;
        }
        // 获取登录用户的权限列表
        $powers = $this->service->getMenuTree($id);
        $info = $this->model->find($id);

        return $this->view($this->viewPath . '.power', ['powers'=>$powers, 'info'=>$info]);
    }

    // 授权
    public function empower(Request $request, $id){
        if($result = $this->nopower($this->powerTypes['power']['value'])){
            return $result;
        }
        $role = $this->model->find($id);
        $role->menus()->sync($request->menu_id);

        return $this->success();
    }
}
