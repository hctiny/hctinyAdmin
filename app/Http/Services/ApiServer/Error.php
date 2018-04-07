<?php
namespace App\Http\Services\ApiServer;

/**
 * API服务端 - 错误码
 * @author Flc <2016-7-31 11:27:09>
 */
class Error
{
    /**
     * 错误码
     * @var [type]
     */
    public static $errCodes = [
        // 系统码
        '200' => '成功',
        '400' => '未知错误',
        '401' => '无此权限',
        '500' => '服务器异常',

        // 公共错误码
        '1001' => '[app_id]缺失',
        '1002' => '[app_id]不存在或无权限',
        '1003' => '[method]缺失',
        '1004' => '[format]错误',
        '1005' => '[sign_method]错误',
        '1006' => '[sign]缺失',
        '1007' => '[sign]签名错误',
        '1008' => '[method]方法不存在',
        '1009' => '%s 模块下不存在 %s 方法',
        '1010' => '[nonce]缺失',
        '1011' => '[nonce]必须为字符串',
        '1012' => '[nonce]长度必须为1-32位',
    ];

    /**
     * 返回错误码
     * @var string
     */
    public static function getError($code = '400', $_ = false, $param = null)
    {
        if (! isset(self::$errCodes[$code])) {
            $code = '400';
        }

        $errMsg = self::$errCodes[$code];
        if($param){
            switch($code){
                case '1009':
                    $errMsg = sprintf($errMsg, $param[0], $param[1]);
                    break;
            }
        }

        return ($_ ? "[{$code}]" : '')
            . $errMsg;
    }
}
