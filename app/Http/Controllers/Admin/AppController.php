<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\AppRequest;
use App\Http\Services\Admin\AppService;

use App\App as AppModel;

class AppController extends BaseController
{
    protected $indexUrl = 'admin/app';
    protected $viewPath = 'admin.app';

	public function __construct(AppService $service, AppModel $model)
    {
    	parent::__construct($service);
        $this->model = $model;
    }

    public function create(){
        return $this->_create(['statusList'=>$this->model->statusList]);
    }

    public function edit($id){
        return $this->_edit($id, ['statusList'=>$this->model->statusList]);
    }

    // 存储
    public function store(AppRequest $request){
        $request['app_id'] = $this->service->createAppId();
        $request['app_secret'] = $this->service->createAppSecret();
        return $this->_store($request);
    }

    // 更新
    public function update(AppRequest $request, $id){
        return $this->_update($request, $id);
    }
}
