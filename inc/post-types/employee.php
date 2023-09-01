<?php

/*
 *  Custom Post Type via register_post_type
 *  https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */

register_post_type(
    'employee',
    array(
        'labels' => array(
            'name'          => __("Zespół", 'theme_bo'),
            'all_items'     => __("Lista pracowników", 'theme_bo'),
            'singular_name' => __("Zespół", 'theme_bo'),
            'add_new'       => _x('Dodaj nowego pracownika', 'employee', 'theme_bo'),
            'add_new_item'  => __('Dodaj nowego pracownika', 'theme_bo'),
            'edit_item'     => __('Edytuj pracownika', 'theme_bo'),
            'view_item'     => __('Zobacz', 'theme_bo'),
        ),
        'description'       => __("Lista pracowników", 'theme_bo'),
        'public'            => true,
        'menu_position'     => 4,
        'menu_icon'         => 'dashicons-admin-users',
        'supports'          => array( 'title' ), //no editor due to flexible content via ACF
        'show_in_rest'      => true,
        'has_archive'       => false,
        'rewrite'           => false,
        'hierarchical'      => false,
        'show_in_nav_menus' => false,
    )
);
