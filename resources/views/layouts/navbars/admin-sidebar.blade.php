@foreach($items as $menu_item)
<li class="nav-item">
	<a class="nav-link" href="{{ $menu_item->route ? route($menu_item->route) : $menu_item->url }}">
		<i class="{{ $menu_item->icon_class }}"></i> {{ __($menu_item->title) }}
	</a>
</li>
@endforeach