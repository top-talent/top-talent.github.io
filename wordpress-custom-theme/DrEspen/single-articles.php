<?php get_template_part('templates/page', 'header'); ?>

<style type="text/css">
    body.postid-2439 .feat-image {
        max-height: none;
    }
</style>


<div id="article-content" class="container">
  <div class="col-lg-12">


<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h2 class="articles-title entry-title text-center"><?php the_title(); ?></h2>
    </header>

    <div class="feat-image">
      <?php
      $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      ?>
        <img src="<?php echo $feat_image; ?>" alt="Article Featured Image">
  </div>

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
  <?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
  </div>
</div>


<div class="row">
    <div class="entry-content col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <?php the_content(); ?>
      <h4 class="text-center">Share this with your friends!</h4>
      <p class="text-center"><?php if (function_exists('synved_social_share_markup')) echo synved_social_share_markup(); ?></p>
    </div>


      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden-xs newest-products">



<?php if ( is_active_sidebar( 'sidebar-widget-1' ) ) : ?>
  <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-widget-1' ); ?>
  </div><!-- #primary-sidebar -->
<?php endif; ?>


    </div>
</div>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>



  </div>
</div>
