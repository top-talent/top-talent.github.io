<?php
/**
 * Template Name: General Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="container">
	<div class="row">
		<div class="col-lg-8 begin-here m-t-s">

  <?php get_template_part('templates/content', 'page'); ?>

		</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden-xs newest-products m-t-s">



<?php if ( is_active_sidebar( 'sidebar-widget-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-widget-1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


		</div>
	</div>
</div>

<?php endwhile; ?>