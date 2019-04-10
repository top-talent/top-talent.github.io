# Workflow capabilities - Scripts

Main scripts file is located in ```assets/scripts/custom/custom.js```.

In this file are located functions and objects to plugins used in project. Some examples:

## To top button

Showing To Top button after scroll

```sh
$(window).scroll(function() {
    if ($(this).scrollTop() >= 100) {
        $('#return-to-top').addClass('isVisible');
    } else {
        $('#return-to-top').removeClass('isVisible');
    }
});

$('#return-to-top').click(function() {
    $('body,html').animate({
        scrollTop : 0
    }, 500);
});
```

## Smooth scroll animation

Function to make smooth animation when opening page has #anchor, or to make smooth scroll inside one page (from section to section)

```sh
if ( window.location.hash ) scroll(0,0);
    setTimeout( function() { scroll(0,0); }, 1);

    $('.scroll').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: ($($(this).attr('href')).offset().top - $('.main-header').height()) + 'px'
        }, 1000, 'swing');
    });

    if(window.location.hash) {
        $('html, body').animate({
            scrollTop: ($(window.location.hash).offset().top - $('.main-header').height()) + 'px'
        }, 1000, 'swing');
    }
```

## Main navigation dropdowns on hover

Showing bootstrap dropdowns in main ```.navbar``` on hover (by defualt it's on click)

```sh
$('ul.nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
});
```

## WP Admin Fix for fixed headers

Function to always show WP Admin Bar on fixed headers

```sh
$(function(){
    var marginTop = $('.main-header').height();

    if($('#wpadminbar').length) {
        var WPAdminBarHeight = $('#wpadminbar').height();

        marginTop += WPAdminBarHeight;
        $('.main-header').css("top", WPAdminBarHeight);
    }

    $('main').css('margin-top', marginTop);
});
```

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim

