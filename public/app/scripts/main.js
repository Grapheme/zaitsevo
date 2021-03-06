/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

// Main module

var App = (function(){
	'use strict';

	//VH fallback for section-main
	$(function(){
		var $sectMain = $('.section-main');
		
		if ( $sectMain.height() == 0 ) {
			
			$sectMain.height( $(window).height() );

			$(window).resize( function(){
				$sectMain.height( $(window).height() );
			});
		}
	})

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

		var	nextArrow = $('.js-next-house');
		var	prevArrow = $('.js-prev-house');

		nextArrow.click( function(){
			var currentElem = $houseTrigger.filter('.active');
			var currentIndex = $houseTrigger.filter('.active').index();

			if( currentElem.is(':last-child') ) {
				currentIndex = $houseTrigger.eq( 0 );
			} else {
				currentIndex = $houseTrigger.eq( currentIndex + 1 );
			}

			currentIndex.trigger('click');

		});

		prevArrow.click( function(){
			var currentElem = $houseTrigger.filter('.active');
			var currentIndex = $houseTrigger.filter('.active').index();

			if( currentElem.is(':first-child') ) {
				currentIndex = $houseTrigger.eq( $houseTrigger.length - 1 );
			} else {
				currentIndex = $houseTrigger.eq( currentIndex - 1 );
			}

			currentIndex.trigger('click');
		});

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

	var planeFlag = true;

	if( !jQuery.browser.mobile ) {
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
			},
			keyframe: function(element, name, direction) {
		        $(element).trigger(name, [direction]);
		    }
		});

		$('.plane').on('data55pTop', function(e, direction) {
		    if (direction == 'down' && planeFlag) {
		    	$('.plane').css({ top: '25%', left: '110%' });
		    	planeFlag = false;
		    }
		});

		//The options (second parameter) are all optional. The values shown are the default values.
		skrollr.menu.init(s, {
		});
	}	

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
	var $coords = {};

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

			$coords = {
				elemX1: elemX1,
				elemX2: elemX2,
				elemY1: elemY1,
				elemY2: elemY2
			};

			$overlay.css({ display: 'block', top: elemY1, left: elemX1, right: elemX2, bottom: elemY2, opacity: '1'  });

			$overlay.fadeIn( 300 ).css({ top: '0', left: '0', right: '0', bottom: '0'  });
			$popup.removeClass('active');

			setTimeout( function(){
				$('[data-popup="' + id + '"]').fadeIn( 400 );
			}, 400);
			

			$html.css({ overflow: 'hidden' });
		},

		close: function(){
			$overlay.css({ display: 'block', top: $coords.elemY1, left: $coords.elemX1, right: $coords.elemX2, bottom: $coords.elemY2, opacity: '0'});

			setTimeout( function(){
				$overlay.fadeOut();
			}, 400);

			$popup.removeClass('active').hide();

			$html.removeAttr('style');
		}

	};

})();
