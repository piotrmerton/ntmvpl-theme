<?php

/**
 * Theme hooks
 * author: futuresystems.pl
 *
 */

/**
 * Init
 * @see theme_disable_emojis()
 */
if(!is_admin()) {
    add_action('init', 'theme_disable_emojis');
}


/**
 * Header front-end markup cleanup
 */
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_resource_hints', 2);

// Turn off oEmbed auto discovery and Remove oEmbed discovery links.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');

//remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

//disable XML RPC
add_filter('xmlrpc_enabled', '__return_false');

//remove favicon
add_action('do_faviconico', 'theme_remove_wordpress_favicon');

//remove CSS related to Gutenberg introduced in 5.0
add_action('wp_print_styles', 'theme_remove_gutenberg_css', 100);


/**
 * WP Nav fixes for current_page_parent helper classes added to all archive menu items no matter the Post Type and not added to CPT archive menu item
 *
 * @see theme_current_type_nav_class()
 * @see theme_add_cpt_ancestor_class()
 */
add_filter('nav_menu_css_class', 'theme_current_type_nav_class', 1, 2);
add_action('nav_menu_css_class', 'theme_add_cpt_ancestor_class', 10, 3);

/**
 * Footer
 *
 * @see theme_deregister_scripts()
 * @see theme_enqueue_frontend_scripts()
 * @see theme_deregister_jquery()
 */
add_action('wp_footer', 'theme_deregister_scripts');

if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'theme_add_css');
    add_action('wp_enqueue_scripts', 'theme_enqueue_frontend_scripts', 5);
    add_action('wp_enqueue_scripts', 'theme_deregister_jquery', 10);
}

/**
 * Back office admin area
 *
 * @see theme_remove_editor()
 * @see theme_remove_admin_menus()
 * @see theme_login_url()
 * @see theme_custom_enter_title()
 * @see theme_remove_meta_boxes()
 */
add_action('init', 'theme_remove_editor');
add_action('admin_menu', 'theme_remove_admin_menus');
add_action('login_head', 'theme_enqueue_backend_scripts');
add_action('admin_head', 'theme_enqueue_backend_scripts');
add_filter('login_headerurl', 'theme_login_url');
add_filter('enter_title_here', 'theme_custom_enter_title');
add_action('do_meta_boxes', 'theme_remove_meta_boxes');


/**
 * Customize Editor
 */
add_filter('mce_buttons_2', 'theme_add_style_selects_button_to_wysiwyg_editor');
add_filter('tiny_mce_before_init', 'theme_custom_wysiwyg_formats');

/**
 * shortcodes
 * see inc/theme-shortcodes.php
 */
add_shortcode('link', 'theme_shortcode_permalinks');


/**
 * Edit Posts/Pages screen management
 *
 * @see theme_add_custom_taxonomy_filter_to_edit_screen()
 * @see manage_testimonial_posts_columns()
 * @see manage_testimonial_posts_custom_column()
 *
 * manage_{post_type}_posts_columns
 * manage_{post_type}_posts_custom_column
 *
 * https://developer.wordpress.org/reference/hooks/manage_posts_columns/
 * https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
 */
add_action('restrict_manage_posts', function ($post_type, $which) {
    if ('top' === $which && $post_type == 'casestudy') {
        theme_add_custom_taxonomy_filter_to_edit_screen('casestudy_service');
        theme_add_custom_taxonomy_filter_to_edit_screen('casestudy_industry');
    }
}, 10, 2);
add_filter('manage_testimonial_posts_columns', 'theme_manage_cpt_testimonial_columns');
add_action('manage_testimonial_posts_custom_column', 'theme_cpt_testimonial_column_content', 10, 2);

/**
 * Advanced Custom Fields Extended Hooks
 * https://www.acf-extended.com/features/fields/advanced-link
 */
add_filter('acfe/fields/advanced_link/sub_fields/name=banner_cta', 'theme_acf_advanced_link_sub_fields', 10, 3);
add_filter('acfe/fields/advanced_link/sub_fields/name=section_cta_link', 'theme_acf_advanced_link_sub_fields', 10, 3);
