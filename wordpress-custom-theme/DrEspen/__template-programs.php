<?php
/**
 * Template Name: Program Events Main Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<style>
.article-card:nth-child(2n+1) {
	padding-left: 15px;
	padding-right: 0;
}

.post-title-events {
	margin: 25px 40px;
	padding: 7px 12px 7px;
	text-transform: uppercase;
	line-height: 28px;
	font-size: 16px;
	background-color: #fff;
	border-top: 5px solid #C94429 !important;
  height: 70px;
  overflow: hidden;
}

.post_format_content {
	overflow: hidden;
	margin-bottom: 27px;
	background-color: #fff;
	max-height: 100%;
}

.post-content-wrapper.cleafix {
	border: 1px solid #ccc;
	padding: 10px;
	height: auto;
}

.top_heading h2 {
	border-bottom: 1px solid;
	padding-bottom: 10px;
	font-size: 24px;
	text-transform: uppercase;
	margin-bottom: 20px;
}

#articles-category .article-card {
	min-height: auto;
}
.post-descr-wrap {
  margin-top: -70px;
}
.post_format_content .post-content.clearfix {
    height: 170px;
    overflow: hidden;
    margin: 0 0 15px;
}
.post_format_content>a {
    display: block;
    height: 180px;
    overflow: hidden;
}
.post_format_content a:hover {
  background: none;
}
.post_format_content>a img {
  height: auto;
}
@media (max-width:991px) {
  .post_format_content>a {
    height: 300px;
}


#articles-category .article-card {
	padding-right: 30px;
	padding-left: 30px;
}

.article-card:nth-child(2n) {
	padding-left: 30px;
	padding-right: 30px;
}


.article-card:nth-child(2n+1) {
	padding-left: 30px;
	padding-right: 30px;
	margin-bottom: 20px;
}
}
@media (max-width:767px) {
  .post_format_content>a {
    height: auto;
}

#articles-category .article-card {
	padding-right: 0;
}

.article-card:nth-child(2n) {
	padding-right: 0;
	padding-left: 0;
}

.article-card:nth-child(2n+1) {
	padding-left: 0;
	padding-right: 0;
	margin-bottom:20px;
}

}
</style>


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


<div class="container">
<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 recent-articles">


	            <div id="articles-category" class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">
	                    <div class="owl-stage" style="">

<div class="top_heading"><h2>Programs</h2></div>

<div id="programs programs_new" class="row">

<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'programs', 'posts_per_page' => 6, 'paged' => $paged,'post__in'=>array('3948','4118','4128','1671'), 'orderby' => 'menu_order' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 article-card">
	<div class="post-content-wrapper cleafix">
		<div class="post_format_content">
			<a href="<?php echo get_permalink(); ?>">
			<?php
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
				<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
			</a>
			<div class="post-descr-wrap text-center clearfix">
			<h2 class="post-title-events"><a href="<?php the_field('event-url'); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="post-meta">
			</div>
			<div class="post-content clearfix">
				<p>  <?php the_excerpt(); ?></p>
			</div>
			<a class="post_content_readmore heading_font" href="<?php the_field('event-url'); ?>" target="_blank">Learn More!</a>
		</div>
		</div>

	</div>
</div>
<?php
endwhile;
?>
</div>

<div class="top_heading"><h2>Products</h2></div>
<div class="row" style="display: flex;flex-wrap: wrap;justify-content: center;">
<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'paged' => $paged, 'post__in'=>array('2549','2539'), 'orderby' => 'menu_order' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>

<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 article-card">
	<div class="post-content-wrapper cleafix">
		<div class="post_format_content">
			<a href="<?php echo get_permalink(); ?>">
			<?php
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
				<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
			</a>
			<div class="post-descr-wrap text-center clearfix">
			<h2 class="post-title-events"><a href="<?php the_permalink(); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="post-meta">
			</div>
			<div class="post-content clearfix">
				<p>  <?php the_excerpt(); ?></p>
			</div>
			<a class="post_content_readmore heading_font" href="<?php the_permalink(); ?>" target="_blank">Learn More!</a>
		</div>
		</div>

	</div>
</div>

<?php endwhile;?>



<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'programs', 'posts_per_page' => 6, 'paged' => $paged,'post__in'=>array('4239'), 'orderby' => 'menu_order' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
<!--- for video link -->
<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 article-card">
	<div class="post-content-wrapper cleafix">
		<div class="post_format_content">
			<a href="<?php echo get_permalink(); ?>">
			<?php
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
				<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
			</a>
			<div class="post-descr-wrap text-center clearfix">
			<h2 class="post-title-events"><a href="<?php the_permalink(); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="post-meta">
			</div>
			<div class="post-content clearfix">
				<p>  <?php the_excerpt(); ?></p>
			</div>
			<a class="post_content_readmore heading_font" href="<?php the_permalink(); ?>" target="_blank">Learn More!</a>
		</div>
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

<div class="row" style="display: flex;flex-wrap: wrap;justify-content: center;">
	<?php
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'paged' => $paged, 'post__in'=>array('4019'), 'orderby' => 'menu_order' );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	?>

	<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 article-card">
		<div class="post-content-wrapper cleafix">
			<div class="post_format_content">
				<a href="<?php echo get_permalink(); ?>">
				<?php
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				?>
					<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
				</a>
				<div class="post-descr-wrap text-center clearfix">
				<h2 class="post-title-events"><a href="<?php the_permalink(); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="post-meta">
				</div>
				<div class="post-content clearfix">
					<p>  <?php the_excerpt(); ?></p>
				</div>
				<a class="post_content_readmore heading_font" href="<?php the_permalink(); ?>" target="_blank">Learn More!</a>
			</div>
			</div>

		</div>
	</div>

	<?php endwhile;?>

	<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'programs', 'posts_per_page' => 6, 'paged' => $paged,'post__in'=>array('4370'), 'orderby' => 'menu_order' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
<!--- for video link -->
<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 article-card">
	<div class="post-content-wrapper cleafix">
		<div class="post_format_content">
			<a href="<?php echo get_permalink(); ?>">
			<?php
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
				<img src="<?php echo $feat_image; ?>" alt="Programs Featured Image">
			</a>
			<div class="post-descr-wrap text-center clearfix">
			<h2 class="post-title-events"><a href="<?php the_permalink(); ?>" target="_blank" title="Permalink to Article Title Goes Here" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="post-meta">
			</div>
			<div class="post-content clearfix">
				<p>  <?php the_excerpt(); ?></p>
			</div>
			<a class="post_content_readmore heading_font" href="<?php the_permalink(); ?>" target="_blank">Learn More!</a>
		</div>
		</div>

	</div>
</div>

<?php
endwhile;
?>

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
