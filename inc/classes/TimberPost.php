<?php

namespace Theme;

use Theme\Terms;

/**
 * Extend Timber Post
 * 
 * https://timber.github.io/docs/guides/extending-timber/#an-example-that-extends-timberpost
 * https://stackoverflow.com/a/54910445
 * 
 **/

class TimberPost extends \Timber\Post {


    /**
     * Wrapper for original Timber Post terms method.
     * 
     * Iterates over results and adds custom property with Term Query Var link that we are using to filter Terms on Case Studies archive; Thus, everytime the Timber post.terms method is called withing Twig file, we will have access term url via taxonomy's query var 
     */
    public function terms($args = array(), $merge = true, $term_class = '') {

        $terms = parent::terms($args, $merge, $term_class);
        
        if(is_array($terms)) {
            foreach($terms as $term) {
                $term->query_link = Terms::getTermQueryLink($term);
            }
        }

        return $terms;


	}


}