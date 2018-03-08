@foreach($powers as $power)
@if($power['level'] == 0 || count($power['child']) > 0)
<div class='box box-widget'>
    <div class='box-header'>
        <input type='checkbox' onclick='checknode(this)' name='menu_id[]' value="{{$power['id']}}" level='{{$power["level"]}}' {{isset($power['selected']) && $power['selected'] ? 'checked' : ''}}>
        <h3 class='box-title'>{{$power['menu_name']}}</h3>
    </div>
    @if(count($power['child']) > 0)
    <div class='box-body'>
    	@include('layout.power_menu',['powers'=>$power['child']])
    </div>
    @endif
</div>
@else
<div class='checkbox'>
    <label>
    	<input type='checkbox' onclick='checknode(this)' name='menu_id[]' value='{{$power["id"]}}' level='{{$power["level"]}}' {{isset($power['selected']) && $power['selected'] ? 'checked' : ''}}>
        {{$power['menu_name']}}
    </label>
</div>
@endif
@endforeach