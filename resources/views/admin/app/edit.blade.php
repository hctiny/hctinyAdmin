@extends('layout.admin_base')

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
			<form method="post" action="">
				<div class="box-body">
					<input type="hidden" name="_method" value="put" />
					{!! csrf_field() !!}
					<div class="form-group">
						<label for="app_name">应用名称</label>
						<input type="text" name="app_name" id="app_name" class="form-control" placeholder="请输入名称" value="{{old('app_name') ? old('app_name') : $info->app_name}}">
					</div>
					<div class="form-group">
						<label for="app_desc">应用描述</label>
						<textarea name="app_desc" id="app_desc" class="form-control" placeholder="请输入应用描述">{{old('app_desc') ? old('app_desc') : $info->app_desc}}</textarea>
					</div>
					<div class="form-group">
						<label for="status">状态</label>
						<select class="form-control" id="status" name="status">
							@foreach ($statusList as $key=>$val)
							<option value="{{$key}}" {{old('status') ? ($key == old('status') ? 'selected' : '') : ($info->status == $key ? 'selected' : '')}}>{{$val}}</option>
							@endforeach
						</select>
					</div>
				</div>
				@include('layout.data_footer')
			</form>
    	</div>
	</section>
@endsection