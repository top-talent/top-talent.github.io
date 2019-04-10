(function($){

    $(document).ready(function() {

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /* ~~~~~~~~~~ Plugin Inits ~~~~~~~~~~ */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

            /* ~~~~~~~~~~ Match height ~~~~~~~~~~ */

            $('.match-height').matchHeight({
                byRow: true,
                property: 'min-height',
                target: null,
                remove: false
            });


            /* ~~~~~~~~~~ Mobile navigation ~~~~~~~~~~ */

            $('.main-header').addClass('mmenu-fixed');

            if($('#wpadminbar').length) {
                $('#wpadminbar').addClass('mmenu-fixed');
            }

            var $menu = $("#mobile-navigation").mmenu({
                "extensions": [
                    "pagedim-black",
                    "theme-dark"
                ],
                "offCanvas": {
                    "position": "right"
                },
                "navbars": [
                    {
                        "position": "top"
                    }
                ]
            }, {
                classNames: {
                    fixedElements: {
                        fixed: "mmenu-fixed",
                        elemInsertSelector: '.main-header'
                    }
                }
            });

            var $icon = $("#mmenu-triger");
            var API = $menu.data( "mmenu" );

            $icon.on( "click", function() {
                if($icon.hasClass('is-active')) {
                    API.close();
                } else {
                    API.open();
                }
            });

            API.bind( "opened", function() {
               setTimeout(function() {
                  $icon.addClass( "is-active" );
               }, 10);
            });
            API.bind( "closed", function() {
               setTimeout(function() {
                  $icon.removeClass( "is-active" );
               }, 10);
            });


            /* ~~~~~~~~~~ Lazy Loading ~~~~~~~~~~ */

            $('.lazy').Lazy({
                effect: 'fadeIn'
            });


            /* ~~~~~~~~~~ Fancybox Init ~~~~~~~~~~ */

            $(".content a[href*='.jpg'], .content a[href*='.jpeg'], .content a[href*='.png']").fancybox();

            $('[data-fancybox]').fancybox({
                youtube : {
                    autoplay : 1
                }
            });


            /* ~~~~~~~~~~ OWL Init ~~~~~~~~~~ */

                /* ~~~~~ Slider Name ~~~~~ */

                $(function() {
                    var owlsampleSlider = $('.owl-carousel');

                    owlsampleSlider.owlCarousel({
                        items: 4,
                        dots: true,
                        autoplay: true,
                        autoplayTimeout: 2000,
                        responsive : {
                            0 : {
                                items: 1
                            },
                            576 : {
                                items: 2,
                                margin: 30
                            },
                            768 : {
                                items: 3,
                                margin: 30
                            },
                            992 : {
                                items: 4,
                                margin: 30
                            }
                        }
                    });
                });


            /* ~~~~~~~~~ PDF Flip plugin fix ~~~~~~~~~~ */

            $("._df_button:first-child").addClass('homepage-intro__look-inside');
            $("script + ._df_button").addClass('homepage-intro__image-link').addClass('element-medium-margin-top');
            $("#range-of-readers-tabs-contnet + ._df_button").addClass('range-of-readers__sample-reader-button').addClass('element-medium-margin-top');


        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /* ~~~~~~~~~~ Functions ~~~~~~~~~~ */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

            /* ~~~~~~~~~~ Modal fix ~~~~~~~~~~ */

            $('.modal').appendTo($('body'));


            /* ~~~~~~~~~~ Set animation scroll when URL is with #anchor and make smooth scroll ~~~~~~~~~~ */

            $(function(){
                if ( window.location.hash ) scroll(0,0);
                setTimeout( function() { scroll(0,0); }, 1);

                // var headerHeight = $('.main-header').height();

                // if($('#wpadminbar').length) {
                //     headerHeight += $('#wpadminbar').height();
                // }

                $('.scroll').on('click', function(e) {
                    e.preventDefault();

                    $('html, body').animate({
                        scrollTop: ($($(this).attr('href')).offset().top/* - headerHeight*/) + 'px'
                    }, 1000, 'swing');
                });

                if(window.location.hash) {
                    $('html, body').animate({
                        scrollTop: ($(window.location.hash).offset().top/* - headerHeight*/) + 'px'
                    }, 1000, 'swing');
                }
            });


            /* ~~~~~~~~~~ Return to top button ~~~~~~~~~~ */

            $(window).scroll(function() {
                if ($(this).scrollTop() >= 100) {
                    $('.return-to-top').addClass('return-to-top--visible');
                } else {
                    $('.return-to-top').removeClass('return-to-top--visible');
                }
            });

            $('#return-to-top').click(function() {
                $('body,html').animate({
                    scrollTop : 0
                }, 500);
            });


            /* ~~~~~~~~~~ First content element fix ~~~~~~~~~~ */

            $('.content').prepend('<span class="first-element-fix"></span>');
            $('blockquote').prepend('<span class="first-element-fix"></span>');
            $('.panel').prepend('<span class="first-element-fix"></span>');


            /* ~~~~~~~~~~ Mobile navigation ~~~~~~~~~~ */

            $('#mobile-navigation .navigation li a').addClass('mm-fullsubopen');


            /* ~~~~~~~~~~ Make dropdowns visible on hover ~~~~~~~~~~ */

            $('ul.navbar-nav li.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
            });


            /* ~~~~~~~~~~ Delete empty <p> elements ~~~~~~~~~~~ */

            $('p').each(function() {
                var $this = $(this);
                if($this.html().replace(/\s|&nbsp;/g, '').length === 0)
                    $this.remove();
            });


            /* ~~~~~~~~~~ Change navigation after scroll ~~~~~~~~~~ */

            $(window).scroll(function() {
                if ($(this).scrollTop() >= 100) {
                    $('.main-header').addClass('main-header--scrolled');
                } else {
                    $('.main-header').removeClass('main-header--scrolled');
                }
            });


            /* ~~~~~~~~~~ Replace all SVG images with inline SVG ~~~~~~~~~~ */

            jQuery('img.svg').each(function(){
                var $img = jQuery(this);
                var imgID = $img.attr('id');
                var imgClass = $img.attr('class');
                var imgURL = $img.attr('src');

                jQuery.get(imgURL, function(data) {
                    var $svg = jQuery(data).find('svg');

                    if(typeof imgID !== 'undefined') {
                        $svg = $svg.attr('id', imgID);
                    }

                    if(typeof imgClass !== 'undefined') {
                        $svg = $svg.attr('class', imgClass+' replaced-svg');
                    }

                    $svg = $svg.removeAttr('xmlns:a');
                    $img.replaceWith($svg);
                }, 'xml');
            });

    });


    $(window).bind('load resize orientationChange', function () {

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /* ~~~~~~~~~~ Functions ~~~~~~~~~~ */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

            /* ~~~~~~~~~~ AOS Refresh ~~~~~~~~~~ */

            // AOS.refresh();


            /* ~~~~~~~~~~ Bootstrap modal margin top if WP admin exist ~~~~~~~~~~ */

            if($('#wpadminbar').length) {
                $('.modal').on('shown.bs.modal', function (e) {
                    var WPAdminBarHeight = $('#wpadminbar').height();
                    $('.modal').css("margin-top", (WPAdminBarHeight + 30));
                });
            }


            /* ~~~~~~~~~~ Sticky Footer ~~~~~~~~~~ */

            // $(function(){
            //     var $footer = $('.footer-wrapper');

            //     var pos = $footer.position(),
            //         height = ($(window).outerHeight() - pos.top) - ($footer.outerHeight() + 2);

            //     if (height > 0) {
            //         $footer.css('margin-top', height);
            //     }
            // });
    });


    /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    /* ~~~~~~~~~~ Resuable functions ~~~~~~~~~~ */
    /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        /* ~~~~~~~~~~ Check if current devices is mobile ~~~~~~~~~~ */

        function isMobile() {
            try{ document.createEvent("TouchEvent"); return true; }
            catch(e){ return false; }
        }

})(jQuery);