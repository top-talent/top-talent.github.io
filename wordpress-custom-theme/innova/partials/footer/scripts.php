<?php wp_footer(); ?>

<script>
    /* ~~~~~~~~~~ Fonts ~~~~~~~~~~ */

    WebFontConfig = {
        google: {
            families: ['Open+Sans:400,700,800', 'sans-serif']
        }
    };

    (function(d) {
        var wf = d.createElement('script'), s = d.scripts[0];
        wf.src = 'https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.26/webfontloader.js';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
    })(document);
</script>