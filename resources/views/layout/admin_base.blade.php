<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>标题</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/skins/_all-skins.min.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="" class="logo">
      <span class="logo-mini">H<b>A</b></span>
      <span class="logo-lg">Hctiny<b>Admin</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ URL::asset('img/avatar0.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->user_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ URL::asset('img/avatar0.png')}}" class="img-circle" alt="User Image">
                <p>
                  {{$role}}
                  <small>{{Auth::user()->user_name}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">个人资料</a>
                </div>
                <div class="pull-right">
                  <a href="/admin/logout" class="btn btn-default btn-flat">退出</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        {!! $leftMenus !!}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 台州仨民机电有限公司</strong> 技术支持 <a>杭州派兹坊网络科技有限公司</a> 浙ICP备10052367号
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{ URL::asset('js/app.js')}}"></script>
<script src="{{ URL::asset('bower_components/adminlte/js/adminlte.min.js')}}"></script>
<script src="{{ URL::asset('bower_components/adminlte/js/demo.js')}}"></script>
</body>
</html>
