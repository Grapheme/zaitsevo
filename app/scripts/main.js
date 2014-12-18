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

})();
