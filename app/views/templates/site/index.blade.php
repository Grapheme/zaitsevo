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
Helper::tad($specials);
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
                <div id="stadium-tip" class="map-mark stadium" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="theater-tip" class="map-mark theater" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="barbecue-tip" class="map-mark barbecue" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-55p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="golf-tip" class="map-mark golf" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="farm-tip" class="map-mark farm" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="kindergarden-tip" class="map-mark kindergarden" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="fishing-tip" class="map-mark fishing" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
                <div id="cafe-tip" class="map-mark cafe" data-75p-top="transform: translate(0, 200%) scale(0.8); opacity: 0;" data-60p-top="transform: translate(0,0) scale(1); opacity: 1"></div>
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

        <!-- House project section -->
        <section id="spec-offering" class="section section-houses-proj">

            <div class="section-cont">

                <div class="house-plan" data-plan="1">
                    <h2 class="twig--green">
                        Каркасный одноэтажный дом<br>
                        108 м<sup>2</sup> (9*12 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/01.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/01-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            820 тыс. рублей за базовую комплектацию
                        </li><!--

						 --><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
                <div class="house-plan" style="display: none;" data-plan="2">
                    <h2 class="twig--green">
                        Каркасный одноэтажный дом<br>
                        63 м<sup>2</sup> (7*9 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/02.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/02-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            600 тыс. рублей за базовую комплектацию
                        </li><!--

						--><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
                <div class="house-plan" style="display: none;" data-plan="3">
                    <h2 class="twig--green">
                        Каркасный одноэтажный дом<br>
                        78 м<sup>2</sup> (7,5*10,5 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/03.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/03-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            670 тыс. рублей за базовую комплектацию
                        </li><!--

						 --><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
                <div class="house-plan" style="display: none;" data-plan="4">
                    <h2 class="twig--green">
                        Каркасный одноэтажный дом<br>
                        90 м<sup>2</sup> (7,5*12 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/04.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/04-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            740 тыс. рублей за базовую комплектацию
                        </li><!--

						 --><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
                <div class="house-plan" style="display: none;" data-plan="5">
                    <h2 class="twig--green">
                        Каркасный одноэтажный<br>
                        дом 72 м<sup>2</sup> (8*9 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/05.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/05-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            620 тыс. рублей за базовую комплектацию
                        </li><!--

						 --><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
                <div class="house-plan" style="display: none;" data-plan="6">
                    <h2 class="twig--green">
                        Каркасный одноэтажный дом<br>
                        82,8 м<sup>2</sup> (9*9,2 м)
                    </h2>

                    <div class="house-pict">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/06.png" alt="">
                    </div><!--

					 --><div class="house-plan-top">
                        <img src="{{ Config::get('site.theme_path') }}/images/plans/06-plan.png" alt="">
                    </div>

                    <ul class="house-props">

                        <li class="house-props-item">
                            670 тыс. рублей за базовую комплектацию
                        </li><!--

						 --><li class="house-props-item">
                            Строительно-монтажные работы, материалы и доставка
                            на объект включены в стоимость.
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="houses-list">

                <li class="houses-item active" data-plan="1">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/01.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 108 м<sup>2</sup>
							</span>
                    </div>
                </li><!--

				 --><li class="houses-item" data-plan="2">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/02.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 63 м<sup>2</sup>
							</span>
                    </div>
                </li><!--

				 --><li class="houses-item" data-plan="3">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/03.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 78 м<sup>2</sup>
							</span>
                    </div>
                </li><!--

				 --><li class="houses-item" data-plan="4">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/04.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 90 м<sup>2</sup>
							</span>
                    </div>
                </li><!--

				 --><li class="houses-item" data-plan="5">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/05.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 72 м<sup>2</sup>
							</span>
                    </div>
                </li><!--

					--><li class="houses-item" data-plan="6">
                    <div class="houses-item-cover" style="background-image: url({{ Config::get('site.theme_path') }}/images/plans/06.png)">

                    </div>
                    <div class="houses-item-desc">
							<span>
								Каркасный одноэтажный дом 82,8 м<sup>2</sup>
							</span>
                    </div>
                </li>
            </ul>
        </section>
        <!-- End of house project section -->

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

                        <form id="feedback-form" class="feedback-form" action="" method="post" novalidate="novalidate">

                            <fieldset>

                                <textarea></textarea>
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
@stop