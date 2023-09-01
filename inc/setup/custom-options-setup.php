<?php

/**
 * Custom Options via ACF Pro v5
 *
 * https://www.advancedcustomfields.com/resources/options-page/
 * https://www.advancedcustomfields.com/resources/acf_add_options_page/
 *
 */
if(function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => __('Ustawienia zaawansowane'),
        'menu_slug'  => 'theme-settings',
        'icon_url'   => 'dashicons-admin-generic',
        'post_id'    => 'contact_data',
        //'redirect' => false,
    ));

    /**
     * Add Options Page for Custom Post Type Menu
     * https://support.advancedcustomfields.com/forums/topic/acf-options-page-for-post-type/#post-43261
     */
    acf_add_options_sub_page(array(
        'page_title'      => 'Opis na listingu',
        'menu_title'      => 'Opis na listingu',
        'menu_slug'		  => 'casestudy-archive-desc',
        'parent_slug'     => 'edit.php?post_type=casestudy',
        'post_id' 		  => 'seo',
        'updated_message' => __('Opis zaktualizowany', 'theme_bo'),
    ));

    acf_add_options_sub_page(array(
        'page_title'      => 'Oferta - edytujesz treść strony zbiorczej',
        'menu_title'      => 'Oferta - strona zbiorcza',
        'menu_slug'		  => 'service-archive-content',
        'parent_slug'     => 'edit.php?post_type=service',
        'post_id' 		  => 'cpt_service_archive_content',
        'updated_message' => __('Treść zaktualizowana', 'theme_bo'),
    ));

}
