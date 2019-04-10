<div class="sub-nav">
  <div class="container">
    <div class="row">
                  <?php
      if (has_nav_menu('health-sub')) :
        wp_nav_menu(['theme_location' => 'health-sub', 'container' => 'div', 'container_class' => '',  'menu_class' => 'nav navbar-nav primary-menu']);
      endif;
      ?>
    </div>

  </div>
</div>


<div class="container">
  <div class="col-lg-12">
<?php get_template_part('templates/content-single', get_post_type()); ?>
  </div>
</div>
