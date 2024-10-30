<?php

/*
  Plugin Name: Category Title Prefix
  Plugin URI: http://ranewallin.com/wordpress-plugin-category-title-prefix/
  Description: Prefixes the title with the category name in the form '[Category Name] Post Title' on the front page. Currently, it prepends all categories to the title, but this may be changed in future updates, if there is any interest in it. It is also designed to only prefix titles on the site's front page.
  Author: Rane Wallin
  Version: 1.0
  Author URI: http://ranewallin.com
  License: GPLv2
 */

add_filter('the_title', 'rw_ctp_add_category_prefix', 10, 2);

/*  
 *  Prepends category tag to the title 
 * 
 *  Adds a prefix to the title of a post based on the post's category. This only
 *  works on the front page of the site. To make this work on all pages, remove
 *  the is_front_page() check.
 * 
 */

function rw_ctp_add_category_prefix( $title, $id ) {
    
    if ( is_front_page() && get_post_type( $id ) == 'post' )
    {
        $categories = wp_get_post_categories( $id );

        foreach( $categories as $category ) {
            $this_cat = get_category( $category );
            $prepended_title .= '[' . $this_cat->cat_name . ']' . ' ';
        }

         return $prepended_title . $title;
    }
    
    else return $title;
}

?>