@foreach( $menus as $menu)
	@if(count($menu['child']) > 0)
		<li class="treeview {{ isset($menu['selected']) && $menu['selected'] ? 'active': ''}}">
		    <a href="javascript:void(0);">
		    	<i class="{{$menu['menu_icon']}}"></i> <span>{{$menu['menu_name']}}</span>
		        <span class="pull-right-container">
		            <i class="fa fa-angle-left pull-right"></i>
		        </span>
		    </a>
		    <ul class="treeview-menu">
		    	@include('layout.menu', ['menus'=>$menu['child']])
		    </ul>
		</li>
	@else
        <li {{isset($menu['selected']) && $menu['selected'] ? 'class=active': ''}}>
        	<a href="{{$menu['menu_url']}}"><i class="{{$menu['menu_icon']}}"></i>{{$menu['menu_name']}}</a>
        </li>
	@endif
@endforeach