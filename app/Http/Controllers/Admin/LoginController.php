<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Common\ErrorMessage;

class LoginController extends Controller
{
    protected $loginUrl = '/admin/login';
    protected $homeUrl = '/admin/home';

	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function index(){
		return view('admin.login.index');
	}

    public function authenticate(Request $request){
    	$user_name = $request->input('user_name');
    	$password = $request->input('password');
    	if(Auth::attempt(['user_name'=>$user_name, 'password'=>$password])){
    		return redirect($this->homeUrl);
    	}
    	return redirect($this->loginUrl)
            ->withErrors(ErrorMessage::getMessage(ErrorMessage::NAME_OR_PASSWORD_ERROR))
            ->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect($this->loginUrl);
    }
}
