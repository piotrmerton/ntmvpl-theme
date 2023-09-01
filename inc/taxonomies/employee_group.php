<?php

/*
 *  Custom Post Type via register_taxonomy
 *  https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 */

register_taxonomy(
    'employee_group',
    array('employee'),
    array(
        'labels' => array(
            'name'          => __('Grupy pracowników', 'theme_bo'),
            'singular_name' => __('Grupa pracowników', 'theme_bo'),
            'add_new_item'  => __('Dodaj nową grupę', 'theme_bo'),
            'new_item_name' => __('Dodaj nową grupę', 'theme_bo'),
            'edit_item'     => __('Edytuj grupę', 'theme_bo'),
        ),
        'description'       => __('Grupa pracowników determinuje, w którym miejscu dany pracownik zostanie wyświetlony na podstronie Kontakt', 'theme_bo'),
        'show_ui'           => true,
        'show_tagcloud'     => false,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'hierarchical'      => false,
        'meta_box_cb'       => false, //Meta box will be re-added via ACF with better UI
        'rewrite'           => false,
        'query_var'         => false,
        'show_in_rest'      => false,
    )
);
