<?php
/**
 * Template Name: Homepage Template
 */
?>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>




<div class="container">
	<div class="row">
		<div class="revolution-slider">	

  <?php get_template_part('templates/content', 'page'); ?>

		</div>
	</div>
</div>

<?php endwhile; ?>
<!--
<div class="container">
	<div class="row">
		<div class="mail-list">
<h4>Join the mailing list</h4>
		</div>
	</div>
</div>
-->

	<div id="categories_list" class="position_top">
	    <div class="container">

			<div class="row">
	            <div class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">
	                    <div class="owl-stage" style="">
	                        <div class="owl-item active col-lg-6 col-md-6 col-sm-12 col-xs-12 hero-holder">
	                            <div class="item">
	                                <a target="_blank" href="https://bsa.drespen.com/p/bsa-course-f">
										<img src="https://www.drespen.com/wp-content/uploads/2017/02/drespen-1.jpg" class="hero" alt="shop products">
									<div class="categories_item_descr">
										<span class="heading_font">Programs</span>
										<p>Buy now</p>
									</div>
									<span class="overlay_border"></span>
								</a>
	                            </div>
	                        </div>
	                            </div>
	                        </div>
	  	                        </div>      

	            <div class="categories_carousel owl-carousel owl-theme owl-loaded">
	                <div class="owl-stage-outer">

	                    <div class="owl-stage col-lg-6 col-md-6 col-sm-12 owl-four" style="">
	                	                 <div class="row">
	                        <div class="owl-item active col-lg-6 col-md-6 col-sm-6 col-xs-6 smaller">
	                            <div class="item">
	                                <a href="/health">
										<img src="<?php bloginfo('template_directory'); ?>/dist/images/health-image.jpg" alt="health articles">
									<div class="categories_item_descr">
										<span class="heading_font">Health</span>
										<p>View articles</p>
									</div>
									<span class="overlay_border"></span>
								</a>
	                            </div>
	                        </div>
	                        <div class="owl-item active col-lg-6 col-md-6 col-sm-6 col-xs-6 smaller">
	                            <div class="item">
	                                <a href="/recipes">
										<img src="<?php bloginfo('template_directory'); ?>/dist/images/recipe-image.jpg" alt="recipie articles">
									<div class="categories_item_descr">
										<span class="heading_font">Recipes</span>
										<p>Get cooking</p>
									</div>
									<span class="overlay_border"></span>
								</a>
	                            </div>
	                        </div>             
	                          </div>
	                 <div class="row">
	                        <div class="owl-item active col-lg-6 col-md-6 col-sm-6 col-xs-6 smaller">
	                            <div class="item">
	                                <a href="/articles/muscle/">
										<img src="<?php bloginfo('template_directory'); ?>/dist/images/fitness-image.jpg" alt="fitness articles">
									<div class="categories_item_descr">
										<span class="heading_font">Fitness</span>
										<p>Get fit</p>
									</div>
									<span class="overlay_border"></span>
								</a>
	                            </div>
	                        </div>
	                        <div class="owl-item active col-lg-6 col-md-6 col-sm-6 col-xs-6 smaller">
	                            <div class="item">
	                                <a href="/articles/personal-development/">
										<img style="height:201px;" src="https://www.drespen.com/wp-content/uploads/2017/02/Successful.jpg" alt="empowerment articles">
									<div class="categories_item_descr">
										<span class="heading_font">Business &amp; Financial Mastery</span>
										<p>Become Successful</p>
									</div>
									<span class="overlay_border"></span>
								</a>
	                            </div>
	                        </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            </div>
	    </div>
	</div>

<div class="container">
	<div class="row">

	<!-- 
			<div class="join-facebook col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4>“Dr Espen’s teachings could take your life and health to a whole new level.”  </h4>
		<p>John Demartini - International best-selling author of Count Your Blessings</p>
			</div>

			<div class="join-facebook col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4>Click here to follow Dr. Espen on <strong>Facebook</strong> for exlusive offers and news!</h4>
			</div>
	-->
		<div class="quote-container fadeInBlock">

			<div id="john-quote" class="quotes quotes-one col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="quote-border-one">
						<div class="quote-image">
								<img class="hidden-xs" src="<?php bloginfo('template_directory'); ?>/dist/images/john-quote.png" alt="John Demartini Picture">
						</div>
				<h4>“Dr Espen’s teachings could take your life and business to a whole new level."</h4>
				<p class="quote-name-bottom"><strong>Dr. John Demartini</strong><br><span class="quote-small">International best-selling author of Count Your Blessings</span></p>
			
				</div>
			</div>

			<div class="quotes quotes-two col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="quote-border-two">
					<h4>"Dr. Espen methods are based around helping people understand that they have the power inside themselves to be well and live an abundant life."</h4>
					<p class="quote-name-bottom-left"><strong>The Courier Mail</strong><br><span class="quote-small">Breaking News Headlines for Brisbane, Australia and the World.</span></p>
				</div>
			</div>


		</div>
	</div>
</div>
 

<div class="container teal_bg page-banner-holder fadeInBlock"> 
	<div class="row">
		<div class="col-lg-12 page-banner">
			<h4>Recent Articles</h4>

			<div id="search-box" class="widget widget_search"><div class="search_form_wrap">
				<form name="search_form" method="get" action="/" class="search_form">
					<label class="heading_font">Search</label>
					<input class="search-field" type="text" name="s" placeholder="Search Articles..." value="">
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
$args = array( 'post_type' => 'articles', 'posts_per_page' => 6, 'cat' => '-18' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>


							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 article-card fadeInBlock">
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
							             <div class="post-meta">
							                <span class="post-meta-date">Posted in <a href="/<?php $category = get_the_category();
echo $category[0]->slug; ?>"><?php echo $categories_name; ?></a></span>




							            </div>
							            <div class="post-content clearfix">
							                <?php the_excerpt(); ?>
							            </div>
							            <?php if ($categories_name == 'Videos') { ?>
							            <a class="post_content_readmore heading_font" href="<?php echo get_permalink(); ?>">Watch This </a>

							            <?php 
												} else {
							            ?>
							            <a class="post_content_readmore heading_font" href="<?php echo get_permalink(); ?>">Read More</a>
							            <?php
							            	}
							            ?>
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

</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-xs hidden-sm newest-products fadeInBlock">



<?php if ( is_active_sidebar( 'sidebar-widget-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-widget-1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


		</div>
</div>
</div>