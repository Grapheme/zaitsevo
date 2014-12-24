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

	//instafeed init
	// var feed = new Instafeed({
	// 	get: 'user',
	// 	userId: 1521928118,
	// 	clientId: 'a541556dc1cc4a6ab63d72498e28801f',
 //    });
 //    feed.run();

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

	//House plans plugin
	jQuery.fn.housePlans = function() {
		var $elem = $(this);
		var $housePlans = $elem.find('.house-plan');
		var $houseTrigger = $elem.find('.houses-item');

		$houseTrigger.click( function(){
			var plan = $(this).data('plan');
			$houseTrigger.removeClass('active');
			$(this).addClass('active');
			$housePlans.hide();
			$housePlans.filter('[data-plan="' + plan + '"]').fadeIn(400);
		});
	};

	$('.objects-list').objectTabs();
	$('.section-houses-proj').housePlans();

	var s = skrollr.init({
		forceHeight: false,
		constants: {
			map: parseInt( $('.section-map').offset().top ),
			mapend: parseInt( $('.section-map').offset().top + $('.section-map').height() ),
			ffooter: parseInt( $('.section-footer-form').offset().top ),
			ffooterend: parseInt( $('.section-footer-form').offset().top + $('.section-map').height() ),
			//sections
			main: parseInt( $('.section-main').offset().top ),
			about: parseInt( $('.section-about').offset().top ),
		    objects: parseInt( $('.section-objects').offset().top ),
		    areas: parseInt( $('.section-areas').offset().top ),
		    houses: parseInt( $('.section-houses-proj').offset().top )
		}
	});

	//The options (second parameter) are all optional. The values shown are the default values.
	skrollr.menu.init(s, {
	});

	//Form elements init
	$('.checkbox').button();
	$("input[type=file]").nicefileinput({
		label : 'Выберите файл'
	});

	//Mask for phone
	$('.phone-input').inputmask("mask", {"mask": "[+7] (999) 999-9999", showMaskOnHover: false});

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
		Popup.show('order-call', $(this));
	});

	$competBtn.click( function(e){
		e.preventDefault();
		Popup.show('leave-apply', $(this));
	});

	return {

		show: function(id, elem){
			var elemY1 = elem.offset().top - $(window).scrollTop();
			var elemX1 = elem.offset().left;
			var elemY2 = $(window).height() - (elemY1 + elem.height());
			var elemX2 = $(window).width() - (elemX1 + elem.outerWidth());

			$overlay.css({ display: 'block', top: elemY1, left: elemX1, right: elemX2, bottom: elemY2, opacity: '1'  });

			$overlay.fadeIn( 300 ).css({ top: '0', left: '0', right: '0', bottom: '0'  });
			$popup.removeClass('active');

			setTimeout( function(){
				$('[data-popup="' + id + '"]').fadeIn( 400 );
			}, 400);
			

			$html.css({ overflow: 'hidden' });
		},

		close: function(){
			$overlay.css({ opacity: '0' });

			setTimeout( function(){
				$overlay.fadeOut();
			}, 400);

			$popup.removeClass('active').hide();

			$html.removeAttr('style');
		}

	};

})();
