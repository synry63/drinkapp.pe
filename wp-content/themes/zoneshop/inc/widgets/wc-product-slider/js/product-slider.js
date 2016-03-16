(function ($) {
	"use strict";
	$(document).ready(function () {
		$(".thim-showcase-module").each(function () {
			var $this = jQuery(this);
			var owl = $this.find('.box-content');
			var $item = owl.attr("data-column-slider");
			owl.owlCarousel({
				loop          : true,
				singleItem    : true,
				autoHeight    : false,
				pagination    : false,
				stopOnHover   : true,
				navigationText: false
				//items         : $item,
				//itemsDesktopSmall : [980,3],
				//itemsTablet: [768,2],
				//itemsMobile : [479,1]
			});
			$this.find('.next').click(function () {
				owl.trigger('owl.next')
 			});
			$this.find('.prev').click(function () {
				owl.trigger('owl.prev')
			});

		});

	});
})(jQuery);
