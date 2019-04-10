  <?php get_template_part('templates/page', 'header'); ?>



<div id="woocommerce-store">


<div class="container product-start">
  <div class="col-lg-12">
    
<?php woocommerce_content(); ?>
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
  </div>
</div>
</div>
