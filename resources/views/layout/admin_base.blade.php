<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>hctinyAdmin-{{$title}}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
  @yield('beforeStyle')
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/adminlte/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('css/admin.css')}}">
  <script src="{{ URL::asset('js/app.js')}}"></script>
  @yield('style')
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
              <img src="{{ $authAvatar or URL::asset('img/avatar0.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->user_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ $authAvatar or URL::asset('img/avatar0.png')}}" class="img-circle" alt="User Image">
                <p>
                  {{$authRole}}
                  <small>{{Auth::user()->user_name}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/admin/profile" class="btn btn-default btn-flat">个人资料</a>
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
        @include('layout.menu', ['menus'=>$leftMenus])
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="position: relative;">
    @section('content')
      @if(count($errors) > 0)
        @include('layout.error')
      @endif
      @if(isset($success_message))
        @include('layout.success')
      @endif
      <section class="content-header">
        <h1>
          {{$title}}
        </h1>
      </section>
    @show
  </div>
  <!-- 删除modal -->
  <div class="modal fade" id="del-modal" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">提示</h4>
        </div>
        <form id="del-modal-form" method="post" action="">
          <div class="modal-body">
            <p id="del-modal-message">您确认执行本次操作吗？</p>
            <input type="hidden" name="_method" value="delete" />
            {!! csrf_field() !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">提交</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ $systemInfos['right_time'] }} {{ $systemInfos['owner'] }}</strong> 技术支持 <a>杭州派兹坊网络科技有限公司</a> {{ $systemInfos['icp_number'] }}
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{ URL::asset('bower_components/adminlte/js/adminlte.min.js')}}"></script>
<script src="{{ URL::asset('bower_components/adminlte/js/demo.js')}}"></script>
<script type="text/javascript">
  function del(url, message){
    $('#del-modal-form').attr('action', url);
  }
</script>
@yield('script')
</body>
</html>
