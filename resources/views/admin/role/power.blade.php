@extends('layout.admin_base')

@section('style')
	<style>
		.box-body>.checkbox{
			display: inline-block;
			margin: 0;
			margin-left: 10px;
		}
	</style>
@endsection

@section('content')
	@parent
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title">{{ $info->role_name }}权限</div>
				<label class="checkbox" style="float: right; margin: 0" for="check_all">
                    <input type='checkbox' id="check_all">
                    全选
                </label>
			</div>
			<form method="post" action="">
				{!! csrf_field() !!}
				<div class="box-body">
					<div class="row" id="all_check">
                        @foreach($powers as $item)
                            <div class='col-md-6'>
						    @include('layout.power_menu', ['powers'=>$item])
                            </div>
                        @endforeach
					</div>
				</div>
				@include('layout.data_footer')
			</form>
		</div>
	</section>
@endsection

@section('script')
	<script type="text/javascript">
		$("#check_all").click(function(){
            if(this.checked){
                $("#all_check").find(":checkbox").prop("checked", true);
            }else{
                $("#all_check").find(":checkbox").prop("checked", false);
            }
        });

        function checknode(obj) {

            var level_bottom;

            var chk = $("input[type='checkbox']");
            var count = chk.length;
            var num = chk.index(obj);
            var level_top = level_bottom = chk.eq(num).attr('level');

            for (var i = num; i >= 0; i--) {
                var le = chk.eq(i).attr('level');
                if (eval(le) < eval(level_top)) {
                    chk.eq(i).prop("checked", true);
                    level_top = level_top - 1;
                }
            }

            for (var j = num + 1; j < count; j++) {
                le = chk.eq(j).attr('level');
                if (chk.eq(num).prop("checked")) {
                    if (eval(le) > eval(level_bottom)) {

                        chk.eq(j).prop("checked", true);
                    }
                    else if (eval(le) == eval(level_bottom)) {
                        break;
                    }
                } else {
                    if (eval(le) > eval(level_bottom)) {
                        chk.eq(j).prop("checked", false);
                    } else if (eval(le) == eval(level_bottom)) {
                        break;
                    }
                }
            }
        }
	</script>
@endsection