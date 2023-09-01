<?php

/**
 * Misc functions related with Theme's and Core assets (JS and CSS) managements functions
 *
 * Extracted from theme-functions.php
 *
 */

/**
* Localize the script with new data: makes some server-side data available to js from the server side of
*/
function theme_enqueue_frontend_scripts()
{

    global $theme_vars; //see inc/theme-variables.php

    // Register the scripts
    wp_register_script('js_bundle', get_template_directory_uri() . '/assets/js/global.bundle.js', array(), '1691243049', true);
    //some context related functions (is_home) and filters (wpml_object_id) doesn't work during bootup, so we need to wrap them in hook
    //see: https://wordpress.stackexchange.com/a/47305
    $theme_vars['is_home'] = is_home();

    //https://codex.wordpress.org/Function_Reference/wp_localize_script
    wp_localize_script('js_bundle', 'wp_core', $theme_vars);

    // Enqueue script with localized data
    wp_enqueue_script('js_bundle');

}

/**
 * Load custom stylesheet for WordPress Admin Area and Login Page
 */
function theme_enqueue_backend_scripts()
{
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/assets/css/admin.css');

    //custom CSS to TinyMCE WYSIWYG editor
    add_editor_style(get_template_directory_uri(). '/assets/css/editor.css');
}

/**
 * Deregister unwanted scripts
 */
function theme_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

/**
 * Remove Guntenberg related CSS stylesheets introduced in 5.0
 * https://stackoverflow.com/a/52280110
 */
function theme_remove_gutenberg_css()
{

    //since 5.0
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');

    //since 5.9
    wp_deregister_style('global-styles');
    wp_dequeue_style('global-styles');

    //since 6.1
    wp_deregister_style('classic-theme-styles');
    wp_dequeue_style('classic-theme-styles');

    //Third Party Plugin Save SVG
    wp_deregister_style('safe-svg-svg-icon-style');
    wp_dequeue_style('safe-svg-svg-icon-style');

}


/**
 * Deregister jQuery in order to serve it via CDN (but don't enqueue - by default we are not using it, but some plugins might)
 * https://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/
 */
function theme_deregister_jquery()
{

    // Deregister jQuery first...
    wp_deregister_script('jquery');

    // ..and register jQuery from CDN
    wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js", false, null, true);

}

/**
 * Register and Enqueue CSS here, however keep in mind that it will be added to <HEAD>
 */
function theme_add_css()
{
    //wp_enqueue_style('contact', get_template_directory_uri() . '/assets/css/pages/contact.css');
}
