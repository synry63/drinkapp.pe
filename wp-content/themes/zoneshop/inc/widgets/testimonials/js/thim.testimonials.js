(function ($) {
	$(document).ready(function () {
		$(".owl-carousel").each(function () {
			var $this = jQuery(this);
			var $show_button = '';
			var $show_nav = false;
			if ($this.attr("data-show-button") == 1) {
				var $show_button = ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"];
				//var $show_nav = true;
			}
			$this.owlCarousel({
				navigation    : true,
				singleItem    : true,
				autoPlay      : 5000,
				pagination    : false,
				navigationText: $show_button
			});
		});
	});
})(jQuery);
