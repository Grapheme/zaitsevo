@if (@is_object($page->meta->seo))
@section('title'){{ $page->meta->seo->title ? $page->meta->seo->title : $page->name }}@stop
@section('description'){{ $page->meta->seo->description }}@stop
@section('keywords'){{ $page->meta->seo->keywords }}@stop
@elseif (@is_object($page->meta))
@section('title')
{{{ $page->name }}}@stop
@elseif (@is_object($seo))
@section('title'){{ $seo->title }}@stop
@section('description'){{ $seo->description }}@stop
@section('keywords'){{ $seo->keywords }}@stop
@endif
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>

	@include(Helper::layout('head'))

    @section('style')
    @show

    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @include(Helper::layout('header'))

    @section('content')
        {{ @$content }}
    @show

    @include(Helper::layout('footer'))
    @include(Helper::layout('scripts'))

    @section('overlays')
    @show

    @section('scripts')
    @show
</body>
</html>