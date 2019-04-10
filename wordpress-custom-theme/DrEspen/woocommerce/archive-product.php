  <?php get_template_part('templates/page', 'header'); ?>

<div id="woocommerce-store">

<style type="text/css">
  
  .revolution-slider {
    margin-top: -2em;
  }

</style>


<div class="container">
  <div class="row">
    <div class="revolution-slider">
      <?php putRevSlider("shop-slider") ?>
    </div>
  </div>
</div>



<div class="container teal_bg page-banner-holder"> 
  <div class="row">
    <div class="col-lg-12 page-banner">
      <h4>Products</h4>


<div id="search-box" class="widget widget_search">
      <div class="search_form_wrap">
          <form name="search_form" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>" class="search_form">
          <label class="heading_font">Search</label>
          <input class="search-field" type="text" name="s" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" value=""/>
          <input class="search-submit" type="submit" value="">
            <input type="hidden" name="post_type" value="product" />
          </form>
     <i class="fa fa-search"></i>
</div></div>
    </div>
  </div>
</div>


  <div class="container product-start">
  <div class="row">
    <div class="col-lg-12">
      
  <?php woocommerce_content(); ?>

  <div class="col-lg-12 row checkout-button"><a href="/cart/" class="btn btn-orange btn-lg w-100" role="button">Checkout Now!</a></div>
    </div>
<!--
    <div class="col-lg-3">
      
  sidebar
    </div>
    -->
</div>
  </div>
</div>
