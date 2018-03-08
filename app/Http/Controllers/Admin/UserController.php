<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Services\Admin\UserService;

use App\User;
use App\Profile;
use App\Role;

class UserController extends BaseController
{
    protected $indexUrl = 'admin/user';
    protected $viewPath = 'admin.user';

	public function __construct(UserService $service, User $user, Profile $profile, Role $role)
    {
    	parent::__construct($service);
        $this->model = $user;
        $this->profile = $profile;
        $this->role = $role;
    }

    // 创建
    public function create(){
        $roles = $this->role->all();
    	return $this->_create(['sexs'=>$this->profile->sexs, 'roles'=>$roles]);
    }

    // 存储
    public function store(UserRequest $request){
        if($result = $this->nopower($this->powerTypes['add']['value'])){
            return $result;
        }
        if(false === $this->service->storeUserData($request)){
            return $this->error();
        }

        return $this->success();
    }

    // 编辑
    public function edit($id){
        if($result = $this->nopower($this->powerTypes['edit']['value'])){
            return $result;
        }
        $info = $this->model->find($id);

        $roleIds = [];
        foreach ($info->roles as $role) {
            array_push($roleIds, $role->id);
        }
        $roles = $this->role->all();
        return $this->view('admin.user.edit', ['info'=>$info, 'sexs'=>$this->profile->sexs, 'roles'=>$roles, 'infoRoles'=>$roleIds]);
    }

    // 更新
    public function update(UserRequest $request, $id){
        if($result = $this->nopower($this->powerTypes['edit']['value'])){
            return $result;
        }
        if(false === $this->service->updateUserData($request, $id)){
            return $this->error();
        }

        return $this->success();
    }

    // 删除
    public function destroy($id){
        if($result = $this->nopower($this->powerTypes['delete']['value'])){
            return $result;
        }
        if(false === $this->profile->where('user_id', $id)->delete()){
            return $this->error();
        }

        if(false === $this->model->destroy($id)){
            return $this->error();
        }

        return $this->success();
    }
}
