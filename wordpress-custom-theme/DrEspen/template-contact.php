<?php
/**
 * Template Name: Contact Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>




	<div class="container">
<div id="sub-slider-holder">

		<div class="row">
			<div class="sub-slider">
				<h4><span class="smaller-h4">Any questions?</span><strong><br>Drop us a line!</strong></h4>
			</div>
		</div>
	</div>
</div>

<div class="container">
		<div class="contact-form">
		  <?php get_template_part('templates/content', 'page'); ?>	
	</div>
</div>	


<?php endwhile; ?>