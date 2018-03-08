<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\PasswordResetRequest;
use App\Http\Requests\Admin\AvatarUploadRequest;
use App\Http\Services\Admin\ProfileService;

use App\Profile;

class ProfileController extends BaseController
{
    protected $indexUrl = 'admin/profile';
    protected $viewPath = 'admin.profile';
	
	public function __construct(ProfileService $service, Profile $profile)
    {
    	parent::__construct($service);
    	$this->model = $profile;
    }

    public function index(Request $request){
    	$info = $this->service->getAuthProfile();
    	return $this->view($this->viewPath.'.index', ['info'=>$info, 'sexs'=>$this->model->sexs]);
    }

    public function update(ProfileRequest $request){
    	if(false === $this->service->updateProfile($request)){
    		return $this->error();
    	}
    	return $this->success();
    }

    public function reset(PasswordResetRequest $request){
    	$result = $this->service->resetPassword($request);
    	if(false === $result){
    		return $this->error();
    	}
    	if(is_string($result)){
    		return $this->error($result);
    	}
    	return $this->success();
    }

    public function upload(AvatarUploadRequest $request){
    	if(false === $this->service->uploadAvatar($request)){
    		return $this->error();
    	}
    	return $this->success();
    }
}
