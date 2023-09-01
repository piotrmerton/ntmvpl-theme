<?php

/*
 *  Custom Post Type via register_post_type
 *  https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */

register_post_type(
    'testimonial',
    array(
        'labels' => array(
            'name'          => __("Opinie Klientów", 'theme_bo'),
            'all_items'     => __("Lista opinii", 'theme_bo'),
            'singular_name' => __("Opinia", 'theme_bo'),
            'add_new'       => _x('Dodaj nową', 'testimonial', 'theme_bo'),
            'add_new_item'  => __('Dodaj nową Opinię Klienta', 'theme_bo'),
            'edit_item'     => __('Edytuj Opinię Klienta', 'theme_bo'),
            'view_item'     => __('Zobacz', 'theme_bo'),
        ),
        'description'   => __("Lista Opinii Klientów", 'theme_bo'),
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'     => 'dashicons-testimonial',
        'supports'      => array( 'title' ), //no editor due to flexible content via ACF
        'show_in_rest'  => true,
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'referencje' ),
        'hierarchical'  => true,
    )
);
