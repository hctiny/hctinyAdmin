<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登录</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('css/admin.css')}}">
  <!-- jQuery 3 -->
  <script src="{{ URL::asset('js/app.js')}}"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="">Hctiny<b>Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form action="authenticate" method="post">
      {!! csrf_field() !!}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="用户名" name="user_name" value="{{old('user_name')}}">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="密码" name="password" value="{{old('password')}}">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8">
          <p class="login-error">
            @if(count($errors) > 0)
              {{$errors->first()}}
            @endif
          </p>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
