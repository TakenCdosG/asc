/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";
	/** bootstrap class **/
	try{
		$(".sidebar-widget select").addClass('form-control');
		$(".sidebar-widget table").addClass('table');
	} catch(err) {
	}		
	/* global google: false */
	/* global Event: false */
	/* global DevSolutionSkill: false */ 
	
	/*-------------------------------------------------*/
	/* =  portfolio isotope
	/*-------------------------------------------------*/

	var winDow = $(window);
	// Needed variables
	var $container=$('.portfolio-box, .blog-box');
	var $filter=$('.filter');

	try{
		$container.imagesLoaded( function(){
			$container.show();
			$container.isotope({
				filter:'*',
				layoutMode:'masonry',
				animationOptions:{
					duration:750,
					easing:'linear'
				}
			});
			reconstructIsotope();
		});
	} catch(err) {
	}

	winDow.bind('resize', function(){
		var selector = $filter.find('a.active').attr('data-filter');

		try {
			$container.isotope({ 
				filter	: selector,
				animationOptions: {
					duration: 750,
					easing	: 'linear',
					queue	: false,
				}
			});
		} catch(err) {
		}
		return false;
	});

	/*-------------------------------------------------*/
	/* =  flexslider
	/*-------------------------------------------------*/
	try {

		var SliderPost = $('.flexslider');

		SliderPost.flexslider({
			animation: "fade",
			slideshowSpeed: 4000,
		});
	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  fullwidth carousell
	/*-------------------------------------------------*/
	try {
		var fullCarousell = $("#owl-demo");
		fullCarousell.owlCarousel({
			navigation : true,
			afterInit : function(elem){
				var that = this;
				that.owlControls.prependTo(elem);
			}
		});
	} catch(err) {

	}
	try {
		var home4 = $("#owl-demo2");
		home4.owlCarousel({
			navigation : true,
			afterInit : function(elem){
				var that = this;
				that.owlControls.appendTo(elem);
			},
			items: 2,
			itemsDesktop: [1199, 2],
			itemsDesktopSmall: [979, 1],
			itemsTablet: [768, 1],
			itemsTabletSmall: false,
			itemsMobile: [479, 1]
		});
	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  header height fix
	/*-------------------------------------------------*/
	var content = $('#content');
	content.imagesLoaded( function(){
		var bodyHeight = $(window).outerHeight(),
		containerHeight = $('.inner-content').outerHeight(),
		headerHeight = $('header'),
		contactpageHeight = $('.contact-page');

		if( bodyHeight > containerHeight ) {
			headerHeight.css('min-height',bodyHeight);
		} else {
			headerHeight.css('min-height',containerHeight);
		}
		contactpageHeight.css('min-height', bodyHeight);
	});

	winDow.bind('resize', function(){
		var bodyHeight = $(window).outerHeight(),
		containerHeight = $('.inner-content').outerHeight(),
		headerHeight = $('header'),
		contactpageHeight = $('.contact-page');
		if( bodyHeight > containerHeight ) {
			headerHeight.css('min-height',bodyHeight);
		} else {
			headerHeight.css('min-height',containerHeight);	
		}
		contactpageHeight.css('min-height', bodyHeight);
	});


	/* ---------------------------------------------------------------------- */
	/*	Home 6 fullscreen slider
	/* ---------------------------------------------------------------------- */

	var sliderFullscr = $('#slider'),
		bodyHeight = $(window).outerHeight();

	sliderFullscr.css('height', bodyHeight);

	winDow.bind('resize', function(){
		var bodyHeight = $(window).outerHeight();

		sliderFullscr.css('height', bodyHeight);
	});

	/* ---------------------------------------------------------------------- */
	/*	header hide and show
	/* ---------------------------------------------------------------------- */

	var elemhide = $('.hide-menu'),
		elemshow = $('.show-menu');

		elemhide.on('click', function(e){
			e.preventDefault();

			$('header').addClass('out-active');
			$('.header-foot').addClass('out-active');
			$('#content').addClass('full-width-added');
			setTimeout(function() {
				try {
					reconstructIsotope();
				} catch(err) {

				}
				try {
					fullCarousell.data('owlCarousel').reinit({
						navigation : true
					});
				} catch(err) {

				}
				window.dispatchEvent(new Event('resize'));
				elemshow.addClass('active');
				
			}, 300);
			
		});

		elemshow.on('click', function(e){
			e.preventDefault();

			$('header').removeClass('out-active');
			$('.header-foot').removeClass('out-active');
			$('#content').removeClass('full-width-added');
			elemshow.removeClass('active');
			setTimeout(function() {
				try {
					reconstructIsotope();
				} catch(err) {

				}
				try {
					fullCarousell.data('owlCarousel').reinit({
						navigation : true
					});
				} catch(err) {

				}
			}, 300);
			
		});

	/*-------------------------------------------------*/
	/* =  browser detect
	/*-------------------------------------------------*/
	try {
		$.browserSelector();
		// Adds window smooth scroll on chrome.
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	magnific-popup
	/* ---------------------------------------------------------------------- */

	try {
		// Example with multiple objects
		var ZoomImage = $('.zoom');
		ZoomImage.magnificPopup({
			type: 'image'
		});
	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  Testimonial
	/*-------------------------------------------------*/

	try{
		var testimUl = $('.testimonial-slider > ul');

		testimUl.quovolver({
			transitionSpeed:300,
			autoPlay:true
		});
	}catch(err){
	}

	/*-------------------------------------------------*/
	/* = skills animate
	/*-------------------------------------------------*/

	try {
		var animateElement = $(".meter > span");
		animateElement.each(function() {
			$(this)
				.data("origWidth", $(this).width())
				.width(0)
				.animate({
					width: $(this).data("origWidth")
				}, 1200);
		});
	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  skills circle
	/*-------------------------------------------------*/
	
	try{
		
		$('.circle').each(function(){
			var skill_id = $(this).attr('id');
			DevSolutionSkill.init(skill_id);
			return;
		});
		
		
	} catch(err) {
	}

	/*-------------------------------------------------*/
	/* =  count increment
	/*-------------------------------------------------*/
	try {
		$('.statistic-counter').appear(function() {
			$('.timer').countTo({
				speed: 4000,
				refreshInterval: 60,
				formatter: function (value, options) {
					return value.toFixed(options.decimals);
				}
			});
			$(this).addClass('active');
		});
	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	Bootstrap tabs
	/* ---------------------------------------------------------------------- */
	
	var tabId = $('.nav-tabs a');
	try{		
		tabId.click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
	} catch(err) {
	}

	/* ---------------------------------------------------------------------- */
	/*	Contact Map
	/* ---------------------------------------------------------------------- */
	try {
		var mapContainer = $('.map');
		var gmap_gzoom  	 =  mapContainer.attr('data-gzoom');
		var marker_image =  mapContainer.attr('data-marker');
		var gmap_lat	 = 	mapContainer.attr('data-lat');
		var gmap_lng	 = 	mapContainer.attr('data-lng');
		var gmap_center_lat  =  mapContainer.attr('data-center-lat');
		var gmap_center_lng  =  mapContainer.attr('data-center-lng');
		var contact = {"lat":gmap_lat, "lgn":gmap_lng};
		mapContainer.gmap3({
			action: 'addMarker',
			marker:{
				options:{
					icon : new google.maps.MarkerImage(marker_image)
				}
			},			
			latLng: [contact.lat, contact.lgn],
			map:{
				options:{
						center:[gmap_center_lat,gmap_center_lng],//Change a map coordinate here!
						zoom: parseInt(gmap_gzoom)
					}
				},
			},
			{action: 'setOptions', args:[{scrollwheel:false}]}
		);
	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	menu responsive
	/* ---------------------------------------------------------------------- */
	var menuClick = $('a.elemadded'),
		navbarVertical = $('.menu-box');
		
	menuClick.on('click', function(e){
		e.preventDefault();

		if( navbarVertical.hasClass('active') ){
			navbarVertical.slideUp(300).removeClass('active');
		} else {
			navbarVertical.slideDown(300).addClass('active');
		}
	});

	winDow.bind('resize', function(){
		if ( winDow.width() > 1024 ) {
			navbarVertical.slideDown(300).removeClass('active');
		} else {
			/**
			 * navbarVertical.slideUp(300).removeClass('active');
			 */
			/**
			 * Code modified on 30/04/15
			 * To revert it back, just remove the next 3 lines and uncomment the block above this one
			 * 
			 * This shouldn't be done
			 */
			if (!navbarVertical.hasClass('active')) {
				navbarVertical.slideUp(300).removeClass('active');
			}
		}
	});

});

/* ---------------------------------------------------------------------- */
/*	Isotop reconstruct function
/* ---------------------------------------------------------------------- */
function reconstructIsotope(){
	$('.portfolio-box').isotope({ 
		animationOptions: {
			duration: 200,
			easing	: 'linear',
			queue	: true,
		}
	});
}

/* ---------------------------------------------------------------------- */
/*	reconstruct isotope function
/* ---------------------------------------------------------------------- */

function reconstructIsotope(){
	$('.portfolio-box, .blog-box').isotope({
		layoutMode:'masonry',
		animationOptions:{
			duration:750,
			easing:'linear'
		}
	});
}