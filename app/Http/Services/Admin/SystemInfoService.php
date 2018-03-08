<?php

namespace App\Http\Services\Admin;

use App\SystemInfo;
use DB;
use App\Http\Common\ErrorMessage;

class SystemInfoService extends CommonService{
	public function getIndexDatas($keyword = null){
		$systemInfos = SystemInfo::all();
        return $systemInfos;
    }

    public function updateSystemInfo($request){
        try {
            DB::transaction(function() use ($request) {
                foreach ($request->all() as $key => $value) {
                    $info = SystemInfo::where('info_name', $key)->first();
                    $info->info_value = $value;
                    if(false === $info->save()){
                        throw new Exception(ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR), ErrorMessage::SYSTEM_ERROR);
                    }
                }
            });
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
