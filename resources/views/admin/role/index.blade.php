@extends('layout.admin_base')

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
      <div class="box-header">
        <div class="box-title admin-box-title">
          <form class="input-group input-group-sm" method="get" action="">
            <input type="text" name="keyword" value="{{$keyword}}" class="form-control pull-right" placeholder="名称">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
			  <div class="box-tools pull-right">
          @if( $authPowers[$powerTypes['all']['value']] || $authPowers[$powerTypes['add']['value']])
				  <a href="{{ url($curUrl) }}/create" class="btn btn-box-tool" title="添加">
					  <i class="fa fa-plus"></i>
				  </a>
          @endif
			  </div>
      </div>
		  <div class="box-body no-padding">
			  <table class="table">
          <tbody>
            <tr>
              <th>名称</th>
              <th>操作</th>
            </tr>
            @foreach($datas as $item)
            <tr>
              <td>{{$item->role_name}}</td>
              <td>
                @if( $authPowers[$powerTypes['all']['value']] || $authPowers[$powerTypes['power']['value']])
                <a href="{{ url($curUrl) }}/{{$item->id}}/power"
                  title="授权" class="btn btn-warning btn-sm">
                  <i class="fa fa-key"></i>
                </a>
                @endif
                @if( $authPowers[$powerTypes['all']['value']] || $authPowers[$powerTypes['edit']['value']])
                <a href="{{ url($curUrl) }}/{{$item->id}}"
                  title="编辑" class="btn btn-default btn-sm">
                  <i class="fa fa-edit"></i>
                </a>
                @endif
                @if( $authPowers[$powerTypes['all']['value']] || $authPowers[$powerTypes['delete']['value']])
                <a data-toggle="modal" data-target="#del-modal"
                  class="btn btn-danger btn-sm"
                  title="删除" onclick="del('{{ url($curUrl) }}/{{$item->id}}')">
                  <i class="fa fa-close"></i>
                </a>
                @endif
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
		  </div>
		  <div class="box-footer">
        {!! $datas->render('layout.pagination') !!}
      </div>
    </div>
	</section>
@endsection