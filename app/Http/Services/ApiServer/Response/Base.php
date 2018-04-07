<?php
namespace App\Http\Services\ApiServer\Response;

abstract class Base{
    protected function success($data, $code = '200'){
        return [
            'status' => true,
            'code'   => $code,
            'data'   => $data
        ];
    }

    protected function error($code = '400'){
        return [
            'status' => false,
            'code'   => $code
        ];
    }
}