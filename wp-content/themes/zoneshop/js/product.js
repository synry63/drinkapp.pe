/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {
	var pluses = /\+/g;
	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}
	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}
	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}
	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}
		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {
		// Write
		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}
		// Read

		var result = key ? undefined : {};
		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));
/* utility functions*/
(function ($) {
	"use strict";

	/* Process show popup cart when hover cart info */
	var miniCartHover = function () {
		jQuery(document).on('mouseover', '.minicart_hover', function () {
			jQuery(this).children('.widget_shopping_cart_content').slideDown();
		}).on('mouseleave', '.minicart_hover', function () {
			jQuery(this).children('.widget_shopping_cart_content').delay(100).slideUp();
		});

		jQuery(document)
			.on('mouseenter', '.widget_shopping_cart_content', function () {
				jQuery(this).stop(true, true).show()
			})
			.on('mouseleave', '.widget_shopping_cart_content', function () {
				jQuery(this).delay(100).slideUp()
			});
	}
	/* Product Grid, List Switch */
	var listSwitcher = function () {
		var activeClass = 'switcher-active';
		var gridClass = 'product-grid';
		var listClass = 'product-list';
		jQuery('.switchToList').click(function () {
			if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid') {
				switchToList();
			}
		});
		jQuery('.switchToGrid').click(function () {
			if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list') {
				switchToGrid();
			}
		});

		function switchToList() {
			jQuery('.switchToList').addClass(activeClass);
			jQuery('.switchToGrid').removeClass(activeClass);
			jQuery('.archive_switch').fadeOut(300, function () {
				jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
				jQuery.cookie('products_page', 'list', {expires: 3, path: '/'});
			});
		}

		function switchToGrid() {
			jQuery('.switchToGrid').addClass(activeClass);
			jQuery('.switchToList').removeClass(activeClass);
			jQuery('.archive_switch').fadeOut(300, function () {
				jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
				jQuery.cookie('products_page', 'grid', {expires: 3, path: '/'});
			});
		}
	}

	var check_view_mod = function () {
		var activeClass = 'switcher-active';
		if (jQuery.cookie('products_page') == 'grid') {
			jQuery('.archive_switch').removeClass('product-list').addClass('product-grid');
			jQuery('.switchToGrid').addClass(activeClass);
		} else if (jQuery.cookie('products_page') == 'list') {
			jQuery('.archive_switch').removeClass('product-grid').addClass('product-list');
			jQuery('.switchToList').addClass(activeClass);

			//var data = {action: 'list_grid', product: list };
			//$.post(ajaxurl, data, function (response) {});
		}
		else {
			jQuery('.switchToGrid').addClass(activeClass);
			jQuery('.archive_switch').removeClass('product-list').addClass('product-grid');
		}
	}

	if (jQuery("body.woocommerce").length) {
		check_view_mod();
		listSwitcher();
	}
	miniCartHover();
	/* ****** PRODUCT QUICK VIEW  ******/

	$('.quick-view').click(function (e) {
		/* add loader  */
		$(this).css('display', 'none');
		$(this).after('<a href="javascript:;" class="loading dark"></a>');
		var product_id = $(this).attr('data-prod');
		var data = {action: 'jck_quickview', product: product_id};
		$.post(ajaxurl, data, function (response) {
			$.magnificPopup.open({
				mainClass: 'my-mfp-zoom-in',
				items    : {
					src : '<div class="mfp-iframe-scaler">' + response + '</div>',
					type: 'inline'
				}
			});
			$('.quick-view').css('display', 'inline-block');
			$('.loading').remove();
			setTimeout(function () {
				jQuery( '.product .variations_form' ).wc_variation_form();
				jQuery( '.product .variations_form .variations select' ).change();
			}, 600);
		});
		e.preventDefault();
	});
	/* category toggle */
	jQuery('.product-categories li.cat-parent >a').before('<span class="icon-toggle"><i class="fa fa-caret-right"></i></span>');
	jQuery('.product-categories li.cat-parent .icon-toggle').click(function () {
		//alert('test');
		if (jQuery(this).parent().find('ul.children').is(':hidden')) {
			jQuery(this).parent().find('ul.children').slideDown(500, 'linear');
			jQuery(this).html('<i class="fa fa-caret-down"></i>');
		}
		else {
			jQuery(this).parent().find('ul.children').slideUp(500, 'linear');
			jQuery(this).html('<i class="fa fa-caret-right"></i>');
		}
	});

	// single product
	$(document).ready(function () {
		if (jQuery().retina) {
			$(".retina").retina({preload: true})
		}
		if (jQuery().flexslider && jQuery(".woocommerce #carousel").length >= 1) {
			var e = 100;
			if (typeof jQuery(".woocommerce #carousel").data("flexslider") != "undefined") {
				jQuery(".woocommerce #carousel").flexslider("destroy");
				jQuery(".woocommerce #slider").flexslider("destroy")
			}
			jQuery(".woocommerce #carousel").flexslider({
				animation    : "slide",
				controlNav   : !1,
				directionNav : !1,
				animationLoop: !1,
				slideshow    : !1,
				itemWidth    : 91,
				itemMargin   : 5,
				touch        : !1,
				useCSS       : !1,
				asNavFor     : ".woocommerce #slider",
				smoothHeight : !1
			});


			jQuery(".woocommerce #slider").flexslider({
				animation    : "slide",
				controlNav   : !1,
				directionNav : !1,
				animationLoop: !1,
				slideshow    : !1,
				smoothHeight : !0,
				touch        : !0,
				useCSS       : !1,
				sync         : ".woocommerce #carousel"
			});

		}
	});
	//end single product

})(jQuery);