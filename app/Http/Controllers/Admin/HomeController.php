<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\CommonService;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
	protected $indexUrl = 'admin/home';
	protected $viewPath = 'admin.home';
	
	public function __construct(CommonService $service)
    {
    	parent::__construct($service);
    }

	public function index(Request $request){
		if($result = $this->nopower('index')){
            return $result;
        }
		return $this->view($this->viewPath.'.index');
	}
}
