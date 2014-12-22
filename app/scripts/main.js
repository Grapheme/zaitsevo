// Main module

var App = (function(){
	'use strict';

	//fancybox init
	$(function(){
		$('.fancybox').fancybox({
			helpers: {
				overlay: {
					locked: false
				}
			}
		});
	});

	//tooltips init
	$(function(){
		$('#stadium-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-stadium"></div><h3>Стадион</h3></div> \
						<div class="tooltip-body"> \
							<p>Стадион оборудован футбольной, баскетбольной, беговой, волейбольной, теннисной площадками с количеством мест на 2000 человек. </p> \
						</div>')
		});
		$('#theater-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-teatr"></div><h3>Мини театр</h3></div> \
						<div class="tooltip-body"> \
							<p>Зал вмещает 500 зрителей. Полностью технически оснащен для постановки представлений и изготовления костюмов и декораций. Порадуйте своим творчеством близких и друзей.</p> \
						</div>')
		});
		$('#barbecue-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-barbecue"></div><h3>Зоны барбекю</h3></div> \
						<div class="tooltip-body"> \
							<p>Общая зона барбекю для сбора веселой компании и приготовления мяса и частной фермы и закусок. </p> \
						</div>')
		});
		$('#golf-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-golf"></div><h3>Гольф клуб</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудованный по последним тенденциям лучших гольф-клубов для изысканного отдыха серьезных мужчин. </p> \
						</div>')
		});
		$('#farm-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-cowcow"></div><h3>Частная ферма</h3></div> \
						<div class="tooltip-body"> \
							<p>В  животноводческой ферме в экологически чистых условиях заботливо выращиваются сельскохозяйственные животные. При ферме есть эко-магазин, в котором каждый день можно приобрести свежайшие продукты. </p> \
						</div>')
		});
		$('#kindergarden-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-nipple"></div><h3>Детский сад</h3></div> \
						<div class="tooltip-body"> \
							<p>Детский сад «Зеленая школа» гордится опытными педагогами, игровой образовательной атмосферой и воспитанием в ваших малышах любви и заботы к окружающему миру. </p> \
						</div>')
		});
		$('#fishing-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-fish"></div><h3>Рыбная ловля</h3></div> \
						<div class="tooltip-body"> \
							<p>Рыболовное хозяйство предоставляет возможность коммерческой рыбалки. Но можно рыбачить и просто для удовольствия. Оборудованы, чтобы вы не отвлекались на мелочи. </p> \
						</div>')
		});
		$('#cafe-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-cupbook"></div><h3>Кафе</h3></div> \
						<div class="tooltip-body"> \
							<p>В уютном кафе за любимой книгой из небольшой библиотеки можно насладиться ароматным кофе и чаем и попробовать вкуснейшую домашнюю выпечку. </p> \
						</div>')
		});
	});

	//Objects plugin
	jQuery.fn.objectTabs = function() {
		var element = $(this),
			objLinks = element.find('.objects-item'),
			objTabs = element.find('.obj-tabs'),
			objTabItem = element.find('.obj-tab-item'),
			closeBtn = element.find('.js-tabs-close'),
			leftBtn = element.find('.js-nav-left'),
			rightBtn = element.find('.js-nav-right');

		closeBtn.click( function(){
			element.trigger('close-tabs');
		});

		leftBtn.click( function(){
			element.trigger('prev-obj-tab');
		});

		rightBtn.click( function(){
			element.trigger('next-obj-tab');
		});

		objLinks.click( function(){
			element.trigger('open-tabs', [$(this)]);
		});

		element.bind('open-tabs', function(e, elem){
			var $elemId = elem.attr('id');

			objTabs.removeClass('hidden');
			objTabItem.addClass('hidden').removeClass('active').filter('[data-to="' + $elemId + '"]').addClass('active').removeClass('hidden');
		});

		element.bind('close-tabs', function(){
			objTabs.addClass('hidden');
			objTabItem.addClass('hidden');
		});

		element.bind('next-obj-tab', function(){
			var currentElem = objTabItem.filter('.active');
			var nextElem;

			if( currentElem.is(':last-child') ) {
				nextElem = objTabItem.filter(':first-child');
			} else {
				nextElem = currentElem.next();
			}
			objTabItem.addClass('hidden').removeClass('active');
			nextElem.removeClass('hidden').addClass('active');
		});

		element.bind('prev-obj-tab', function(){
			var currentElem = objTabItem.filter('.active');
			var prevElem;

			if( currentElem.is(':first-child') ) {
				prevElem = objTabItem.filter(':last-child');
			} else {
				prevElem = currentElem.prev();
			}
			objTabItem.addClass('hidden').removeClass('active');
			prevElem.removeClass('hidden').addClass('active');
		});
	};

	$('.objects-list').objectTabs();

	var s = skrollr.init({
		forceHeight: false,
		constants: {
			map: parseInt( $('.section-map').offset().top ),
			mapend: parseInt( $('.section-map').offset().top + $('.section-map').height() ),
			ffooter: parseInt( $('.section-footer-form').offset().top ),
			ffooterend: parseInt( $('.section-footer-form').offset().top + $('.section-map').height() )
		}
	});

	//The options (second parameter) are all optional. The values shown are the default values.
	skrollr.menu.init(s, {
	});

	//Form elements init
	$('.checkbox').button();

	//Mask for phone
	$('.phone-input').inputmask("mask", {"mask": "[+7] (999) 999-9999", showMaskOnHover: false});

	// Validation
	$('#feedback-form').validate({
		rules: {
			phone: 'required',
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			phone: 'Обязательное поле',
			email: {
				required: 'Обязательное поле',
				email: 'Неверный формат'
			}
		}
	});

	$('.order-call-form').validate({
		rules: {
			phone: 'required',
			name: 'required'
		},
		messages: {
			phone: 'Обязательное поле',
			name: 'Обязательное поле'
		}
	});

})();

// Popup module

var Popup = (function(){
	'use strict';

	var $overlay = $('.overlay');
	var $popup = $('.popup');
	var $close = $('.js-popup-close');
	var $orderBtn = $('.js-btn-order');
	var $competBtn = $('.js-btn-compet');
	var $html = $('html');

	$close.click( function(){
		Popup.close();
	});

	$popup.click( function(e){
		e.stopPropagation();
	});

	$overlay.click( function(){
		Popup.close();
	});

	$orderBtn.click( function(e){
		e.preventDefault();
		Popup.show('order-call');
	});

	$competBtn.click( function(e){
		e.preventDefault();
		Popup.show('leave-apply');
	});

	return {

		show: function(id){
			$overlay.fadeIn( 400 );
			$popup.removeClass('active');
			$('[data-popup="' + id + '"]').addClass('active');

			$html.css({ overflow: 'hidden' });
		},

		close: function(){
			$overlay.fadeOut( 400 );
			$popup.removeClass('active');

			$html.removeAttr('style');
		}

	};

})();
