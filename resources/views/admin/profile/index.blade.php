@extends('layout.admin_base')

@section('content')
  @parent
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{$info->avatar ? $info->avatar : URL::asset('img/avatar0.png')}}" alt="用户头像">

            <h3 class="profile-username text-center">{{Auth::user()->user_name}}</h3>

            <p class="text-muted text-center">{{$authRole}}</p>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#info" data-toggle="tab">个人信息</a></li>
            <li><a href="#reset" data-toggle="tab">密码修改</a></li>
            <li><a href="#upload" data-toggle="tab">头像上传</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="info">
              <form class="form-horizontal" method="post" action="{{url($indexUrl).'/update'}}">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">姓名</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入姓名" value="{{old('name') ? old('name') : $info->name}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">性别</label>

                  <div class="col-sm-10">
                    <select id="sex" name="sex" class="form-control">
                      @foreach($sexs as $value => $text)
                      <option value="{{$value}}" {{old('sex') ? (old('sex') == $value ? 'selected' : '') : ($info->sex == $value ? 'selected' : '')}}>{{$text}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tellphone" class="col-sm-2 control-label">手机号</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tellphone" name="tellphone" placeholder="请输入手机号" value="{{old('tellphone') ? old('tellphone') : $info->tellphone}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">邮箱</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="请输入邮箱" value="{{old('email') ? old('email') : $info->email}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="address" class="col-sm-2 control-label">地址</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="请输入地址" value="{{old('address') ? old('address') : $info->address}}">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">保存</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="reset">
              <form class="form-horizontal" method="post" action="{{url($indexUrl).'/reset'}}">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label for="password_old" class="col-sm-2 control-label">旧密码</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_old" name="password_old" placeholder="请输入旧密码">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password_new" class="col-sm-2 control-label">新密码</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_new" name="password_new" placeholder="请输入新密码">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password_confirmation" class="col-sm-2 control-label">确认新密码</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="请输入确认新密码">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">提交</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="upload">
              <form class="form-horizontal" method="post" action="{{url($indexUrl.'/upload')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">头像图片</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="avatar" name="avatar">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">提交</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
@endsection