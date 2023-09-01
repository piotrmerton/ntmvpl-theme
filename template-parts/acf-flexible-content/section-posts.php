<?php

/*
 * ACF Flexible Content Layout custom "controller"
 *
 * @array   $loop   Twig loop context
 * @array   $field  Flexible content field values
 *
 * @see theme_render_flexible_content() @ inc/setup/timber-setup.php
 */

use Timber\Timber;
use Theme\Post;
use Theme\Helpers;

$post_type = $field['section_settings_postType'];

if(is_singular() && $post_type == get_post_type()) {
    $id_post = get_queried_object_id();
} else {
    $id_post = null;
}

$posts = Post::getPosts($post_type, $id_post, true);

$context['section']['posts'] = $posts;



/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);
$context['section']['section_settings_bgColor'] = $section_bg_color;

Timber::render('views/content/acf-flexible-content/section-posts.twig', $context);
