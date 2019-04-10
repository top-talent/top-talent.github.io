<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; 
  
  if(get_post_type() == 'events'){
      $get_date = date('Y');  
      echo '<h2 class="page-title" itemprop="headline">'.$get_date.' Calendar of Events</h2>';
        
        $month_aray = array('01','02','03','04','05','06','07','08','09','10','11','12');
           
           
        foreach($month_aray as $mm){
          
          $date_nn = date('Y-'.$mm.'-01');          
           $get_ids = $wpdb->get_results("SELECT distinct(p.ID) FROM wp_posts p INNER JOIN wp_postmeta pm ON p.ID = pm.post_id INNER JOIN wp_postmeta pm1 ON p.ID = pm1.post_id WHERE p.post_type = 'events' AND ((pm.meta_key='prefix-datetime_start_date' and DATE_FORMAT(pm.meta_value,'%Y %m') <= DATE_FORMAT('$date_nn','%Y %m')) AND (pm1.meta_key='prefix-datetime_end_date' and DATE_FORMAT(pm1.meta_value,'%Y %m') >= DATE_FORMAT('$date_nn','%Y %m'))) AND  p.post_status = 'publish'");
          
           $time=strtotime($date_nn);
           $month=date("F",$time);//month name
          
          if(!empty($get_ids)){
            echo '<div class="outer_month">';
                echo '<h2>'.$month.'</h2>';

                foreach($get_ids as $id){
                  $post_title = get_the_title($id->ID);
                  echo '<h5><a href="'.get_the_permalink($id->ID).'" target="_blank">'.$post_title.'</a></h5>';
                    
                  $start_date =  get_post_meta($id->ID,'prefix-datetime_start_date',true);
                  $end_date   =  get_post_meta($id->ID,'prefix-datetime_end_date',true);
                    
                  
                  $my_postid = $id->ID;//This is page id or post id
                  $content_post = get_post($my_postid);
                  $content = $content_post->post_content;
                  $content = apply_filters('the_content', $content);
                  $content = str_replace(']]>', ']]&gt;', $content);
                  
                  
                  //echo $start_date." ".$end_date."<br>";
                  $start_final_date = date('D M j, h:i A',strtotime($start_date));
                  $end_final_date   = date('D M j, h:i A',strtotime($end_date));
                  
                  echo '<span>'.$start_final_date." - ".$end_final_date.'</span>';
                  
                  echo '<p>'.$content.'</p>';
                  
                }
            echo '</div>';   
          }else{
             echo '<div class="outer_month no_event">';
                echo '<h2>'.$month.'</h2>';
                echo '<p>Coming Soon...</p>';
            echo '</div>';
          }
          
        }
        
    
    
  }else{
    while (have_posts()) : the_post();  

    get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());  

    endwhile;
  }


 the_posts_navigation();

