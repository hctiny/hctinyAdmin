<?php
namespace App\Http\Services\ApiServer\Response;

class Demo extends Base{
    public function index(&$param){
        return $this->success([
            'current_time' => date('Y-m-d H:i:s')
        ]);
    }
}