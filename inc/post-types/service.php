<?php

/*
 *  Custom Post Type via register_post_type
 *  https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */

register_post_type(
    'service',
    array(
        'labels' => array(
            'name'          => __("Oferta", 'theme_bo'),
            'all_items'     => __("Lista podstron ofertowych", 'theme_bo'),
            'singular_name' => __("Strona ofertowa", 'theme_bo'),
            'add_new'       => _x('Dodaj podstronę', 'service', 'theme_bo'),
            'add_new_item'  => __('Dodaj podstronę ofertową', 'theme_bo'),
            'edit_item'     => __('Edytuj Stronę ofertową', 'theme_bo'),
            'view_item'     => __('Zobacz Stronę ofertową', 'theme_bo'),
        ),
        'description'   => __("Lista stron ofertowych", 'theme_bo'),
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'     => 'dashicons-text',
        'supports'      => array( 'title' ), //no editor due to flexible content via ACF
        'show_in_rest'  => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'oferta' ),
        'hierarchical'  => true,
    )
);
