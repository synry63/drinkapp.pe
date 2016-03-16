(function ($) {
	"use strict";
	$(document).ready(function () {
		$(".owl-carousel").each(function () {
			var $this = jQuery(this);
 			$this.owlCarousel({
				loop          : true,
				singleItem    : true,
				navigation    : true,
				autoHeight    : false,
 				pagination    : false,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa fa-angle-right'></i>"]
			});
		});
	});
})(jQuery);
