<?php

use Timber\Timber;
use Theme\TableOfContent;

$id_post = get_queried_object_id();
$post_header = get_post_meta($id_post, 'post_header', true);
$post_lead = get_post_meta($id_post, 'post_lead', true);
$post_has_index = get_post_meta($id_post, 'post_has_index', true);

$context = Timber::get_context();

$context['post'] = Timber::get_post(false, 'Theme\TimberPost');
$context['post_type'] = get_post_type();
$context['post_header'] = $post_header;
$context['post_lead'] = apply_filters( 'the_content', $post_lead );
$context['content_flexible'] = get_field('content_flexible', $id_post);

$next_post = get_next_post();
$prev_post = get_previous_post();

$post_nav = array(
    'next_post' => $next_post ? Timber::get_post($next_post) : false,
    'prev_post' => $prev_post ? Timber::get_post($prev_post) : false,
);

$context['post_nav'] = $post_nav;

//manual Table of Content via ACF Repeater
if($post_has_index) {
    $context['table_of_contents'] = get_field('post_index');
} else {
    //Dynamic Table of Content via filtering Post Content, adding ID to HTML Headers and generate Table of Content dynamically
    $table_of_content = new TableOfContent($id_post);
    $context['content_flexible'] = $table_of_content->filtered_content;
    $context['table_of_contents'] = $table_of_content->index;
}

Timber::render('single-post.twig', $context);
