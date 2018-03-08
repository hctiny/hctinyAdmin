@extends('layout.admin_base')

@section('beforeStyle')
	<link rel="stylesheet" href="{{ URL::asset('bower_components/select2/css/select2.min.css')}}">
@endsection

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
			<form method="post" action="">
				<div class="box-body">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="put" />
					<div class="form-group">
						<label for="user_name">用户名</label>
						<input type="text" name="user_name" id="user_name" class="form-control" placeholder="请输入用户名" value="{{old('user_name') ? old('user_name') : $info->user_name}}">
					</div>
					<div class="form-group">
						<label for="password">密码(默认：123456)</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="请输入密码" value="{{old('password')}}">
					</div>
					<div class="form-group">
						<label for="role_id">角色</label>
						<select class="form-control select2" id="role_id" name="role_id[]" multiple="">
							@foreach ($roles as $role)
							<option value="{{$role->id}}" {{old('role_id') ? (in_array($role->id, old('role_id')) ? 'selected' : '') : (in_array($role->id, $infoRoles) ? 'selected' : '')}}>{{$role->role_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="name">姓名</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="请输入姓名" value="{{old('name') ? old('name') : $info->profile->name}}">
					</div>
					<div class="form-group">
						<label for="sex">性别</label>
						<select id="sex" name="sex" class="form-control">
							@foreach($sexs as $value => $text)
							<option value="{{$value}}" {{old('sex') ? (old('sex') == $value ? 'selected' : '') : ($info->profile->sex == $value ? 'selected' : '')}}>{{$text}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="tellphone">手机号码</label>
						<input type="text" name="tellphone" id="tellphone" class="form-control" placeholder="请输入手机号码" value="{{old('tellphone') ? old('tellphone') : $info->profile->tellphone}}">
					</div>
					<div class="form-group">
						<label for="email">邮箱</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="请输入邮箱" value="{{old('email') ? old('email') : $info->profile->email}}">
					</div>
					<div class="form-group">
						<label for="address">地址</label>
						<input type="text" name="address" id="address" class="form-control" placeholder="请输入地址" value="{{old('address') ? old('address') : $info->profile->address}}">
					</div>
				</div>
				@include('layout.data_footer')
			</form>
    	</div>
	</section>
@endsection

@section('script')
	<script type="text/javascript" src="{{ URL::asset('bower_components/select2/js/select2.min.js')}}"></script>
	<script type="text/javascript">
		$('.select2').select2();
	</script>
@endsection