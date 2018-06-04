$(document).ready(function() {
  
  var $scene = $(".scene"),
      $content = $(".content"),
      $back = $(".back"),
      $backBgs = $(".back__bg"),
      $front = $(".front"),
      $frontBgs = $(".front__bg"),
      $menuBlock = $(".menu__block"),
      $svgPath = $(".menu__block-svgPath"),
      animating = false,
      menuActive = false,
      menuAnimTime = 600,
      blockAnimTime = 1500,
      $sliderCont = $(".menu-slider__content"),
      curSlide = 1,
      sliderXDiff = 0,
      curPage = 1,
      nextPage = 0,
      numOfPages = $(".front__bg").length,
      scaleTime = 500,
      transTime = 500,
      totalTime = scaleTime + transTime,
      changeTimeout,
      timeoutTime = 8000,
      winW = $(window).width(),
      winH = $(window).height();
  
  // init navigation element timeout animation
  $(".navigation__el-1").addClass("active");
  
  //default debounce function from David Walsh blog
  function debounce(func, wait, immediate) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };
  
  function changePages() {
    $(".back__bg, .front__bg, .navigation__el").removeClass("active");
    $(".navigation__el-"+curPage).addClass("active");
    $back.css("transform", "translate3d(0,"+(curPage-1)*-100+"%,0)");
    $front.css("transform", "translate3d(0,"+(curPage-1)*100+"%,0)");
    createTimeout();

    setTimeout(function() {
      $(".back__bg-"+curPage+", .front__bg-"+curPage).addClass("active");
    }, totalTime);
  };
  
  $(document).on("click", ".navigation__el:not(.active)", function() {
    curPage = $(this).attr("data-page");
    changePages();
  });
  
  // ugly hack for animation reset when you coming back from menu section
  function resetTimeoutAnimation() {
    var $activenavigationEl = $(".navigation__el.active"),
        $activeParts = $activenavigationEl.find(".navigation__el-clone, .navigation__el")
    $activeParts.addClass("instant");
    $activenavigationEl.removeClass("active");
    $activeParts.css("top");
    $activeParts.removeClass("instant");
    $activeParts.css("top");
    $activenavigationEl.addClass("active");
  }
  
  /* creates timeOut for change of slides.
  Call's itself from inside of changePages() function
  */
  function createTimeout() {
    window.clearTimeout(changeTimeout);
    resetTimeoutAnimation();
    changeTimeout = setTimeout(function() {
      if (curPage >= numOfPages) {
        curPage = 1;
      } else {
        curPage++;
      }
      changePages();
    }, timeoutTime);
  };
  
  createTimeout();
  
  /* creates path D attribute strings for animation
  initial d = fullScreen
  mid d = Q curves with 5% padding
  final d = centered 90% width/height block
  */
  function createD(type) {
    var types = {"init": ["M0,0",
                          "Q"+winW/2+",0",
                          winW+",0",
                          "Q"+winW+","+winH/2,
                          winW+","+winH,
                          "Q"+winW/2+","+winH,
                          "0,"+winH,
                          "Q0,"+winH/2,
                          "0,0"],
                 "mid": ["M0,0",
                         "Q"+winW/2+","+winH*0.05,
                         winW+",0",
                         "Q"+winW*0.95+","+winH/2,
                         winW+","+winH,
                         "Q"+winW/2+","+winH*0.95,
                         "0,"+winH,
                         "Q"+winW*0.05+","+winH/2,
                         "0,0"],
                 "final": ["M"+winW*0.05+","+winH*0.05,
                           "Q"+winW/2+","+winH*0.05,
                           winW*0.95+","+winH*0.05,
                           "Q"+winW*0.95+","+winH/2,
                           winW*0.95+","+winH*0.95,
                           "Q"+winW/2+","+winH*0.95,
                           winW*0.05+","+winH*0.95,
                           "Q"+winW*0.05+","+winH/2,
                           winW*0.05+","+winH*0.05]};
    return types[type].join(" ");
  }
  
  // animates path d with SnapSVG
  function animateBlock(reverse) {
    winW = $(window).width();
    winH = $(window).height();
    var initD = createD("init"),
        midD = createD("mid"),
        finalD = createD("final");
    
    if (!reverse) {
      $svgPath.attr("d", initD);
      Snap($svgPath[0]).animate({"path": midD}, blockAnimTime/2, mina.elastic, function() {
        Snap($svgPath[0]).animate({"path": finalD}, blockAnimTime/2, mina.elastic);
      });
    } else {
      Snap($svgPath[0]).animate({"path": midD}, blockAnimTime/2, mina.elastic, function() {
        Snap($svgPath[0]).animate({"path": initD}, blockAnimTime/2, mina.elastic);
      });
    }
    
  };
  
  // resizes opened menu path d block, because i can't change viewBox with js
  var resizeSvg = debounce(function() {
    winW = $(window).width();
    winH = $(window).height();
    $svgPath.attr("d", createD("final"));
  }, 50);
  
  // default madness
  $(document).on("click", ".menu__btn", function() {
    if (animating) return;
    animating = true;
    setTimeout(function() {
      animating = false;
    }, blockAnimTime + menuAnimTime);
    
    if (!menuActive) {
      menuActive = true;
      window.clearTimeout(changeTimeout);
      $content.addClass("inactive");
      $scene.addClass("menu-visible");
      $(".back__bg:not(.active)").addClass("hidden");
      $(window).on("resize", resizeSvg);
      setTimeout(function() {
        $menuBlock.addClass("visible");
        animateBlock();
      }, menuAnimTime);
    } else {
      menuActive = false;
      animateBlock(true);
      setTimeout(function() {
        $menuBlock.removeClass("visible");
        createTimeout();
        $(".back__bg").removeClass("hidden");
        $content.removeClass("inactive");
        $scene.removeClass("menu-visible");
      }, blockAnimTime);
      $(window).off("resize");
    }
  });
  
});