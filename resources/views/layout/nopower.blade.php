<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>hctinyAdmin-没有权限</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/skins/_all-skins.min.css')}}">
  <!-- jQuery 3 -->
  <script src="{{ URL::asset('js/app.js')}}"></script>
</head>
<body class="hold-transition admin-error-page">
  <div class="error-box">
    <h3>对不起！您没有权限</h3>
    <p><span id="sec">5</span>秒后自动跳转到首页...<a id="redirectUrl" href="{{$redirectUrl}}">立即跳转</a></p>
  </div>

</body>
<script type="text/javascript">
  var index = 4;
  var intId = setInterval(function(){
    $('#sec').html(index);
    index--;
    if(index < 0){
      clearInterval(intId);
      location.href = $('#redirectUrl').attr('href');
    }
  }, 1000);
</script>
</html>
