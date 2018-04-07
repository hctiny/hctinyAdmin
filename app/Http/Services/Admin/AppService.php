<?php

namespace App\Http\Services\Admin;

use App\App as AppModel;

use App\Http\Common\Common;

class AppService extends CommonService{
	public function getIndexDatas($keyword = null){
		if($keyword){
            $keyword = '%'.$keyword.'%';
            $datas = AppModel::where('app_name', 'like', $keyword)->paginate($this->listRows);
        }else{
            $datas = AppModel::paginate($this->listRows);
        }
        return $datas;
	}

    // 生成AppId
	public function createAppId(){
        $date = date('YmdHis');
        $rand = '000' . mt_rand(0, 999);
        $appId = $date . substr($rand, strlen($rand) - 3);
        // 检测数据库中是否存在该appid
        $app = AppModel::where('app_id', $appId)->first();
        if($app){
            return $this->createAppId();
        }else{
            return $appId;
        }
    }

    // 生成AppSecret
    public function createAppSecret(){
        $common = new Common();
        return $common->createNonce();
    }
}