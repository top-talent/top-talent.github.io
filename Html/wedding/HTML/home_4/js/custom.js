(function($){
  "use strict";
  
  // Preloader 
	jQuery(window).on('load', function() {
		jQuery("#status").fadeOut();
		jQuery("#preloader").delay(350).fadeOut("slow");
	});
	
	// on ready function
	jQuery(document).ready(function($) {
	var $this = $(window);
	
	// Back to Top js
	$(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
	$('#scroll').on("click", function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
	
	// Menu show Hide
	var counter = 0;
	$('.wd_menu_btn, .wd_menu_btn_close').on("click", function(e){
		if( counter == '0') {
			$('.wd_main_menu_wrapper').addClass('wd_main_menu_hide');
			$(this).children().removeAttr('class');
			counter++;
		}
		else {
			$('.wd_main_menu_wrapper').removeClass('wd_main_menu_hide');
			$(this).children().removeAttr('class');
			counter--;
		}		
	});
	
	// Menu js for Position fixed
	$(window).scroll(function(){
		var window_top = $(window).scrollTop() + 1; 
		if (window_top > 500) {
			$('.wd_header_wrapper').addClass('menu_fixed animated fadeInDown');
		} else {
			$('.wd_header_wrapper').removeClass('menu_fixed animated fadeInDown');
		}
	});
	
	// Guest Slider Js
	$('.wd_guest_slider .owl-carousel').owlCarousel({
		loop:true,
		margin:45,
		nav:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:3
			}
		}
	});
	
	// Testimonial Slider Js
	$('.wd_testimonial_slider .owl-carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		autoplay:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
	// Family Slider Js
	$('.wd_family_slider .owl-carousel').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		navText:["<i class='fa fa-angle-left'></i>" , "<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:4
			}
		}
	});
	
	// Gallery Slider js
	$('.wd_gallery_slider .owl-carousel').owlCarousel({
		animateOut: 'fadeOut',
		loop:true,
		margin:10,
		nav:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
	// Magnific Popup js
	$('.popup-gallery').magnificPopup({
		delegate: '.ast_glr_overlay a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title') + '<small></small>';
			}
		}
	});
	
	// Contact Form Submition
	function checkRequire(formId , targetResp){
		targetResp.html('');
		var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
		var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
		var mobile = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
		var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
		var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
		var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
		var check = 0;
		$('#er_msg').remove();
		var target = (typeof formId == 'object')? $(formId):$('#'+formId);
		target.find('input , textarea , select').each(function(){
			if($(this).hasClass('require')){
				if($(this).val().trim() == ''){
					check = 1;
					$(this).focus();
					targetResp.html('You missed out some fields.');
					$(this).addClass('error');
					return false;
				}else{
					$(this).removeClass('error');
				}
			}
			if($(this).val().trim() != ''){
				var valid = $(this).attr('data-valid');
				if(typeof valid != 'undefined'){
					if(!eval(valid).test($(this).val().trim())){
						$(this).addClass('error');
						$(this).focus();
						check = 1;
						targetResp.html($(this).attr('data-error'));
						return false;
					}else{
						$(this).removeClass('error');
					}
				}
			}
		});
		return check;
	}
	$(".submitForm").on("click", function() {
		var _this = $(this);
		var targetForm = _this.closest('form');
		var errroTarget = targetForm.find('.response');
		var check = checkRequire(targetForm , errroTarget);
		if(check == 0){
			var formDetail = new FormData(targetForm[0]);
			formDetail.append('form_type' , _this.attr('form-type'));
			$.ajax({
				method : 'post',
				url : 'ajax.php',
				data:formDetail,
				cache:false,
				contentType: false,
				processData: false
			}).done(function(resp){
				if(resp == 1){
					targetForm.find('input').val('');
					targetForm.find('textarea').val('');
					errroTarget.html('<p style="color:green;">Mail has been sent successfully.</p>');
				}else{
					errroTarget.html('<p style="color:red;">Something went wrong please try again latter.</p>');
				}
			});
		}
	});
	
	// Single page scroll menu
	$('.wd_single_index_menu ul li a').on('click' , function(e){
	  $('.wd_single_index_menu ul li').removeClass('active');
	  $(this).parent().addClass('active');
	  var target = $('[section-scroll='+$(this).attr('href')+']');
	  e.preventDefault();
	  var targetHeight = target.offset().top-parseInt('83', 10);
	  $('html, body').animate({
	   scrollTop: targetHeight
	  }, 1000);
	});
	
	$(window).scroll(function() {
	  var windscroll = $(window).scrollTop();
	  var target = $('.wd_single_index_menu ul li');
	  if (windscroll >= 0) {
	   $('[section-scroll]').each(function(i) {
		if ($(this).position().top <= windscroll + 83) {
		 target.removeClass('active');
		 target.eq(i).addClass('active');
		}
	   });
	  }else{
	   target.removeClass('active');
	   $('.wd_single_index_menu ul li:first').addClass('active');
	  }

	});
	
	
	//Single page scroll js
	$('.wd_single_index_menu_down ul li a').on('click' , function(e){
	  $('.wd_single_index_menu_down ul li').removeClass('active');
	  $(this).parent().addClass('active');
	  var target = $('[section-scroll='+$(this).attr('href')+']');
	  e.preventDefault();
	  var targetHeight = target.offset().top-parseInt('83', 10);
	  $('html, body').animate({
	   scrollTop: targetHeight
	  }, 1000);
	});
	
	$(window).scroll(function() {
	  var windscroll = $(window).scrollTop();
	  var target = $('.wd_single_index_menu_down ul li');
	  if (windscroll >= 0) {
	   $('[section-scroll]').each(function(i) {
		if ($(this).position().top <= windscroll + 83) {
		 target.removeClass('active');
		 target.eq(i).addClass('active');
		}
	   });
	  }else{
	   target.removeClass('active');
	   $('.wd_single_index_menu_down ul li:first').addClass('active');
	  }

	});
	
	
	//Single page scroll js
	$('.wd_single_index_menu_rsvp a').on('click' , function(e){
	  $('.wd_single_index_menu_rsvp a').removeClass('active');
	  $(this).parent().addClass('active');
	  var target = $('[section-scroll='+$(this).attr('href')+']');
	  e.preventDefault();
	  var targetHeight = target.offset().top-parseInt('83', 10);
	  $('html, body').animate({
	   scrollTop: targetHeight
	  }, 1000);
	});
	
	$(window).scroll(function() {
	  var windscroll = $(window).scrollTop();
	  var target = $('.wd_single_index_menu_rsvp a');
	  if (windscroll >= 0) {
	   $('[section-scroll]').each(function(i) {
		if ($(this).position().top <= windscroll + 83) {
		 target.removeClass('active');
		 target.eq(i).addClass('active');
		}
	   });
	  }else{
	   target.removeClass('active');
	   $('.wd_single_index_menu_rsvp a').addClass('active');
	  }

	});
	
	// CountDown Js
	var deadline = 'November 1 2018 11:59:00 GMT-0400';
		function time_remaining(endtime){
			var t = Date.parse(endtime) - Date.parse(new Date());
			var seconds = Math.floor( (t/1000) % 60 );
			var minutes = Math.floor( (t/1000/60) % 60 );
			var hours = Math.floor( (t/(1000*60*60)) % 24 );
			var days = Math.floor( t/(1000*60*60*24) );
			return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
		}
		function run_clock(id,endtime){
			var clock = document.getElementById(id);
			
			// get spans where our clock numbers are held
			var days_span = clock.querySelector('.days');
			var hours_span = clock.querySelector('.hours');
			var minutes_span = clock.querySelector('.minutes');
			var seconds_span = clock.querySelector('.seconds');

			function update_clock(){
				var t = time_remaining(endtime);
				
				// update the numbers in each part of the clock
				days_span.innerHTML = t.days;
				hours_span.innerHTML = ('0' + t.hours).slice(-2);
				minutes_span.innerHTML = ('0' + t.minutes).slice(-2);
				seconds_span.innerHTML = ('0' + t.seconds).slice(-2);
				
				if(t.total<=0){ clearInterval(timeinterval); }
			}
			update_clock();
			var timeinterval = setInterval(update_clock,1000);
		}
		run_clock('clockdiv',deadline);	
		
		
		//** RS_SLIDER JS **//
		
		var tpj=jQuery;
			
			var revapi476;
			tpj(document).ready(function() {
				if(tpj("#rev_slider_476_1").revolution == undefined){
					revslider_showDoubleJqueryError("#rev_slider_476_1");
				}else{
					revapi476 = tpj("#rev_slider_476_1").show().revolution({
						sliderType:"standard",
jsFileLocation:"revolution/js/",
						sliderLayout:"fullscreen",
						dottedOverlay:"none",
						delay:9000,
						navigation: {
							keyboardNavigation:"off",
							keyboard_direction: "horizontal",
							mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
							onHoverStop:"off",
							arrows: {
								style:"hesperiden",
								enable:true,
								hide_onmobile:false,
								hide_onleave:false,
								tmp:'',
								left: {
									h_align:"left",
									v_align:"center",
									h_offset:20,
									v_offset:0
								},
								right: {
									h_align:"right",
									v_align:"center",
									h_offset:20,
									v_offset:0
								}
							}
						},
						visibilityLevels:[1240,1024,778,480],
						gridwidth:1240,
						gridheight:868,
						lazyType:"none",
						parallax: {
							type:"mouse",
							origo:"enterpoint",
							speed:400,
							levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
							type:"mouse",
						},
						shadow:0,
						spinner:"off",
						stopLoop:"on",
						stopAfterLoops:-1,
						stopAtSlide:-1,
						shuffle:"off",
						autoHeight:"off",
						fullScreenAutoWidth:"off",
						fullScreenAlignForce:"off",
						fullScreenOffsetContainer: "",
						fullScreenOffset: "60px",
						disableProgressBar:"on",
						hideThumbsOnMobile:"off",
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						debugMode:false,
						fallbacks: {
							simplifyAll:"off",
							nextSlideOnWindowFocus:"off",
							disableFocusListener:false,
						}
					});

var snowsettings = {   
    selector:'.tp-static-layers', 
    dimension:'self',   
  particleMaxPer:400,   
    particlaSize:[0.2,6], 
    particleOpacity:[0.3,1],
    particleSpeed:[30,100], 
    particleSinus:[1,100] 
  };


revapi476.bind("revolution.slide.onloaded",function (e) {
  revapi476.letItSnow(snowsettings);  
});

var snowsettings={selector:".tp-static-layers",dimension:"self",particleMaxPer:400,particlaSize:[.2,6],particleOpacity:[.3,1],particleSpeed:[30,100],particleSinus:[1,100]};revapi476.bind("revolution.slide.onloaded",function(e){revapi476.letItSnow(snowsettings)}),function(e,s){"use strict";function a(e){e.pause=!0,e.sc.find(".snowflakes_wrapper").remove(),e.c.removeData("snowflakes"),e={}}function n(e){e.snowflakes=[];for(var s=e.w*e.h/15e5;e.snowflakes.length<e.particleMaxPer*s;)e.snowflakes.push(i(e))}function t(e){window.requestAnimationFrame(function(){r(e)})}function r(e){if(e==s||e.ctx==s||1==e.destroyed||1==e.pause)return!1;e.ctx.clearRect(0,0,2700,2500);var a=e.h/3,n=e.h/3*2;for(var r in e.snowflakes)if(e.snowflakes[r].y+.1*e.snowflakes[r].r<0&&1==e.summer||e.snowflakes[r].y>e.h+e.snowflakes[r].r&&1==e.summer);else{e.snowflakes[r].delta+=e.snowflakes[r].delta==Math.PI/2?-e.snowflakes[r].delta:Math.random()/500-.01,e.summer?e.snowflakes[r].y+=e.snowflakes[r].speed/50+.1*e.snowflakes[r].r:e.snowflakes[r].y+=e.snowflakes[r].speed/100+.1*e.snowflakes[r].r,e.snowflakes[r].x+=Math.sin(e.snowflakes[r].delta)*(.1*e.snowflakes[r].r),e.snowflakes[r].y>e.h+e.snowflakes[r].r&&1!=e.summer&&(e.snowflakes[r]=i(e),e.snowflakes[r].y=0-e.snowflakes[r].r);var l=e.snowflakes[r].y-a,o=e.snowflakes[r].r,c=e.snowflakes[r].alpha;if(l>0||1==e.summer){var w=1-l/n;o=e.snowflakes[r].r*w,c=e.snowflakes[r].alpha*w}o=.1>o?.1:o,c=.1>c?.1:c,e.snowflakes[r].x=e.snowflakes[r].x>e.w+e.snowflakes[r].r?0:e.snowflakes[r].x<-o?e.w:e.snowflakes[r].x,e.ctx.beginPath(),e.ctx.arc(e.snowflakes[r].x,e.snowflakes[r].y,o,2*Math.PI,!1),e.ctx.fillStyle="rgba(255,255,255,"+c+")",e.ctx.fill()}t(e)}function i(e){var s=new Object;return s.delta=(e.particleSinus[0]+Math.random()*(e.particleSinus[1]-e.particleSinus[0]))*Math.round(2*Math.random()-1),s.r=e.particlaSize[0]+Math.random()*(e.particlaSize[1]-e.particlaSize[0]),s.alpha=e.particleOpacity[0]+Math.random()*(e.particleOpacity[1]-e.particleOpacity[0]),s.speed=(e.particleSpeed[0]+Math.random()*(e.particleSpeed[1]-e.particleSpeed[0]))*s.r/3,s.x=Math.random()*e.w,s.y=Math.random()*-e.h,s}e.fn.extend({letItSnow:function(r){var i={particleMaxPer:400,particlaSize:[.2,6],particleOpacity:[.3,1],particleSpeed:[30,100],particleSinus:[1,100]};return"destroy"!=r&&"stop"!=r&&"play"!=r&&"summer"!=r&&"winter"!=r&&(r=e.extend(!0,{},i,r)),this.each(function(){if(-1!=e.inArray(r,["destroy","stop","play","winter","summer"])){switch(r){case"destroy":r=e(this).data("snowflakes"),r!=s&&a(r);break;case"stop":r=e(this).data("snowflakes"),r!=s&&(r.pause=!0);break;case"play":r=e(this).data("snowflakes"),r!=s&&(r.pause=!1,t(r));break;case"summer":r=e(this).data("snowflakes"),r!=s&&(r.summer=!0);break;case"winter":r=e(this).data("snowflakes"),r!=s&&(r.summer=!1)}return!1}return r.c=e(this),r.sc=r.selector!=s?e(this).find(r.selector):r.c,0==r.sc.length?!1:r.c.data("snowflakes")!=s?!1:(r.sc.find(".snowflakes_wrapper").remove(),r.sc.append('<div class="snowflakes_wrapper" style="position:relative;z-index:0"><div class="snowflakes_wrapper_inner" style="overflow:hidden;position:relative"><canvas width="2700" height="2500" style="position:relative;" class="snowflake_canvas"></canvas></div></div>'),r.sw=r.sc.find(".snowflakes_wrapper_inner"),r.sw.data("caller_container",r.c),r.canvas=r.sc.find(".snowflake_canvas"),r.dimension!=self?r.sizer=r.c:r.sizer=r.sc,r.w=r.sizer.width(),r.h=r.sizer.height(),r.sc.find(".snowflakes_wrapper_inner").css({width:r.w,height:r.h}),r.canvas=r.canvas[0],r.snowflakes=[],r.ctx=r.canvas.getContext("2d"),n(r),t(r),r.c.data("snowflakes",r),void e(window).resize(function(){clearTimeout(r.timer),r.timer=setTimeout(function(){r.w=r.sizer.width(),r.h=r.sizer.height(),r.sc.find(".snowflakes_wrapper_inner").css({width:r.w,height:r.h}),n(r)},50)}))})}})}(jQuery);				}
			});	
	
	});
})(); 