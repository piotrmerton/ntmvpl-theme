<?php

namespace Theme;

use Timber\Timber;

class Service
{
    public static $post_type = "service";

    public static function getServices($timber = false): array
    {

        $query = array(
            'post_type' => self::$post_type,
            'posts_per_page' => -1,
            'parent' => 0,
        );


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
