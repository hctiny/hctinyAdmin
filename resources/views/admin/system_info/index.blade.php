@extends('layout.admin_base')

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
		  <form method="post" action="">
        <div class="box-body">
          {!! csrf_field() !!}
          @foreach($datas as $item)
          <div class="form-group">
            <label for="{{$item->info_name}}">{{$item->info_desc}}</label>
            <input type="text" name="{{$item->info_name}}" id="{{$item->info_name}}" class="form-control" placeholder="请输入{{$item->info_desc}}" value="{{$item->info_value}}">
          </div>
          @endforeach
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-info pull-right">
            提交
          </button>
        </div>
      </form>
    </div>
	</section>
@endsection