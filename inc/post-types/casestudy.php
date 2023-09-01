<?php

/*
 *  Custom Post Type via register_post_type
 *  https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */

register_post_type(
    'casestudy',
    array(
        'labels' => array(
            'name'          => __("Case studies", 'theme_bo'),
            'all_items'     => __("Lista artykułów", 'theme_bo'),
            'singular_name' => __("Case study", 'theme_bo'),
            'add_new'       => _x('Dodaj nowy', 'casestudy', 'theme_bo'),
            'add_new_item'  => __('Dodaj nowe Case Study', 'theme_bo'),
            'edit_item'     => __('Edytuj Case Study', 'theme_bo'),
            'view_item'     => __('Zobacz Case Study', 'theme_bo'),
        ),
        'description'   => __("Lista Case Studies", 'theme_bo'),
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'     => 'dashicons-chart-bar',
        'supports'      => array( 'title' ), //no editor due to flexible content via ACF
        'show_in_rest'  => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'efekty' ),
        'hierarchical'  => true,
    )
);
