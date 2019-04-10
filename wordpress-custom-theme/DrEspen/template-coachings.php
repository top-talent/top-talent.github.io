<?php
/**
 * Template Name: Coachings Main Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>




<div class="container teal_bg page-banner-holder"> 
	<div class="row">
		<!--<div class="col-lg-12 page-banner">
			<h4>Programs</h4>

			<div id="search-box" class="widget widget_search"><div class="search_form_wrap">
				<form name="search_form" method="get" action="/" class="search_form">
					<label class="heading_font">Search</label>
					<input class="search-field" type="text" name="s" placeholder="Type your search" value="">
					<input class="search-submit" type="submit" value="">
				</form>
				<i class="fa fa-search"></i>
			</div></div>
		</div>-->
	</div>
</div>


<div class="container1">
<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 recent-articles">


	            <div id="articles-category" class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">
	                    <div class="owl-stage" style="">

<div id="programs" class="row">

<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'coachings', 'posts_per_page' => 6, 'paged' => $paged, 'orderby' => 'menu_order' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>


							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 article-card">
							    <div class="post-content-wrapper cleafix">
							        <div class="post_format_content">
									<?php
										$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
										?>
									<?php if($post->ID == 4177 ) {  ?>
										<span><img src="<?php echo $feat_image; ?>" alt="Programs Featured Image"><span>
									<?php } else { ?>
							            <a href="<?php the_field('event-url'); ?>" target="_blank">
											<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
										</a>
									<?php } ?>
							        </div>
							        <div class="post-descr-wrap text-center clearfix">
							            <h2 class="post-title-events">
										<?php if($post->ID == 4177 ) { the_title(); } else {?>
										<a href="<?php the_field('event-url'); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a>
										<?php } ?>
										</h2>
							            <div class="post-meta">
							            </div>
							            <div class="post-content clearfix">
							                <p>  <?php the_excerpt(); ?></p>
							            </div>
										<?php if($post->ID != 4177 ){ ?>
							            <a class="post_content_readmore heading_font" href="<?php the_field('event-url'); ?>" target="_blank">Learn More!</a>
										<?php } ?>
							        </div>
							    </div>
							</div>
			
<?php 

endwhile;

?>

</div>
</div>
</div>
</div>

<div class="row">
	<div class="text-center">
	    <!-- pagination here -->
	    <?php
	      if (function_exists('custom_pagination')) {
	        custom_pagination($loop->max_num_pages,"",$paged);
	      }
	    ?>

	  <?php wp_reset_postdata(); ?>
	</div>
</div>


</div>
</div>
</div>