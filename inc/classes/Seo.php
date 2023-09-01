<?php

namespace Theme;

/**
 * helper theme class that prepares simple meta tags for SEO
 *
 */

class Seo
{
    public static function getMetaTags()
    {

        /**
         * abort if Yoast is installed
         * TO DO: check for other popular plugins as well, i.e. Math Rank?
         **/
        if (
            is_plugin_active('wordpress-seo/wp-seo.php') ||
            is_plugin_active('wordpress-seo-premium/wp-seo-premium.php')
        ) {
            return false;
        }

        if(is_home() || is_front_page()) {

            $seo = array(
                'title' => get_bloginfo('name'),
                'desc' => get_bloginfo('description'),
            );

        }

        if(is_single()) {

            $seo = array(
                'title' => get_the_title() . ' - ' . get_bloginfo('name'),
                'desc' => get_the_excerpt(),
            );

        }

        $seo['image'] = self::getOgImage();


        return $seo;

    }


    public static function getOgImage()
    {

        global $post;

        if(is_single() && has_post_thumbnail()) {

            $id_post_thumbnail = get_post_thumbnail_id();
            $image_data = wp_get_attachment_image_src($id_post_thumbnail, 'full');

            $image = array(
                'url' => get_the_post_thumbnail_url($post, 'full'), //or $image_data[0]
                'width' => $image_data[1],
                'height' => $image_data[2],
            );

        } else {

            $image = array(
                'url' => get_stylesheet_directory_uri() . '/assets/img/seo/og-image.jpg',
                'width' => '1200',
                'height' => '630',
            );

        }

        return $image;

    }

}
