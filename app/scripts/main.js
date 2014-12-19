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
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#theater-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-teatr"></div><h3>Мини театр</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#barbecue-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-barbecue"></div><h3>Зоны барбекю</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#golf-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-golf"></div><h3>Гольф клуб</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#farm-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-cowcow"></div><h3>Частная ферма</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#kindergarden-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-nipple"></div><h3>Детский сад</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#fishing-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-fish"></div><h3>Рыбная ловля</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
						</div>')
		});
		$('#cafe-tip').tooltipster({
			trigger: 'click',
			theme: 'main-tooltips',
			maxWidth: 262,
			content: $('<div class="tooltip-head"><div class="icon icon-cupbook"></div><h3>Кафе</h3></div> \
						<div class="tooltip-body"> \
							<p>Оборудован площадками для занятий футболом,  баскетболом, воллейболом, бегом с количеством мест на 2 000 человек. </p> \
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

	//Page transitions plugin
	jQuery.fn.pageTransitions = function() {
		var $elem = $(this);
		var $sections = $elem.find('.section');
		var mousewheelCount = 0;
		var direction = 'down';
		var cooldown = true;

		// using the event helper
		$elem.mousewheel(function(event) {
			//Return if we already triggered the event
			if( cooldown == false ) return;

			console.log(event.deltaX, event.deltaY, event.deltaFactor);

			//If mousewheel down - go next section
			if( event.deltaY < 0 ) {

				if(event.deltaY == -1) {
					mousewheelCount += 5;
				} else {
					++mousewheelCount;
				} 
			}
			//If mousewheel up - go prev section
			if( event.deltaY > 0 ) {

				if(event.deltaY == 1) {
					mousewheelCount -= 5;
				} else {
					--mousewheelCount;
				}  
			}

			//Now check mouseWheelCount and trigger page changes
			if(mousewheelCount >= 25) {
				//Trigger next-section event
				console.log('mousewheel go next');
				$elem.trigger('next-section');

				//Clear mousewheel count
				mousewheelCount = 0;
			}
			if(mousewheelCount <= -25) {
				//Trigger prev-section event
				console.log('mousewheel go prev');
				$elem.trigger('prev-section');

				//Clear mousewheel count
				mousewheelCount = 0;
			}

		});

		$elem.bind('init', function(){
			$sections.addClass('hidden').removeClass('active');
			$sections.filter(':first-child').removeClass('hidden').addClass('active');
		});

		$elem.bind('show-section', function(e, index) {
			//Show section triggered!
			console.log('next-index is', index);

			$sections.addClass('hidden').removeClass('active');
			$sections.eq(index).removeClass('hidden').addClass('active');
		});

		$elem.bind('next-section', function() {
			console.log('next-section triggered!');
			var $current = $sections.filter('.active').index();

			//If next elem exists
			if( !$sections.eq( $current ).is(':last-child') ) {
				$elem.trigger('show-section',[ $current + 1 ]);
				console.log('go-go-next!')
			}

			cooldown = false;
			setTimeout( function(){
				cooldown = true;
				console.log('cooldown cleaned');
			}, 3000);
		});

		$elem.bind('prev-section', function() {
			console.log('prev-section triggered!');
			var $current = $sections.filter('.active').index();

			//If prev elem exists
			if( !$sections.eq( $current ).is(':first-child') ) {
				$elem.trigger('show-section',[ $current - 1 ]);
				console.log('go-go-prev!')
			}

			cooldown = false;
			setTimeout( function(){
				cooldown = true;
			}, 1000);
		});

		//Init plugin
		$elem.trigger('init');
	};

	$('.main-wrapper').pageTransitions();

})();

// Popup module

var Popup = (function(){
	'use strict';

	var $overlay = $('.overlay');
	var $popup = $('.popup');
	var $close = $('.js-popup-close');
	var $orderBtn = $('.js-btn-order');
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
