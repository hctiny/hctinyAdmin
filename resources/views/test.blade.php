<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>测试Api</title>
    </head>
    <body>
        <form>
            appId:<input type="text" id="appId">
            method:<input type="text" id="method">
            format:<input type="text" id="format" value="json">
            sign_method:<input type="text" id="sign_method" value="md5">
            <input type="button" id="submit">
        </form>
    </body>
    <script src="{{ URL::asset('js/app.js')}}"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script src="{{ URL::asset('js/common.js')}}"></script>
    <script>
        $.commonAjax('demo.index');
    </script>
</html>
