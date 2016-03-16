/* utility functions*/
(function ($) {
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];  // vendors   = ['Khtml', 'Ms','Moz','Webkit','O'];  exclude opera for the moment. stil to buggy
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());
	;
	(function ($) {
		$.fn.extend({
			donetyping: function (callback, timeout) {
				timeout = timeout || 1e3; // 1 second default timeout
				var timeoutReference,
					doneTyping = function (el) {
						if (!timeoutReference) return;
						timeoutReference = null;
						callback.call(el);
					};
				return this.each(function (i, el) {
					var $el = $(el);
					// Chrome Fix (Use keyup over keypress to detect backspace)
					// thank you @palerdot
					$el.is(':input') && $el.on('keyup keypress', function (e) {
						if (e.type == 'keyup' && e.keyCode != 8) return;
						// start over again.
						if (timeoutReference) clearTimeout(timeoutReference);
						timeoutReference = setTimeout(function () {
							// if we made it here, our timeout has elapsed. Fire the
							// callback
							doneTyping(el);
						}, timeout);
					}).on('blur', function () {
						// If we can, fire the event since we're leaving the field
						doneTyping(el);
					});
				});
			}
		});
		jQuery(function ($) {

			$('.jp-jplayer').each(function () {
				var $this = $(this),
					url = $this.data('audio'),
					type = url.substr(url.lastIndexOf('.') + 1),
					player = '#' + $this.data('player'),
					audio = {};
				audio[type] = url;

				$this.jPlayer({
					ready              : function () {
						$this.jPlayer('setMedia', audio);
					},
					swfPath            : 'jplayer/',
					cssSelectorAncestor: player
				});
			});
		});
	})(jQuery);

	var post_gallery = function () {
		$('article.format-gallery .flexslider').imagesLoaded(function () {
			$('.flexslider').flexslider({
				animation : "slide",
				prevText  : "<i class='fa fa-angle-left'></i>",
				nextText  : "<i class='fa fa-angle-right'></i>",
				controlNav: false
			});
		});
	}
	jQuery(function ($) {
		if (jQuery().flexslider) {
			$('.post-formats-wrapper .flexslider').flexslider({
				animation : "slide",
				prevText  : "<i class='fa fa-angle-left'></i>",
				nextText  : "<i class='fa fa-angle-right'></i>",
				controlNav: false
			});
		}
	});
	/* sticky */
	var sticky_calc = function () {
		if ($(".height_sticky_auto").length) {
			$('.navigation').affix({
				offset: {
					top: $('#masthead').offset().top
				}
			});
		}
	}
	/* Icon Box */
	$(".wrapper-box-icon").each(function () {
		var $this = jQuery(this);
		if ($this.attr("data-icon")) {
			var $color_icon = jQuery(".icon i", $this).css('color');
			var $color_icon_change = $this.attr("data-icon");
		}
		if ($this.attr("data-icon-bg")) {
			var $color_icon_border = jQuery(".wrapper-title-icon", $this).css('border-color');
			var $color_icon_border_change = $this.attr("data-icon-bg");
		}

		if ($this.attr("data-icon-bg")) {
			var $color_bg = jQuery(".wrapper-title-icon", $this).css('background-color');
			var $color_bg_change = $this.attr("data-icon-bg");
		}
		$this.hover(
			function () {
				if ($this.attr("data-icon")) {
					jQuery(".icon i", $this).css({'color': $color_icon_change});
				}
				if ($this.attr("data-icon-bg")) {
					jQuery(".wrapper-title-icon", $this).css({'background-color': $color_bg_change});
				}
				if ($this.attr("data-icon-bg")) {
					jQuery(".wrapper-title-icon", $this).css({'border-color': $color_icon_border_change});
				}
			},
			function () {
				if ($this.attr("data-icon")) {
					jQuery(".icon i", $this).css({'color': $color_icon});
				}
				if ($this.attr("data-icon-bg")) {
					jQuery(".wrapper-title-icon", $this).css({'background-color': $color_bg});
				}
				if ($this.attr("data-icon-bg")) {
					jQuery(".wrapper-title-icon", $this).css({'border-color': $color_icon_border});
				}
			}
		);
	});
	/* End Icon Box */
	/*  Box  sale*/
	$(".read-more-btn").each(function () {
		var $this = jQuery(this);
		if ($this.attr("data-hover")) {
			var $color_change = $this.attr("data-hover");
		}
		if ($this.attr("data-old")) {
			var $color_old = $this.attr("data-old");
		}
		$this.hover(
			function () {
				if ($this.attr("data-hover")) {
					jQuery("a", $this).css({'color': $color_change});
				}
				if ($this.attr("data-hover")) {
					jQuery("a", $this).css({'border-color': $color_change});
				}
			}, function () {
				if ($this.attr("data-old")) {
					jQuery("a", $this).css({'color': $color_old});
				}
				if ($this.attr("data-old")) {
					jQuery("a", $this).css({'border-color': $color_old});
				}
			}
		);
	});
	/* End Box sale */
	//Scroll To top
	var scrollToTop = function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#topcontrol').css({bottom: "25px"});
			} else {
				jQuery('#topcontrol').css({bottom: "-100px"});
			}
		});
		jQuery('#topcontrol').click(function () {
			jQuery('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	}
	// main menu hover
	jQuery(function ($) {
		$('#masthead .navigation .navbar-nav >li,#masthead .navigation .navbar-nav li.standard').hover(
			function () {
				$(this).children('.sub-menu').stop(true, false).slideDown(250);
			},
			function () {
				$(this).children('.sub-menu').stop(true, false).slideUp(250);
			}
		);
	});

	// DOMReady event
	$(function () {
		sticky_calc();
		scrollToTop();
		//	MainMenuHover();
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
				jQuery(this).addClass('wpb_start_animation');
			}, {offset: '85%'});
		}
	});

	jQuery('#wrapper-container').click(function () {
		jQuery('.slider_sidebar').removeClass('opened');
		jQuery('html,body').removeClass('slider-bar-opened');
	});
	jQuery(document).keyup(function (e) {
		if (e.keyCode === 27) {
			jQuery('.slider_sidebar').removeClass('opened');
			jQuery('html,body').removeClass('slider-bar-opened');
		}
	});

	jQuery('[data-toggle=offcanvas]').click(function (e) {
		e.stopPropagation();
		jQuery('.menu-mobile').toggleClass('opened');
		jQuery('html,body').toggleClass('menu-opened');
	});

	/********************************
	 Menu Sidebar
	 ********************************/
	jQuery('.sliderbar-menu-controller').click(function (e) {
		e.stopPropagation();
		jQuery('.slider_sidebar').toggleClass('opened');
		jQuery('html,body').toggleClass('slider-bar-opened');
	});
	jQuery('.only-icon .button-search').hover(function (e) {
		e.stopPropagation();
		jQuery('#header-search-form-input #s').focus();
	});
	jQuery('#header-search-form-input').hover(function (e) {
		e.stopPropagation();
		jQuery('#header-search-form-input #s').focus();
	});

	$('.product-grid').each(function () {
		var $this = $(this);
		function setHeight() {
			var max = 0;
			$('li.product .product-title-rating,.owl-item .product .product-title-rating', $this).each(function () {
				$(this).height('auto');
				var h = $(this).height();
				max = Math.max(max, h);
			}).height(max);
 		}
		setHeight();
  		$('li.product .product-title-rating,.owl-item .product .product-title-rating', this).load(setHeight); //if list have image
		$(window).on('load resize', setHeight);
		$(window).resize(function () {
			setHeight
		});
	});
	/* Menu Sidebar */
	jQuery('.menu-mobile-effect').click(function (e) {
		e.stopPropagation();
		jQuery('.wrapper-container').toggleClass('mobile-menu-open');
	});
	function mobilecheck() {
		var check = false;
		(function (a) {
			if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))check = true
		})(navigator.userAgent || navigator.vendor || window.opera);
		return check;
	}
	if(mobilecheck()){
		window.addEventListener('load', function(){ // on page load
			document.getElementById('main-content').addEventListener("touchstart", function(e) {
				jQuery('.wrapper-container').removeClass('mobile-menu-open');
			});
		}, false)
	}
	/* mobile menu */
	jQuery('.navbar-nav>li.menu-item-has-children >a,.navbar-nav>li.menu-item-has-children >span').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
	jQuery('.navbar-nav>li.menu-item-has-children .icon-toggle').click(function () {
		//alert('test');
		if (jQuery(this).next('ul.sub-menu').is(':hidden')) {
			jQuery(this).next('ul.sub-menu').slideDown(500, 'linear');
			jQuery(this).html('<i class="fa fa-angle-up"></i>');
		}
		else {
			jQuery(this).next('ul.sub-menu').slideUp(500, 'linear');
			jQuery(this).html('<i class="fa fa-angle-down"></i>');
		}
	});
	//product-grid
	
	// single product image
	jQuery('.variations_form').on('woocommerce_variation_has_changed',function(){
		if( jQuery('#main-product .product_variations_image img').attr('src') === jQuery('#main-product li.main_product_thumbnai a img').attr('src') ) {
			jQuery('#main-product .product_variations_image').hide();
			jQuery('#main-product #slider').show();
			jQuery('#main-product #carousel').show();
		} else {
			jQuery('#main-product #slider').hide();
			jQuery('#main-product #carousel').hide();
			jQuery('#main-product .product_variations_image').removeClass('hide');
			jQuery('#main-product .product_variations_image').show();
		}
	});
})(jQuery);
