<?php
namespace App\Http\Common;

class Common{
    public function createNonce($length = 32){
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $nonce = '';
        for($i = 0; $i < $length; $i++){
            $nonce .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $nonce;
    }
}