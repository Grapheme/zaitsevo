var App=function(){"use strict";$(function(){$(".fancybox").fancybox({helpers:{overlay:{locked:!1}}})}),jQuery.fn.objectTabs=function(){var t=$(this),e=t.find(".objects-item"),o=t.find(".obj-tabs"),s=t.find(".obj-tab-item"),i=t.find(".js-tabs-close"),n=t.find(".js-nav-left"),a=t.find(".js-nav-right");i.click(function(){t.trigger("close-tabs")}),n.click(function(){t.trigger("prev-obj-tab")}),a.click(function(){t.trigger("next-obj-tab")}),e.click(function(){t.trigger("open-tabs",[$(this)])}),t.bind("open-tabs",function(t,e){var i=e.attr("id");o.removeClass("hidden"),s.addClass("hidden").removeClass("active").filter('[data-to="'+i+'"]').addClass("active").removeClass("hidden")}),t.bind("close-tabs",function(){o.addClass("hidden"),s.addClass("hidden")}),t.bind("next-obj-tab",function(){var t,e=s.filter(".active");t=e.is(":last-child")?s.filter(":first-child"):e.next(),s.addClass("hidden").removeClass("active"),t.removeClass("hidden").addClass("active")}),t.bind("prev-obj-tab",function(){var t,e=s.filter(".active");t=e.is(":first-child")?s.filter(":last-child"):e.prev(),s.addClass("hidden").removeClass("active"),t.removeClass("hidden").addClass("active")})},jQuery.fn.housePlans=function(){var t=$(this),e=t.find(".house-plan"),o=t.find(".houses-item");o.click(function(){var t=$(this).data("plan");o.removeClass("active"),$(this).addClass("active"),e.hide(),e.filter('[data-plan="'+t+'"]').fadeIn(400)})},$(".objects-list").objectTabs(),$(".section-houses-proj").housePlans();var t=skrollr.init({forceHeight:!1,constants:{map:parseInt($(".section-map").offset().top),mapend:parseInt($(".section-map").offset().top+$(".section-map").height()),ffooter:parseInt($(".section-footer-form").offset().top),ffooterend:parseInt($(".section-footer-form").offset().top+$(".section-map").height()),main:parseInt($(".section-main").offset().top),about:parseInt($(".section-about").offset().top),objects:parseInt($(".section-objects").offset().top),areas:parseInt($(".section-areas").offset().top),houses:parseInt($(".section-houses-proj").offset().top)}});skrollr.menu.init(t,{}),$(".checkbox").button(),$("input[type=file]").nicefileinput({label:"Выберите файл"}),$(".phone-input").inputmask("mask",{mask:"[+7] (999) 999-9999",showMaskOnHover:!1})}(),Popup=function(){"use strict";var t=$(".overlay"),e=$(".popup"),o=$(".js-popup-close"),s=$(".js-btn-order"),i=$(".js-btn-compet"),n=$("html");return o.click(function(){Popup.close()}),e.click(function(t){t.stopPropagation()}),t.click(function(){Popup.close()}),s.click(function(t){t.preventDefault(),Popup.show("order-call",$(this))}),i.click(function(t){t.preventDefault(),Popup.show("leave-apply",$(this))}),{show:function(o,s){var i=s.offset().top-$(window).scrollTop(),a=s.offset().left,c=$(window).height()-(i+s.height()),r=$(window).width()-(a+s.outerWidth());t.css({display:"block",top:i,left:a,right:r,bottom:c,opacity:"1"}),t.fadeIn(300).css({top:"0",left:"0",right:"0",bottom:"0"}),e.removeClass("active"),setTimeout(function(){$('[data-popup="'+o+'"]').fadeIn(400)},400),n.css({overflow:"hidden"})},close:function(){t.css({opacity:"0"}),setTimeout(function(){t.fadeOut()},400),e.removeClass("active").hide(),n.removeAttr("style")}}}();