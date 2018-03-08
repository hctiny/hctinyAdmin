@extends('layout.admin_base')

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
			<form method="post" action="{{url($indexUrl)}}">
				<div class="box-body">
					{!! csrf_field() !!}
					<div class="form-group">
						<label for="role_name">名称</label>
						<input type="text" name="role_name" id="role_name" class="form-control" placeholder="请输入名称" value="{{old('role_name')}}">
					</div>
				</div>
				@include('layout.data_footer')
			</form>
    	</div>
	</section>
@endsection