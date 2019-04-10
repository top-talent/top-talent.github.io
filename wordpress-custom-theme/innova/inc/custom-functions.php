<?php
    /**
    *   Custom Functions
    *
    *   @package Crunch
    *   @since Crunch 2.0.0
    */

    /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    /* ~~~~~~~~~~ Custom function ~~~~~~~~~~ */
    /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        /* ~~~~~~~~~~ Show the slug functions ~~~~~~~~~~ */

        function the_slug($echo=true){
        	$slug = basename(get_permalink());
            do_action('before_slug', $slug);
            $slug = apply_filters('slug_filter', $slug);
            if( $echo ) echo $slug;
            do_action('after_slug', $slug);
            return $slug;
        }


        /* ~~~~~~~~~~ Get the slug function ~~~~~~~~~~ */

        function get_the_slug() {
            global $post;

            if ( is_single() || is_page() ) {
                return $post->post_name;
            } else {
                return "";
            }
        }


        /* ~~~~~~~~~~ Create slug ~~~~~~~~~~ */

        function create_slug($string){
            $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
            $slug = strtolower($slug);
            return $slug;
        }


        /* ~~~~~~~~~~ Custom pagination ~~~~~~~~~~ */

        function custom_pagination() {
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            $pages = paginate_links(
                array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages,
                    'prev_next' => false,
                    'type'  => 'array',
                    'prev_next'   => TRUE,
                    'prev_text'    => __('&laquo;'),
                    'next_text'    => __('&raquo;'),
                )
            );

            if( is_array( $pages ) ) {
                $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                echo '<nav aria-label="Page navigation">
                        <ul class="pagination">';
                foreach ( $pages as $page ) {
                    echo "<li class=\"page-item\">$page</li>";
                }
                echo '</ul>
                </nav>';
            }
        }


        /* ~~~~~~~~~~ Author full name ~~~~~~~~~~ */

        function author_full_name() {
            global $post;
            $fname = get_the_author_meta('first_name');
            $lname = get_the_author_meta('last_name');
            $full_name = '';

            if( empty($fname)){
                return $lname;
            } elseif( empty( $lname )){
                return $fname;
            } else {
                return "{$fname} {$lname}";
            }
        }

    ?>