<?php
/**
 * Theme global variables for template files
 * Some global variables later enqueued in JS via wp_localize_script (@see theme_enqueue_scripts() ), so don't put any fragile data here
 * TO DO: refactor as object
 * author: futuresystems.pl
 *
 */

$lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'pl';
$rest_url = get_rest_url(null, 'wp/v2/');
$theme_rest_url = get_rest_url(null, 'theme/v1/');

define('THEME_INDEX_PAGE_ID', 0);
define('THEME_BLOG_PAGE_ID', 10);
define('THEME_CONTACT_PAGE_ID', 12);
define('THEME_WPCF7_DEFAULT_FORM_ID', 176);
define('THEME_PRIVACY_PAGE_ID', 0);

// variables for js

//some default endpoints for React Components defined here to easily
//override via template files regarding to current contex or filters (i.e. is_home or wpml_object_id, see theme_enqueue_frontend_scripts() at theme-functions.php)
//lang param is required when using WPML
$theme_endpoints = array(
    'base' => $rest_url,
    'theme' => $theme_rest_url,
    'posts' => $rest_url . 'posts?per_page=4',
);

$i18n = array(
    'no_data' => __('Brak danych.', 'theme'),
    'no_posts' => __('Brak postów do wyświetlenia.', 'theme'),
    'read_more' => __('Czytaj dalej', 'theme'),
    'read_full' => __('Przeczytaj całość', 'theme'),
    'nav_show_all' => __('Pokaż wszystko', 'theme'),
);

// Global variables for template files and JS (all will be public in JS due to enqueue_scripts)
$theme_vars = array(
    'base_url' => home_url(),
    'theme_url' => get_template_directory_uri(),
    'lang' => $lang,
    'rest' => $theme_endpoints,
    'i18n' => $i18n,
);
