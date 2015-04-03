(function($) {
  "use strict";
   try {
		/*-------------------------------------------------*/
		/* =  preloader function
		/*-------------------------------------------------*/
	    var winDow = $(window);
		var body = $('body');
		body.addClass('active');

		winDow.load( function(){
			var mainDiv = $('#container'),
				preloader = $('.preloader');

				preloader.fadeOut(400, function(){
					mainDiv.delay(400).addClass('active');
					body.delay(400).css('background', '#eaeaea');
				});
		});	
	} catch (e) {
		// TODO: handle exception
		console.log('preloader error');
	}

})(jQuery);