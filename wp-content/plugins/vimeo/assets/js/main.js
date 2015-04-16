jQuery(document).ready(function($) {
	
	/* Ajax  
	-----------------------------------------------------------------------------*/	
		
	Radium_Gallery_Ajax = {	
		
		init : function () {
			
			var self = Radium_Gallery_Ajax;
			
			self.ReloadScripts();
		
		},
		
		Ajax : function () {
			
			var self = Radium_Gallery_Ajax;
			
			$('.tabs1 .tab').on('click', function(e) { 
				
				e.preventDefault();
				
				$(this).addClass('active').siblings().removeClass('active');
				
				var link = $(this).attr('href');
				
				self.loadItem( link );
			 
 			});
			
		},
		
		loadItem : function( link ) {
			
			var self = Radium_Gallery_Ajax;
													 			
			$.ajax({
			
				url			: link,
				type		: 'GET',
				dataType 	: 'html',
				beforeSend	: function () { $("#main").addClass('loading'); }
				
			}).done(function( responseText, textStatus, jqXHR ) {
								
				var response = jQuery.parseHTML( responseText ),
					content = $( response ).find("#main-inner");
						
				$("#main").empty().append(content);	
 				 				 
			}).always(function( responseText, status, xhr ) {
 				
 				$("#main").removeClass('loading');
 				
 				//trigger Scripts on new content
 				self.ReloadScripts();
 				
			}).fail(function( jqXHR, textStatus, errorThrown ) {
 			     
 			     //error message here
 			     
 			}); //end ajax call
				     
		},
		
		ReloadScripts : function () {
			
			var self = Radium_Gallery_Ajax;
			
			self.Ajax();
			
			/* FitVid Magic - Target all videos
 		 	-----------------------------------------------------------------------------*/	
			$("body").fitVids();	
			
			
		 	/* Lightbox  
		 	-----------------------------------------------------------------------------*/	
 		 	var $lightboxes = $('.radium-gallery');
		 		
		  		$lightboxes.each(function(){
		 	 	  	$(this).find('a').prettyPhoto();
		 	});
 		
 		}
 		
 	}
 	
 	Radium_Gallery_Ajax.init();
	
	                $(".page-grid-item").capslide({
                    caption_color	: '#bfedfa',
                    caption_bgcolor	: '#000',
                    overlay_bgcolor : '#000',
                    showcaption	    : false,
					border          : '0px'
                });

 	
});
 