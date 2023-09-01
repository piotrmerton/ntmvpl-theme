<?php

namespace Theme;

use Timber\Timber;

class Testimonial
{
    public static $post_type = "testimonial";

    public static function getPosts(int $id_post = null, $timber = false): array
    {

        $query = array(
            'post_type' => self::$post_type,
            'posts_per_page' => 10,
        );

        if(is_int($id_post)) {
            $query['p'] = $id_post;
        }

        if($timber) {

            /**
             * Make WP_Post available for Twig templates
             * https://timber.github.io/docs/reference/timber/#get_posts
             */
            $posts = Timber::get_posts($query);

        } else {
            $posts = get_posts($query);
        }

        return $posts;

    }



}
