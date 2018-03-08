<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\Admin\SystemInfoService;

use App\SystemInfo;

class SystemInfoController extends BaseController
{
    protected $indexUrl = 'admin/system_info';
    protected $viewPath = 'admin.system_info';
	
	public function __construct(SystemInfoService $service, SystemInfo $systemInfo)
    {
    	parent::__construct($service);
    	$this->model = $systemInfo;
    }

    public function update(Request $request){
    	if($result = $this->nopower($this->powerTypes['index']['value'])){
            return $result;
        }
    	if(false === $this->service->updateSystemInfo($request)){
    		return $this->error();
    	}
    	return $this->success();
    }
}
