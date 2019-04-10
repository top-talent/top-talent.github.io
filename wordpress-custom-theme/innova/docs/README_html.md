# Workflow capabilities - HTML

Thanks to created CSS classes and JS function, you can easliy build your HTML structure.

## Sample section

Example of single section with title, subtitle, content, and button:

```sh
<section class="about-us element-paddings">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="about-us__title">About us</h2>
                <span class="about-us__subtitle">Learn more about our company</span>
                <div class="about-us__content content element-small-margin-top">
                    <p>Here should goes content</p>
                    <ul>
                        <li>First</li>
                        <li>Second</li>
                    </ul>
                </div>
                <a href="about-us.php" class="company-name-button company-name-button__full-background company-name-button__full-background--green">Learn more</a>
            </div>
        </div>
    </div>
</section>
```

## Background cover

Container with ```background-cover``` image editable in WP admin:

```sh
<article class="single-news element-margin-top background-cover" style="background-image: url('images/img__single-news.jpg');">
    <h2 class="single-news__title"><?php the_title(); ?></h2>
    <a href="<?php the_permalink(); ?>" class="company-name-button company-name-button--smaller company-name-button__outline company-name-button__outline--pink">Read more</a>
</article>
```

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim