jQuery(document).ready( function () {
	if (jQuery("#bb-bookblock").length) {
		jQuery("#bb-bookblock").bookblock({
			nextEl : '#bb-nav-next',
			prevEl : '#bb-nav-prev'
		});
	}
});
