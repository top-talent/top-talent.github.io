(function($) {
    "use strict";
    $(window).on("load", function() {
        var hash = location.hash,
            page = document.location.href.match(/[^\/]+$/)[0];
        if (hash == '') return false;

        setTimeout(function() {
            $(window).scrollTop($(hash).offset().top)
        }, 0);

        page = page.indexOf('_') > -1 ? page.split('_').shift() : page;
        $("#navmenu").find("a.active").removeClass("active");
        $("#navmenu").find("[href='" + page + "']").addClass("active");
    });

    var $window = $(window),
        $document = $(document),
        $body = $('body'),
        $header = $('#header'),
        $pageContent = $('#pageContent'),
        $navmenu = $('#navmenu'),
        $colMenu = $pageContent.find('.col-menu'),
        $endoffile = $pageContent.find('.endoffile'),
        $ttMenuToggle = $('#tt-menu-toggle'),
        $ttBackToTop = $('#tt-back-to-top');

    /*
        stuck menu
    */
    if ($navmenu.length) {
        stuckInit();
        $window.resize(debouncer(function(e) {
            stuckInit();
        }));
    };

    function debouncer(func, timeout) {
        var timeoutID, timeout = timeout || 500;
        return function() {
            var scope = this,
                args = arguments;
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function() {
                func.apply(scope, Array.prototype.slice.call(args));
            }, timeout);
        }
    };

    function stuckInit() {
         var pageContentHeight = parseInt($(window).height() - 99, 10),
                navmenuHeight = parseInt($navmenu.height(), 10),
                ttwindowWidth = window.innerWidth || $window.width(),
                valueScrollTop = $window.scrollTop();

        $window.scrollTop() > 99 ? stuckScrollInit() : stuckScrollRemove();
        $window.scroll(function() {
            $window.scrollTop() > 99 ? stuckScrollInit() : stuckScrollRemove();
        });

        function stuckScrollInit() {
            $navmenu.addClass('stuckScroll');
        };

        function stuckScrollRemove() {
            $navmenu.removeClass('stuckScroll');
        };
        setTimeout(function() {

            ttwindowWidth >= 790 ? detectStuckHeight() : removeStuckHeight();

            function detectStuckHeight() {
                if (pageContentHeight <= navmenuHeight) {
                    $navmenu.addClass('stuck-height');
                } else {
                    $navmenu.removeClass('stuck-height');
                };
            };

            function removeStuckHeight() {
                $navmenu.removeClass('stuck-height');
            };

        }, 400);
    };

    /*
        menu
    */
    if ($navmenu.length) {
        //active
        var pathname = window.location.pathname,
            page = pathname.split(/[/ ]+/).pop();

        $navmenu.find('li.level-0 > a').each(function() {
            var link = $(this).attr('href');
            if (page == link) {
                $(this).closest('li').addClass('active').children(".submenu").slideDown('300');
            }
        });
        //submenu(*go inside the page)
        $navmenu.on('click', '.level-0.active ul a', function() {
            $navmenu.find('.level-0.active a').each(function() {
                $(this).removeClass('active');
            });
            $(this).addClass('active');

        });
        $window.resize(function() {
            resizeHandler();
        });

        function resizeHandler() {
            if ($endoffile.length == 0) return false;
            var h = $endoffile.prev().outerHeight();
            var hf = $(window).innerHeight();
            var d = hf - h;
            if (d <= 0) return false;
            $endoffile.css('padding-top', d);
        }
        resizeHandler();
    };
    /*
        mobile toggle
    */
    if ($ttMenuToggle.length && $colMenu.length) {
        $header.on('click', $ttMenuToggle, function(e) {
            var $this = $(this);

            $colMenu.toggleClass('is-open');

            $(document).mouseup(function(e) {
                if (!$this.is(e.target) && $this.has(e.target).length === 0) {
                    $colMenu.removeClass('is-open');
                };
            });
        });
        $window.scroll(function() {
            if ($colMenu.hasClass('is-open')) {
                $ttMenuToggle.trigger('click');
            };
        });
    };
    /*
        button back to top
    */
    if ($ttBackToTop.length) {
        ttBackToTop();
    };

    function ttBackToTop() {
        $ttBackToTop.on('click', function(e) {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
        $window.scroll(function() {
            $window.scrollTop() > 500 ? $ttBackToTop.stop(true.false).addClass('tt-show') : $ttBackToTop.stop(true.false).removeClass('tt-show');
        });
    };
    $(window).on("load", function() {
        var hash = location.hash,
            page = document.location.href.match(/[^\/]+$/)[0];
        if (hash == '') return false;

        setTimeout(function() {
            $(window).scrollTop($(hash).offset().top)
        }, 0);

        page = page.split('_').shift();
        $("#navmenu").find("a.active").removeClass("active").closest("#navmenu").find("[href='" + page + "']").addClass("active");
    });
})(jQuery);