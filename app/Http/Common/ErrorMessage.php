<?php

namespace App\Http\Common;

Class ErrorMessage{
	protected static $errors = [
		-1=>'系统异常',
		0=>'操作成功',
		1001=>'登录失败',
		1002=>'用户名或密码错误',
		1003=>'密码错误'
	];

	const SYSTEM_ERROR = -1;
	const OK = 0;
	const LOGIN_ERROR = 1001;
	const NAME_OR_PASSWORD_ERROR = 1002;
	const PASSWORD_ERROR = 1003;

	public static function getMessage($errorKey){
		return self::$errors[$errorKey];
	}

	public static function getMessageWithKey($errorKey){
		return [
			'error_code'=>$errorKey,
			'error_message'=>self::$errors[$errorKey]
		];
	}
}