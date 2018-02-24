<?php

namespace App\Http\Middleware;

use Closure;
use App\DoLog;
use App\Menu;
use Illuminate\Support\Facades\Auth;

class WriteDoLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->path();
        if(strpos($url, 'logout') !== false){
            $this->createLog($request, $url);
        }
        $result = $next($request);
        if(!$request->isMethod('get')){
            $this->createLog($request, $url);
        }
        return $result;
    }

    protected function createLog($request, $url){
        if(Auth::user() == null){
            return;
        }
        $doLogData['user_id'] = Auth::user()->id;
        $doLogData['log_url'] = $url;
        $doLogData['log_type'] = $request->method();
            // $request->setTrustedProxies(['192.168.10.1']);
        $doLogData['log_ip'] = ip2long($request->getClientIp());
        $cryptKey = config('key') != null ? config('key') : 'hctiny_admin';
        $doLogData['log_data'] = encrypt($request->all(), $cryptKey);

        if(strpos($url, 'authenticate') !== false){
            $doLogData['log_title'] = '登录';
        }else if(strpos($url, 'logout') !== false){
            $doLogData['log_title'] = '登出';
        }else{
            $menu = Menu::where('menu_url', 'like', '%'.$url.'%')->find();
            if($menu){
                $doLogData['log_title'] = $menu['menu_name'];
            }else{
                $doLogData['log_title'] = '';
            }
        }
        DoLog::create($doLogData);
    }
}
