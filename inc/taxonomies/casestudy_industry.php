<?php

/*
 *  Custom Post Type via register_taxonomy
 *  https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 */

register_taxonomy(
    'casestudy_industry',
    array('casestudy'),
    array(
        'labels' => array(
            'name'          => __('Branże', 'theme_bo'),
            'singular_name' => __('Branża', 'theme_bo'),
            'add_new_item'  => __('Dodaj nową branżę', 'theme_bo'),
            'new_item_name' => __('Dodaj nową branżę', 'theme_bo'),
            'edit_item'     => __('Edytuj branżę', 'theme_bo'),
        ),
        'show_ui'           => true,
        'show_tagcloud'     => false,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'hierarchical'      => false,
        'meta_box_cb'       => false, //Meta box will be re-added via ACF with better UI
        'rewrite'           => array( 'slug' => 'branza' ),
        'query_var'         => __('branza', 'theme'), //not sure if query_var will work with WPML
        'show_in_rest'      => true,
    )
);
