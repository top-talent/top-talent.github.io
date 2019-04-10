<?php
/**
 * Template Name: Events Main Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>




<div class="container teal_bg page-banner-holder"> 
	<div class="row">
		<div class="col-lg-12 page-banner">
			<h4>Events</h4>

			<div id="search-box" class="widget widget_search"><div class="search_form_wrap">
				<form name="search_form" method="get" action="/" class="search_form">
					<label class="heading_font">Search</label>
					<input class="search-field" type="text" name="s" placeholder="Type your search" value="">
					<input class="search-submit" type="submit" value="">
				</form>
				<i class="fa fa-search"></i>
			</div></div>
		</div>
	</div>
</div>


<div class="container">
<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 recent-articles">


	            <div id="articles-category" class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">
	                    <div class="owl-stage" style="">

<div id="events" class="row 99898">

<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'events', 'posts_per_page' => 6, 'paged' => $paged );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>


							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 article-card live-events">
							    <div class="post-content-wrapper cleafix">
							        <div class="post_format_content">
							            <a href="<?php the_field('event-url'); ?>" target="_blank">
										<?php
										$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
										?>
											<img src="<?php echo $feat_image; ?>" alt="Events Featured Image">
										</a>
							        </div>
							        <div class="post-descr-wrap text-center clearfix">
							            <h2 class="post-title-events"><a href="<?php the_field('event-url'); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
							            <div class="post-meta">
							            </div>
							            <div class="post-content clearfix">
							                <p>  <?php the_content(); ?></p>
							            </div>
							            <a class="post_content_readmore heading_font" href="<?php the_field('event-url'); ?>" target="_blank">Learn More!</a>
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