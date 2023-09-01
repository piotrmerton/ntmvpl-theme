<?php

namespace Theme;

use Timber\Timber;

class Post
{

    /**
     * Get Posts Query
     *
     * @param $post_type string
     * @param $id_post integer - id of post NOT to retrieve
     * @param $timber boolean - use Timber Query wrapper
     * @return array of WP Post or Timber Post objects
     *
     */
    public static function getPosts($post_type = 'post', $id_post = null, $timber = false): array
    {

        $query = array(
            'post_type' => $post_type,
            'posts_per_page' => 8,
        );


        if(is_int($id_post)) {

            //post__not_in is not cache-friendly, consider alternative approach with looping results and removing match?
            $query['post__not_in'] = array($id_post);
        }

        if($timber) {

            /**
             * Make WP_Post available for Twig templates
             * https://timber.github.io/docs/reference/timber/#get_posts
             */
            $posts = Timber::get_posts($query, 'Theme\TimberPost');

        } else {
            $posts = get_posts($query);
        }

        return $posts;

    }

}
