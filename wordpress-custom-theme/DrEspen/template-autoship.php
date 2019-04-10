<?php
/**
 * Template Name: WC Auto Ship
 */
?>



<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>


<div id="autoship-about" class="container">
		<div class="content-holder">
		  <?php get_template_part('templates/content', 'page'); ?>	
	</div>
</div>	


<?php endwhile; ?>