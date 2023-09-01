<?php

/*
 *  Custom Post Type via register_post_type
 *  https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */

register_post_type(
    'job_offer',
    array(
        'labels' => array(
            'name'          => __("Oferty pracy", 'theme_bo'),
            'all_items'     => __("Lista ofert pracy", 'theme_bo'),
            'singular_name' => __("Oferta pracy", 'theme_bo'),
            'add_new'       => _x('Dodaj nową ofertę pracy', 'job_offer', 'theme_bo'),
            'add_new_item'  => __('Dodaj nową ofertę pracy', 'theme_bo'),
            'edit_item'     => __('Edytuj ofertę pracy', 'theme_bo'),
            'view_item'     => __('Zobacz', 'theme_bo'),
        ),
        'description'       => __("Lista ofert", 'theme_bo'),
        'public'            => true,
        'menu_position'     => 4,
        'menu_icon'         => 'dashicons-format-aside',
        'supports'          => array( 'title', 'editor' ),
        'show_in_rest'      => true,
        'has_archive'       => true,
        'rewrite'           => array( 'slug' => 'kariera' ),
        'hierarchical'      => false,
        'show_in_nav_menus' => true,
    )
);
