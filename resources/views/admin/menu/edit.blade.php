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
						<label for="parent_id">上级菜单</label>
						<select class="form-control" id="parent_id" name="parent_id">
							@foreach( $parents as $item)
							<option value="{{$item['id']}}" {{$item['selected'] ? 'selected' : ''}}>{{$item['prefix']. $item['menu_name']}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="menu_name">名称</label>
						<input type="text" name="menu_name" id="menu_name" class="form-control" placeholder="请输入名称" value="{{old('menu_name') ? old('menu_name') : $info->menu_name}}">
					</div>
					<div class="form-group">
						<label for="power_name">权限类型</label>
						<select class="form-control" id="power_name" name="power_name">
							@foreach($powerTypes as $key=>$item)
							@if($key != 'all')
							<option value="{{$item['value']}}" {{old('power_name') ? (old('power_name') == $item['value'] ? 'selected' : '') : ($info->power_name == $item['value'] ? 'selected' : '')}}>
							{{$item['name']}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="menu_url">链接</label>
						<input type="text" name="menu_url" id="menu_url" class="form-control" placeholder="请输入链接" value="{{old('menu_url') ? old('menu_url') : $info->menu_url}}">
					</div>
					<div class="form-group">
						<label for="menu_icon">图标</label>
						<input type="text" name="menu_icon" id="menu_icon" class="form-control" placeholder="请输入图标" value="{{old('menu_icon') ? old('menu_icon') : $info->menu_icon}}">
					</div>
					<div class="form-group">
						<label for="is_show">显示方式</label>
						<select class="form-control" id="is_show" name="is_show">
							@foreach($showTypes as $value=>$text)
							<option value="{{$value}}" {{old('is_show') ? (old('is_show') == $value ? 'selected' : '') : ($info->is_show == $value ? 'selected' : '')}}>{{$text}}</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="sort">排序</label>
						<input type="text" name="sort" id="sort" class="form-control" placeholder="请输入排序" value="{{old('sort') ? old('sort') : $info->sort}}">
					</div>
				</div>
				@include('layout.data_footer')
			</form>
    	</div>
	</section>
@endsection