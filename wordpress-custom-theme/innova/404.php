<?php
    /**
    *   The template for displaying 404 pages (not found)
    *
    *   @package Crunch
    *   @since Crunch 2.0.0
    */
?>

<?php get_header(); ?>

<main id="main" class="error-404-page-template">

    <section class="hello-section element-paddings text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="hello-section__title">Page Not Found</h1><!-- /.hello-section__title -->
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.hello-section element-paddings text-center -->

    <article class="standard-page-article element-paddings">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-8 col-xl-7 mx-auto">
                    <div class="standard-page-article__content content text-center">
                        <p>Sorry, but the page you were trying to view does not exist.</p>
                    </div><!-- /.standard-page-article__content content text-center -->
                </div><!-- /.col-md-9 col-lg-8 col-xl-7 mx-auto -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </article><!-- /.standard-page-article element-paddings -->

</main><!-- /#main.error-404-page-template -->

<?php get_footer(); ?>