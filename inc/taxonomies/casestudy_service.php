<?php

/*
 *  Custom Post Type via register_taxonomy
 *  https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 */

register_taxonomy(
    'casestudy_service',
    array('casestudy'),
    array(
        'labels' => array(
            'name'          => __('Kategorie usług', 'theme_bo'),
            'singular_name' => __('Usługa', 'theme_bo'),
            'add_new_item'  => __('Dodaj nową kategorię', 'theme_bo'),
            'new_item_name' => __('Dodaj nową kategorię', 'theme_bo'),
            'edit_item'     => __('Edytuj kategorię', 'theme_bo'),
        ),
        'show_ui'           => true,
        'show_tagcloud'     => false,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'hierarchical'      => false,
        'meta_box_cb'       => false, //Meta box will be re-added via ACF with better UI
        'rewrite'           => array( 'slug' => 'usluga' ),
        'query_var'         => __('usluga', 'theme'), //not sure if query_var will work with WPML
        'show_in_rest'      => true,
    )
);
