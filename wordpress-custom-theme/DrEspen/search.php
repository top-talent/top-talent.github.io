<?php get_template_part('templates/page', 'header'); ?>


  <div id="search-page" class="container product-start">
    <div class="col-lg-12">
<?php $sresult = $_REQUEST['s']; 
    if($sresult == ''): ?>
   <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); 
  else: ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php else: ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); endif; endif;?>

</div>