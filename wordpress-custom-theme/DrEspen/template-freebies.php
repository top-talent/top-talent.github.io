<?php
/**
 * Template Name: Freebies Template
 */
?>



<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>


<div class="container">
		<div class="contact-form">
		  <?php get_template_part('templates/content', 'page'); ?>	
	</div>
</div>	


<?php endwhile; ?>