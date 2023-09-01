<?php

namespace Theme;

/**
 * helper theme class that prepares breadcrumbs for Timber
 */

 class Breadcrumbs {


    /**
     * populates array of urls with titles for Timber to loop through
     */
    public static function getBreadcrumbs() {

        global $post;

        $breadcrumbs = array();

        $breadcrumbs[] = array(
            'title' => __('Strona główna', 'theme'),
            'url' => home_url(),
        );

        if( is_post_type_archive('post') || is_singular('post') ) {

            $category = self::getPostCategory($post->ID);
              
            $breadcrumbs[] = array(
                'title' => $category->name,
                'url' => get_category_link($category->term_id),
            );
                    
        }
    
        if( is_tag() ) {

            $breadcrumbs[] = array(
                'title' => __('Tematy', 'theme'),
                'url' => get_permalink(THEME_ARCHIVE_PAGE_ID),
            );
            $breadcrumbs[] = array(
                'title' => get_queried_object()->name,
                'url' => '',
            );

        }

        if( is_search() ) {

            $breadcrumbs[] = array(
                'title' => __('Wyniki wyszukiwania', 'theme'),
                'url' => '',
            );

        }        
       
        if( is_singular() || is_page() ) {
    
            $breadcrumbs[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
            );
                    
        }     
    
        return $breadcrumbs;

    }


    public static function getPostCategory($id_post) {
        $categories = get_the_category($id_post);
        
        return $categories[0];
    }


}
