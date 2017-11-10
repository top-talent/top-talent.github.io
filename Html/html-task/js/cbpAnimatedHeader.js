

var cbpAnimatedHeader = (function() {

	var docElem = document.documentElement,
		header = document.querySelector( '.cbp-af-header' ),
		didScroll = false,
		changeHeaderOn = 300;

	function init() {
		window.addEventListener('scroll', function( event ) {
			if( !didScroll ) {
				didScroll = true;
				setTimeout( scrollPage, 250 );
			}
		}, false );
	}
	
	function scrollPage() {
		var sy = scrollY();
		console.log(sy);
		if ( sy >= changeHeaderOn ) {
			classie.add( header, 'cbp-af-header-shrink' );
		}
		else {
			classie.remove( header, 'cbp-af-header-shrink' );
		}
		didScroll = false;
	}

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	init();

})();

$(document).ready(function() {
	var offset=250, 
	scrollDuration=300; 
	$(window).scroll(function() {
		if ($(this).scrollTop() > offset) {
			$('.scroll_top').fadeIn(500);} 
		else {
			$('.scroll_top').fadeOut(500); 
		}
	});

	// Smooth animation when scrolling
	$('.scroll_top').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: 0}, scrollDuration);
	});
});

//fade in and out when scroll (experience.html)
$(window).scroll(function() {
	if ($(this).scrollTop() > 250) {
	  if ($(this).scrollTop() > 1200) 
		 $('.text_content').stop().fadeOut();
	  else
		 $('.text_content').stop().fadeIn();
	}
}); 
  
//testimonials.html page
$(window).on("load",function() {
	$(window).scroll(function() {
		var windowBottom = $(this).scrollTop() + $(this).innerHeight();
		$(".text-content").each(function() {
			var objectBottom = $(this).offset().top + $(this).outerHeight();
			if (objectBottom < windowBottom) { 
				if ($(this).css("opacity")==0) {$(this).fadeTo(500,1);}
			} else { 
				if ($(this).css("opacity")==1) {$(this).fadeTo(500,0);}
			}
		});
	}).scroll();
});