<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('log');
    }
	
	public function index(){
		return view('admin.login.index');
	}

    public function authenticate(Request $request){
    	$user_name = $request->input('user_name');
    	$password = $request->input('password');
    	if(Auth::attempt(['user_name'=>$user_name, 'password'=>$password])){
    		return redirect('admin/home');
    	}
    	return redirect('/admin/login')->with('message', '用户名或密码错误');
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}
