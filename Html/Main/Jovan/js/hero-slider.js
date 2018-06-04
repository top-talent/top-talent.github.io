/*Hero Slider
Full screen Slider
Architecgture Home Page
*/




(function($){
	var image 				= $(".slider-slice img"),
		imageContainer 		= $(".slider-slice-imageContainer"),
		sliderSlice 		= $(".slider-slice"),
		imageActive 		= $(".image--active"),
		textActive 			= $(".text--active .text-main-wrapper"),
		textSlice			= textActive.find(".text-main-wrapper"),
		labelContainer		= $(".text-label-container"),
		sliderOverlay		= $(".slider-overlay"),
		CTA 				= $(".cta"),
		articleTitle		= $("article h1"),
		articlePara 		= $("article p"),
		articleSubTitle		= $("article h3"),
		activeLabel 		= $(".text--active .text-label"),
		vw,
		vh,
		delay 				= 0.06,
		delays 				= [];

	TweenMax.set(imageContainer, {xPercent: "100"});
	TweenMax.set(imageActive, {xPercent: "0"});
	TweenMax.set($(".text-container:not(.text--active) .text-main-wrapper"), {xPercent: 100});
	TweenMax.set(articleTitle, {autoAlpha:0, display:'none'});
	TweenMax.set(articlePara, {autoAlpha:0, display:'none'});
	TweenMax.set(articleSubTitle, {autoAlpha:0, display:'none'});

	$("body").addClass("u-blockScroll");



	for (var i = 0; i < 4; i++) {
		delays.push(i*delay);
	};

	/********************************
		FIT THE WINDOWS WITH THE IMAGES
	********************************/
	function positionImages(){
		vw 		= $(window).width();
		vh 		= $(window).height();
		var imageW 	= image.width();
		var imageH 	= image.height();
		ratioImg 	= imageW / imageH;
		ratioW 		= vw / vh;
		if(ratioImg > ratioW){
			image.css({"width": "auto", "height" : vh});
		}else{
			image.css({"width": vw, "height" : "auto"});
		}
	}
	positionImages();
	$(window).on("resize", positionImages);




	/********************************
		OPENING
	********************************/
	var tlOpening = new TimelineMax({delay: 2});
	var delayOpening = 0.05;
	tlOpening
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(0)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 1 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(1)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 2 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(2)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 3 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(3)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 4 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(4)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 2 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(5)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 3 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(6)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 5 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(7)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 5 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(8)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 3 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(9)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 4 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(10)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 5 * delayOpening)
		.fromTo(($(".slider-slice-imageContainer.image--active").eq(11)), 1, {xPercent: -100}, {xPercent:0, ease: Power2.easeInOut}, 6 * delayOpening)
		.staggerFromTo(($(".text-container.text--active .text-main-wrapper")), 1, {xPercent: -100}, {xPercent: 0, ease: Power2.easeInOut}, 0.2, "-=1")
		.fromTo(activeLabel, 1, {autoAlpha:0}, {autoAlpha: 1})
		.fromTo(CTA, 0.6, {autoAlpha:0}, {autoAlpha:1});


	/********************************
		SLIDE BACKGROUND & TEXT SLIDE
	********************************/
	var	durationSlide 	= 0.8;
	var	durationText 	= 0.8;
	var isMoving 		= false;
	function slideBackground(fromRight){
		isMoving = true;
		var tlSlideBackground 	= new TimelineMax({onComplete: function(){ isMoving = false}});
		var tlSlideText 		= new TimelineMax();
		imageActive 			= $(".image--active");

		if(fromRight === true){
			var from = 105;
			var to = -100;
		}else{
			var from = -105;
			var to = 100;
		}
		var k = 0;

		imageActive.each(function(i,el){
			var parent = $(el).closest(".slider-slice");
			if(fromRight === true){
				var nextSlice = $(el).next();				
			}else{
				var nextSlice = $(el).prev();	
			}
			if (nextSlice.is(':last-child') || nextSlice.is(':first-child')) {
				parent.find(".slider-slice-imageContainer").eq(0).appendTo(parent);
			}
			if(nextSlice.index() == -1){
				parent.find(".slider-slice-imageContainer").eq(0).appendTo(parent);
				var nextSlice = $(el).prev();
			}
			tlSlideBackground
				.to(el, (durationSlide * 1.1), {xPercent: to, ease: Power2.easeInOut}, delays[k])
				.fromTo(nextSlice, durationSlide, {xPercent: from}, {xPercent:0, ease: Power2.easeInOut}, delays[k])
			$(el).removeClass("image--active");
			nextSlice.addClass("image--active");
			k++;
			if(k==4){
				k=0;
			}
		});

		// SLIDE TEXT
		k= 0;
		textActive.each(function(i, el){
			var parent = $(el).closest(".text-container");
			if(fromRight === true){
				var nextText = parent.next().find(".text-main-wrapper");
			}else{
				var nextText = parent.prev().find(".text-main-wrapper");	
			}
			if (nextText.closest(".text-container").is(':last-child') || nextText.closest(".text-container").is(':first-child')) {
				console.log("yo, ultimi");
				$(".text-wrapper .text-container:first-child").appendTo(parent.closest(".text-wrapper"));
			}
			if(nextText.index() == -1){
				parent.eq(0).appendTo(parent.closest(".text-wrapper"));
				var nextText = parent.prev().find(".text-main-wrapper");
			}
			tlSlideText
				.to(el, durationText, {xPercent: to, ease: Power2.easeInOut}, (delays[k])*1.2)
				.fromTo(nextText, durationText, {xPercent: from}, {xPercent:0, ease: Power2.easeInOut}, (delays[k])*1.2)
			parent.removeClass("text--active");
			nextText.closest(".text-container").addClass("text--active");
			k++;
			if(k==4){
				k=0;
			}
			console.log(parent.first());

		});
		imageActive = $(".image--active");
		textActive = $(".text--active .text-main-wrapper");

	}

	/********************************
		CTA ACTIONS
	********************************/
	$(".cta--next").click(function(){
		var fromRight = true;
		if(!(isMoving)){
			slideBackground(fromRight);			
		}
	});
	$(".cta--prev").click(function(){
		var fromRight = false;
		if(!(isMoving)){
			slideBackground(fromRight);			
		}
	});
	$(".cta--down").click(function(){
		activeLabel		= $(".text--active .text-label");
		activeSlide 	= $(".text--active").attr("data-slide");
		var article 			= $("[data-article="+ activeSlide + "]article");
		var articleTitle		= $("[data-article="+ activeSlide + "]article h1");
		var articlePara 		= $("[data-article="+ activeSlide + "]article p");
		var articleSubTitle		= $("[data-article="+ activeSlide + "]article h3");

		var tlSlideUp 		= new TimelineMax(),
			tlSlideTextUp 	= new TimelineMax(),
			tlArticleShow 	= new TimelineMax(),
			tlMainSlideUp	= new TimelineMax({ onComplete: function(){TweenMax.set($(".hero-container"), {autoAlpha:0}) }});

		tlArticleShow
				.fromTo(articleTitle, 2, {y:50, autoAlpha:0},{y:0,autoAlpha:1, ease:Power4.easeOut, display:'block'}, "sliderOut-=0.5")
		article.children(":not(h1)").each(function(i,el){	
			tlArticleShow		
				.fromTo(el, 2.2, {y:20, autoAlpha:0},{y:0,autoAlpha:1, ease:Power4.easeOut, display:'block'}, ((i * 0.2)+0.6))
		});

		imageActive.each(function(i,el){
			k = 0;
			tlSlideUp
				.to(el, 0.8, {yPercent: -101, ease: Power2.easeInOut}, delays[k])
			k++;
			if(k==4){
				k=0;
			}
		});
		textActive.each(function(i, el){
			tlSlideTextUp
				.to(el, 0.8, {yPercent: -110, ease: Power2.easeInOut}, delays[k])
		});
		tlMainSlideUp
			.to(CTA, 0.2, {autoAlpha: 0})
			.add(tlSlideUp)
			.add(tlSlideTextUp, '0.2')
			.to(activeLabel, 0.8, {top: -40, ease: Power2.easeInOut}, "-=0.8")
			.to(sliderOverlay, 0.2, {autoAlpha: 0, onComplete: function(){ $("body").removeClass("u-blockScroll")}}, "-=0.5")
			.add("sliderOut")
			.add(tlArticleShow);
		tlMainSlideUp.play();

		


	});
})(jQuery);