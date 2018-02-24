<?php

namespace App\Http\Controllers\Admin;

class HomeController extends BaseController
{
	public function index(){
		return $this->view('layout.admin_base');
	}
}
