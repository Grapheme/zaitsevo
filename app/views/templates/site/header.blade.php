<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<header class="main-header" data-start="box-shadow: 6px 0px 0px 0 rgba(0, 0, 0, 0); height: 9.6875rem;" data-150-start="box-shadow: 6px 1px 4px 0 rgba(0, 0, 0, 0.3); background-position: 0 0; height: 6rem;" data-_map--10p="background-position: 0 0%;" data-_map-10p="background-position: 0 200%; box-shadow: 0px 0px 0px 0 rgba(0, 0, 0, 0);" data-_mapend--10p="background-position: 0 200%;" data-_mapend-1p="background-position: 0 200%;" data-_mapend-2p="background-position: 0 0%; box-shadow: 6px 1px 4px 0 rgba(0, 0, 0, 0.3);">

    <div class="contacts">
        <div class="phone">

            {{ $page->block('phones') }}

        </div>
        <div data-start="transform: scale(1);" data-150-start="transform: scale(0)" class="order-a-call btn btn--small btn--green btn--decorated js-btn-order">
            Заказать звонок
        </div>
    </div>

    <div class="logo" data-start="background-size: 100% 100%;" data-150-start="background-size: 0% 0%;">

    </div>

    <nav role="navigation">

        {{ Menu::placement('main_menu') }}

    </nav>
</header>
