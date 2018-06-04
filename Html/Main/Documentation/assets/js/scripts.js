(function() {
    jQuery(document).ready(function() {

        // Nav Menu (current class)
        var $menuItems = $(".header nav li a"),
            lastId,
            fromTop,
            cur,
            scrollItems = $menuItems.map(function() {
                var item = $($(this).attr("href"));
                if (item.length) return item;
            });

        // click nav
        $menuItems.on('click', function(e) {
            var href = $(this).attr("href"),
                offsetTop = $(href).offset().top + 10 + 'px';
            $('html, body').stop().animate({
                scrollTop: offsetTop
            }, 1000, 'easeOutCubic');
            e.preventDefault();
        });

        // add current class to menu
        $(window).scroll(function() {
            fromTop = $(this).scrollTop() + 10,
                cur = scrollItems.map(function() {
                    if ($(this).offset().top < fromTop) return this;
                });
            cur = cur[cur.length - 1];
            var id = cur && cur.length ? cur[0].id : "";
            if (lastId !== id) {
                lastId = id;
                $menuItems.parent().removeClass("current").end().filter("[href=#" + id + "]").parent().addClass("current");
            }
        });
        var elem, ink, d, x, y,
            $rippleAlone = $(".ripple-alone");
            //Ripple effect for single elements
            $rippleAlone.click(function(e) {
                elem = $(this);
                //create .ink element if it doesn't exist
                if (elem.find(".ink").length === 0) {
                    elem.append("<span class='ink'></span>");
                }

                ink = elem.find(".ink");
                //incase of quick double clicks stop the previous animation
                ink.removeClass("animate");

                //set size of .ink
                if (!ink.height() && !ink.width()) {
                    //use elem's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
                    d = Math.max(elem.outerWidth(), elem.outerHeight());
                    ink.css({
                        height: d,
                        width: d
                    });
                }

                //get click coordinates
                //logic = click coordinates relative to page - elem's position relative to page - half of self height/width to make it controllable from the center;
                x = e.pageX - elem.offset().left - ink.width() / 2;
                y = e.pageY - elem.offset().top - ink.height() / 2;

                //set the position and add class .animate
                ink.css({
                    top: y + 'px',
                    left: x + 'px'
                }).addClass("animate");
            });

    });
})();
