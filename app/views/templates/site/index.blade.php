<?
/**
 * TITLE: Главная страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$objects = Dic::valuesBySlug('infrastructure', function($query){
    $query->orderBy('lft', 'ASC');
});
$objects = DicVal::extracts($objects, null, true);
#Helper::tad($objects);

$specials = Dic::valuesBySlug('specials', function($query){
    $query->orderBy('lft', 'ASC');
});
$specials = DicVal::extracts($specials, null, true);
$specials = DicLib::loadImages($specials, ['special_photo', 'special_plan']);
#Helper::tad($specials);
?>
@extends(Helper::layout())


@section('style')
@stop


@section('content')


    <div class="main-wrapper">
        <!-- Main section -->
        <section class="section section-main" style="height:700px !important;">

            <h1>
                {{ $page->block('h1') }}
            </h1>

            <div class="btn-scroll-cont" data-55p-top="opacity: 1; transform: translate(0, 0%)" data-30p-top="transform: translate(0, 150%)" data-15p-top="opacity: 0;">
                <div class="btn btn--small btn--scroll btn--decorated">
                    <div class="btn--scroll-dec"></div>
                    О поселке
                </div>
            </div>

            <div class="clouds">
                <div class="cloud cloud--small cloud-1" data--100p="right: 46%" data-100p="right: 18%"></div>
                <div class="cloud cloud--small cloud-2" data--50p="right: 56%" data-100p="right: 15%"></div>
                <div class="cloud cloud--big cloud-3" data--100p="right: 46%" data-100p="right: 66%"></div>
            </div>
        </section>
        <!-- End of main section -->

        <!-- About section -->
        <section id="about" data-menu-offset="-150" class="section section-about">

            <div class="section-cont">

                {{ $page->block('about') }}

                <div class="btn-scroll-cont" data-75p-top="transform: translate(0, 100%)" data-50p-top="transform: translate(0,0); opacity: 1;" data-35p-top="opacity: 0; transform: translate(0, -50%)">
                    <div class="btn btn--small btn--scroll btn--decorated">
                        <div class="btn--scroll-dec"></div>
                        Участки
                    </div>
                </div>
            </div>
        </section>
        <!-- End of about section -->

        <!-- Map section -->
        <section id="map" data-menu-offset="100" class="section section-map">

            <img src="{{ Config::get('site.theme_path') }}/images/map.jpg" alt="" data-75p-top="transform: translate(0, 5%)" data-35p-top="transform: translate(0,0)">

            <div class="map-marks">
                <div id="stadium-tip" class="map-mark stadium"></div>
                <div id="theater-tip" class="map-mark theater"></div>
                <div id="barbecue-tip" class="map-mark barbecue"></div>
                <div id="golf-tip" class="map-mark golf"></div>
                <div id="cowcow-tip" class="map-mark cowcow"></div>
                <div id="nipple-tip" class="map-mark nipple"></div>
                <div id="fish-tip" class="map-mark fish"></div>
                <div id="cupbook-tip" class="map-mark cupbook"></div>
            </div>

            <div class="btn-scroll-cont" data-75p-top="opacity: 1; transform: translate(0, 0%)" data-55p-top="transform: translate(0, -100%)" data-15p-top="opacity: 0;">
                <div class="btn btn--small btn--scroll btn--decorated">
                    <div class="btn--scroll-dec"></div>
                    Инфраструктура
                </div>
            </div>
        </section>
        <!-- End of map section -->

        <!-- Getto section -->
        <section class="section section-getto section-short">
            <h2 data-75p-top="transform: translate(0, 50%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">

                {{ $page->block('slogan1') }}

            </h2>
            <a href="#" class="btn btn--blue btn--decorated js-btn-order" data-75p-top="transform: translate(0, 50%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">Заказать звонок</a>
        </section>
        <!-- End of getto section -->

        @if (count($objects))
        <!-- Objects section -->
        <section id="infrastructure" class="section section-objects">

            <div class="section-cont">
                <div class="objects-list">

                    <!--
                    <?
                    $i = 0;
                    ?>
                    @foreach ($objects as $object)

                        <?
                            $o = 55 - $i;
                        ?>
                        --><div class="objects-item" id="obj-{{ $object->slug }}" data-75p-top="transform: translate(0, 100%) scale(0.8)" data-{{ $o }}p-top="transform: translate(0,0) scale(1)">
                            <div class="objects-item-head">
                                <div class="icon icon-{{ $object->slug }}"></div>
                                <h3>{{ $object->name }}</h3>
                            </div>
                        </div><!--
                        <?
                        ++$i;
                        ?>
                    @endforeach
                    -->

                    <div class="obj-tabs hidden">
                        <div>

                            <?
                            $i = 0;
                            ?>
                            @foreach ($objects as $object)

                                <?
                                $text = explode("\n", $object->list_description);
                                ?>
                                <div class="obj-tab-item hidden" data-to="obj-{{ $object->slug }}">
                                    <div class="obj-tab-head twig--brown">
                                        <div class="obj-tab-icon icon icon-{{ $object->slug }}"></div>
                                        <h3>{{ $object->name }}</h3>
                                        <div class="js-tabs-close">
                                            <span class="obj-cross-icon icon icon-cross"></span>
                                        </div>
                                    </div>
                                    <div class="obj-tab-body">
                                        <p>
                                            {{ implode('</p><p>', $text) }}
                                        </p>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <div class="obj-tabs-nav">
                            <span class="icon icon-arrow_left js-nav-left"></span>
                            <span class="icon icon-arrow_right js-nav-right"></span>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End of objects section -->
        @endif

        <!-- Areas section -->
        <section id="areas" class="section section-areas">

            <div class="section-cont">

                <div class="section-area-half" data-75p-top="transform: translate(0, 100%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">

                    {{ $page->block('areas') }}

                </div><!--

				 --><div class="section-area-half" data-75p-top="transform: translate(0, 100%) scale(0.8)" data-50p-top="transform: translate(0,0) scale(1)">

                    {{ $page->block('grants') }}

                </div>
            </div>
        </section>
        <!-- End of areas section -->

        <!-- Getto section -->
        <section class="section section-no-troubles section-short">
            <h2 data-75p-top="transform: translate(0, 50%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">

                {{ $page->block('slogan2') }}

            </h2>
            <a href="#" class="btn btn--blue btn--decorated js-btn-order" data-75p-top="transform: translate(0, 50%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">Заказать звонок</a>
        </section>
        <!-- End of getto section -->

        @if (count($specials))
        <!-- House project section -->
        <section id="spec-offering" class="section section-houses-proj">

            <div class="section-cont">

                <?
                $i = 0;
                ?>
                @foreach ($specials as $special)
                <?
                ++$i;
                $lines = explode("\n", $special->special_description);
                ?>
                <div class="house-plan" @if($i > 1) style="display: none;" @endif data-plan="{{ $i }}">
                    <h2 class="twig--green">
                        {{ $special->name }}
                    </h2>

                    <div class="house-pict">
                        <img src="{{ $special->special_photo->full() }}" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ $special->special_plan->full() }}" alt="">
                    </div>

                    @if (count($lines))
                    <ul class="house-props">
                        <!--
                        @foreach ($lines as $line)
                            --><li class="house-props-item">
                                {{ $line }}
                            </li><!--
                        @endforeach
                        -->
                    </ul>
                    @endif
                </div>
                @endforeach


            </div>
            <ul class="houses-list">

                <!--
                <?
                $i = 0;
                ?>
                @foreach ($specials as $special)
                <?
                ++$i;
                ?>
                    --><li class="houses-item @if($i == 1) active @endif" data-plan="{{ $i }}">
                        <div class="houses-item-cover" style="background-image: url({{ $special->special_photo->full() }})">
                        </div>
                        <div class="houses-item-desc">
							<span>
								{{ $special->name }}
							</span>
                        </div>
                    </li><!--
                @endforeach
                -->

            </ul>
        </section>
        <!-- End of house project section -->
        @endif

        <!-- Footer form section -->
        <section class="section section-footer-form">

            <div class="section-cont">

                <div class="section-form-half callback" data-75p-top="transform: translate(0, 100%) scale(0.8)" data-55p-top="transform: translate(0,0) scale(1)">

                    <div class="section-form-head twig--green" data-150p-top="background-position: 80% 100%" data-55p-top="background-position: 0% 100%">

                        <h2>
                            Перезвоните мне
                        </h2>
                    </div>

                    <div class="section-form-body">

                        <p>

                            {{ $page->block('call_me') }}

                        </p>

                        <button class="btn btn--big-green js-btn-order">
                            Обратный звонок
                        </button>

                        {{ $page->block('social') }}

                    </div>

                </div><!--

				 --><div class="section-form-half feedback" data-75p-top="transform: translate(0, 100%) scale(0.8)" data-50p-top="transform: translate(0,0) scale(1)">

                    <div class="section-form-head twig--brown" data-150p-top="background-position: 100% 100%" data-55p-top="background-position: 0% 100%">

                        <h2>
                            Написать письмо
                        </h2>
                    </div>

                    <div class="section-form-body">

                        <form action="{{ URL::route('ajax.send-message') }}" method="POST" id="feedback-form" class="feedback-form" novalidate="novalidate">

                            <fieldset>

                                <textarea name="text"></textarea>
                            </fieldset>
                            <fieldset>

                                <div class="col col-half">
                                    <label>Ваш email</label>
                                    <input name="email" type="text">
                                </div><!--

								 --><div class="col col-half">
                                    <label>Телефон</label>
                                    <input name="phone" class="phone-input" type="text">
                                </div>
                            </fieldset>
                            <button class="btn btn--big-green">
                                Отправить письмо
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <h3 class="last-slogan">

                {{ $page->block('slogan3') }}

            </h3>
        </section>
        <!-- End of footer form section-->

    </div>

@stop


@section('scripts')

    @if (count($objects))
    <script>
        //facebook resizing
        $(window).bind("load resize", function(){    
          var container_width = $('#fbcontainer').width();
            $('#fbcontainer').html('<div class="fb-like-box" data-href="https://www.facebook.com/zaitsevo"' +
              'data-width="' + container_width + '" data-height="217" data-colorscheme="light"' + 
              'data-show-faces="true"' +
              'data-header="false" data-stream="false" data-show-border="true"></div>');
              FB.XFBML.parse( );                  
        });

        //tooltips init
        $(function(){

            @foreach ($objects as $object)
            <?
            $text = explode("\n", $object->map_description);
            ?>
            $('#{{ $object->slug }}-tip').tooltipster({
                trigger: 'click',
                theme: 'main-tooltips',
                maxWidth: 262,
                content: $('<div class="tooltip-head"><div class="icon icon-{{ $object->slug }}"></div><h3>{{ $object->name }}</h3></div> \
                    <div class="tooltip-body"> \
                        <p>{{ implode('</p><p>', $text) }}</p> \
                    </div>')
            });
            @endforeach
            $(window).scroll( function(){
                $('.map-mark').tooltipster('hide');
            }); 
        });
    </script>
    @endif

@stop