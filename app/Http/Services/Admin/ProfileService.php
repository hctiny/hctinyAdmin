<?php

namespace App\Http\Services\Admin;

use App\Profile;

use Illuminate\Support\Facades\Auth;
use App\Http\Common\ErrorMessage;

class ProfileService extends CommonService{
	public function updateProfile($request){
        $profile = Auth::user()->profile;
        if($profile){
            return $profile->update($request->all());
        }else{
            $profile = new Profile($request->all());
            return Auth::user()->profile()->save($profile);
        }
    }

    public function resetPassword($request){
        $user = Auth::user();
        if($user->password == $request->password_old){
            $user->password = bcrypt($request->password_new);

            return $user->save();
        }else{
            return ErrorMessage::getMessage(ErrorMessage::PASSWORD_ERROR);
        }
    }

    public function uploadAvatar($request){
        if($request->avatar->isValid()){
            $path = $request->avatar->store('avatar', 'public');
            $profile = Auth::user()->profile;
            $profile->avatar = config('filesystems.disks.public.url').'/'.$path;
            return $profile->save();
        }
        return false;
    }
}