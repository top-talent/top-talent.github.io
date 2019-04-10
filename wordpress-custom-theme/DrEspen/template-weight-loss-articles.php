<?php
/**
 * Template Name: Weight Loss Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<div class="container teal_bg page-banner-holder"> 
	<div class="row">
		<div class="col-lg-12 page-banner">
			<h4>Weight Loss</h4>

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
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 recent-articles">


	            <div id="articles-category" class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">
	                    <div class="owl-stage" style="">

<div class="row">
							
<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'articles', 'category_name' => 'weight-loss', 'posts_per_page' => 6, 'paged' => $paged );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>


							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 article-card">
							    <div class="post-content-wrapper cleafix">
							        <div class="post_format_content">
							            <a href="<?php echo get_permalink(); ?>">
											<?php the_post_thumbnail('article-cards', array( 'title' => get_the_title(), 'alt' => get_the_title() )); ?>

										</a>
							        </div>
							        <div class="post-descr-wrap text-center clearfix">


<?php
// Gets only the first category of the post
$categories = get_the_category();
 
if ( ! empty( $categories ) ) {
    $categories_name = esc_html( $categories[0]->name );   
}
?>					        
							            <span class="post_meta_category"><a href="/ " rel="category tag">

 

							            </a></span>
							            <h2 class="post-title"><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

							            <div class="post-content clearfix">
							                <?php the_excerpt(); ?>
							            </div>
							            <a class="post_content_readmore heading_font" href="<?php echo get_permalink(); ?>">Read More</a>
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
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-xs hidden-sm newest-products">



<?php if ( is_active_sidebar( 'sidebar-widget-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-widget-1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


		</div>
</div>
</div>