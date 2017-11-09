

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
	var offset=250, // At what pixels show Back to Top Button
	scrollDuration=300; // Duration of scrolling to top
			$(window).scroll(function() {
		if ($(this).scrollTop() > offset) {
							$('.scroll_top').fadeIn(500); // Time(in Milliseconds) of appearing of the Button when scrolling down.
							} else {
	$('.scroll_top').fadeOut(500); // Time(in Milliseconds) of disappearing of Button when scrolling up.
	}
});

// Smooth animation when scrolling
$('.scroll_top').click(function(event) {
event.preventDefault();
					$('html, body').animate({
				scrollTop: 0}, scrollDuration);
							})
});

