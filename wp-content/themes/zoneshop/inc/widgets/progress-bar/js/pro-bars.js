//	ProBars v1.1, Copyright 2014, Joe Mottershaw, https://github.com/joemottershaw/
//	===============================================================================
 jQuery('.sc_progress_bar').waypoint(function () {
	jQuery(this).find('.sc_single_bar').each(function (index) {
		var $this = jQuery(this),
			bar = $this.find('.sc_bar'),
			val = bar.data('percentage-value');

		setTimeout(function () {
			bar.css({"width":val + '%'});
		}, index * 200);
	});
}, { offset:'85%' });