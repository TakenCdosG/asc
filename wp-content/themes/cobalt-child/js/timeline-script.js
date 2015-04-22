jQuery(document).ready( function () {
	if (jQuery("#bb-bookblock").length) {
		jQuery("#bb-bookblock").bookblock({
			nextEl : '#bb-nav-next',
			prevEl : '#bb-nav-prev'
		});
		jQuery("#bb-nav-first").on("click", function (e) {
			e.preventDefault();
			$("#bb-bookblock").bookblock("first");
		});
		jQuery("#bb-nav-last").on("click", function (e) {
			e.preventDefault();
			$("#bb-bookblock").bookblock("last");
		});
	}
});
