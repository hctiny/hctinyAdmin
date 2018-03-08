<?php

namespace App\Http\Services\Admin;

use App\User;
use App\Profile;
use DB;
use App\Http\Common\ErrorMessage;

class UserService extends CommonService{
	public function getIndexDatas($keyword = null){
		if($keyword){
            $keyword = '%'.$keyword.'%';
            $users = User::where('user_name', 'like', $keyword)
            	->where('id', '<>', 1)
            	->paginate($this->listRows);
        }else{
            $users = User::where('id', '<>', 1)
            	->paginate($this->listRows);
        }
        return $users;
	}

	public function storeUserData($request){
		try{
			DB::transaction(function() use ($request) {
				// 创建用户
				$user = new User();
				$user->user_name = $request->user_name;
	        	$user->password = $request->password ? bcrypt($request->password) : bcrypt('123456');
	        	if(false === $user->save()){
	        		throw new Exception(ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR), ErrorMessage::SYSTEM_ERROR);
	        	}

				// 添加用户资料
		        $profile = new Profile($request->all());
		        if(false === $user->profile()->save($profile)){
		            throw new Exception(ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR), ErrorMessage::SYSTEM_ERROR);
		        }

		        // 添加用户角色
		        $user->roles()->sync($request->role_id);
			});
			return true;
		}catch(Exception $e){
			return false;
		}
	}

	public function updateUserData($request, $id){
		try{
			DB::transaction(function() use ($request, $id){
				$user = User::find($id);

		        // 创建用户
		        $user->user_name = $request->user_name;
		        if($request->password){
		            $user->password = bcrypt($request->password);
		        }
		        if(false === $user->save()){
		            throw new Exception(ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR), ErrorMessage::SYSTEM_ERROR);
		        }

		        // 添加用户资料
		        $profile = Profile::where('user_id', $id)->first();
		        if(false === $profile->update($request->all())){
		            throw new Exception(ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR), ErrorMessage::SYSTEM_ERROR);
		        }

		        // 添加用户角色
		        $user->roles()->sync($request->input('role_id'));
			});
			return true;
		}catch(Exception $e){
			return false;
		}
	}
}