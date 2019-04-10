<?php
    /*
    *
    *   @package Crunch
    *   @since Crunch 2.0.0
    */
?>

<?php get_header(); ?>

<main id="main" class="standard-page-template">

	<section class="hello-section element-paddings text-center">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="hello-section__title"><?php the_title(); ?></h1><!-- /.hello-section__title -->
				</div><!-- /.col-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.hello-section element-paddings text-center -->

	<article class="standard-page-article element-paddings">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-lg-8 col-xl-7 mx-auto">
					<div class="standard-page-article__content content">
						<?php the_content(); ?>
					</div><!-- /.standard-page-article__content content -->
				</div><!-- /.col-md-9 col-lg-8 col-xl-7 mx-auto -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</article><!-- /.standard-page-article element-paddings -->

</main><!-- /#main.standard-page-template -->

<?php get_footer(); ?>