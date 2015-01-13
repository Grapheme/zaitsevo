@if(!empty($menu))
<ul class="nav-list list-unstyled max-width-class text-center">
	@foreach($menu as $url => $name)
		<li class="nav-item"><a href="{{ link::to($url) }}" data-anchor-target="{{ $url }}" data-bottom-top="@class:inactive" data-50-top="@class:active" data-50-top-bottom="@class:inactive">{{$name}}</a>
	@endforeach
	</ul>
@endif