<?php get_template_part('templates/page', 'header'); ?>


<div id="article-content" class="container">
  <div class="col-lg-12">


<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h2 class="articles-title entry-title text-center"><?php the_title(); ?></h2>
    </header>
<p class="text-center"><?php if (function_exists('synved_social_share_markup')) echo synved_social_share_markup(); ?></p>
    <div class="embed-container">
      <?php
        $iframe = get_field( 'embedded_video_link' );
        preg_match( '/src="(.+?)"/', $iframe, $matches );
        $src = $matches[1];
        $params = array(
            'rel'    => 0
        );
        $new_src = add_query_arg( $params, $src );
        $iframe = str_replace( $src, $new_src, $iframe );
        echo $iframe;
      ?>
  </div>

<?php
if(!get_field('show-hide-content-and-sidebar') )
{ ?>

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
  <?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
  </div>
</div>



<div class="row">
    <div class="entry-content col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <?php the_content(); ?>
    </div>


      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden-xs newest-products">



<?php if ( is_active_sidebar( 'sidebar-widget-1' ) ) : ?>
  <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-widget-1' ); ?>
  </div><!-- #primary-sidebar -->
<?php endif; ?>


    </div>
</div>
<?php }
else
{
  ?>
<!-- Show Nothing -->
  <?php } ?>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>



  </div>
</div>








