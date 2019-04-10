<?php
/**
 * Template Name: General Page (No sidebar) Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 begin-here m-t-s">

  <?php get_template_part('templates/content', 'page'); ?>

		</div>
	</div>
</div>

<?php endwhile; ?>