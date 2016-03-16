jQuery(document).ready(function () {
	jQuery('.ob-search-input').on('keyup', function (event) {
		clearTimeout(jQuery.data(this, 'timer'));
		if (event.which == 38) {
			if (navigator.userAgent.indexOf('Chrome') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
				var selected = jQuery(".ob_selected");
				jQuery(".ob-list-search li").removeClass("ob_selected");

				// if there is no element before the selected one, we select the last one
				if (selected.prev().length == 0) {
					selected.siblings().last().addClass("ob_selected");
				} else { // otherwise we just select the next one
					selected.prev().addClass("ob_selected");
				}
			}
			event.preventDefault();
		} else if (event.which == 40) {
			if (navigator.userAgent.indexOf('Chrome') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
				var selected = jQuery(".ob_selected");
				jQuery(".ob-list-search li").removeClass("ob_selected");

				// if there is no element before the selected one, we select the last one
				if (selected.next().length == 0) {
					selected.siblings().first().addClass("ob_selected");
				} else { // otherwise we just select the next one
					selected.next().addClass("ob_selected");
				}
			}
			event.preventDefault();
		} else if (event.which == 27) {
			jQuery('.ob-list-search').html('');
			jQuery('.ob-list-search').removeClass('active');
			jQuery(this).val('');
			jQuery(this).stop();
		} else {
			jQuery(this).data('timer', setTimeout(search, 1000));
		}
	});
	jQuery('.ob-search-input').on('keypress', function (event) {
		if (event.keyCode == 38) {
			var selected = jQuery(".ob_selected");
			jQuery(".ob-list-search li").removeClass("ob_selected");

			// if there is no element before the selected one, we select the last one
			if (selected.prev().length == 0) {
				selected.siblings().last().addClass("ob_selected");
			} else { // otherwise we just select the next one
				selected.prev().addClass("ob_selected");
			}
			event.preventDefault();
		}
		if (event.keyCode == 40) {
			var selected = jQuery(".ob_selected");
			jQuery(".ob-list-search li").removeClass("ob_selected");

			// if there is no element before the selected one, we select the last one
			if (selected.next().length == 0) {
				selected.siblings().first().addClass("ob_selected");
			} else { // otherwise we just select the next one
				selected.next().addClass("ob_selected");
			}
			event.preventDefault();
		}
	});
});

function search(waitKey) {
	keyword = jQuery('.ob-search-input').val();
	if (keyword) {
		if (!waitKey && keyword.length < 3) {
			return;
		}
		jQuery('.header-search-close').html('<i class="fa fa-spinner fa-spin"></i>');
		jQuery('.header-search-close').css({'z-index': 9999});
		jQuery('.button-search i').css({'opacity': 0});
		jQuery.ajax({
			type   : 'POST',
			data   : 'action=result_search&keyword=' + keyword,
			url    : ob_ajax_url,
			success: function (html) {
				var data_li = '';
				items = jQuery.parseJSON(html);
				if (!items.error) {
					jQuery.each(items, function (index) {
						if (index == 0) {
							data_li += '<li class="ui-menu-item' + this['id'] + ' ob_selected"><div class="ob-search-left">' + this['thumbnail'] + '</div><div class="ob-search-right"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['guid'] + '"><i class="icon-page"></i><span class="search-title">' + this['title'] + '</span></a><p>' + this['shortdesc'] + '</p></div></li>';
						} else {
							data_li += '<li class="ui-menu-item' + this['id'] + '"><div class="ob-search-left">' + this['thumbnail'] + '</div><div class="ob-search-right"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['guid'] + '"><i class="icon-page"></i><span class="search-title">' + this['title'] + '</span></a><p>' + this['shortdesc'] + '</p></div></li>';
						}
					});
					jQuery('.ob-list-search').html('').append(data_li);
				}
				jQuery('.header-search-close').html('');
				jQuery('.header-search-close').css({'z-index': -1});
				jQuery('.button-search i').css({'opacity': 1});
				jQuery('.ob-list-search').addClass('active');
			},
			error  : function (html) {
			}
		});
	}
}


