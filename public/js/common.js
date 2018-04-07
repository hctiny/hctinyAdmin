var api_service = 'http://localhost/api/router';
var app_id = '20180407022224995';
var app_secret = '1fpyfux2rslc0ub618z098mt1ixzalab';

(function($){
    $.commonAjax = function(method, data, format='json',sign_method='md5'){
        var data = {
            "app_id":app_id,
            "method": method,
            "format": format,
            "sign_method": sign_method,
            "nonce": createNonce()
        }

        data = makeSign(data);

        $.ajax({
            url: api_service,
            type: 'POST',
            data: data,
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });

        function createNonce(length=32){
            var chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
            var nonce = '';
            for(var i = 0; i < length; i++){
                var randNum = Math.floor(Math.random() * chars.length);
                nonce += chars[randNum];
            }
            return nonce;
        }

        // 生成sign
        // param：请求参数，json格式
        function makeSign(param){
            var arr = softParam(param);
            var paramStr = arr.join('&');
            // 添加appsecret
            paramStr += '&app_secret='+app_secret;
            param['sign'] = md5(paramStr);
            return param;
        }

        // 对参数进行排序
        // param：请求参数，json格式
        // return数组格式的参数key=value
        function softParam(param){
            var arr = [];
            for(var key in param){
                var temp = key+'='+param[key];
                arr.push(temp.toLowerCase());
            }
            return arr.sort();
        }
    }
})(jQuery)