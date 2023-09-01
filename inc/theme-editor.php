<?php

/**
 * Functions related to editing default WordPress Editor
 *
 * Extracted from theme-functions.php
 *
 */


/**
 * Removes editor from Posts and Pages (we are using flexible content via ACF Plugin)
 * https://codex.wordpress.org/Function_Reference/remove_post_type_support
 */
function theme_remove_editor()
{
    remove_post_type_support('post', 'editor');
    remove_post_type_support('page', 'editor');
}

/**
 * Add custom Formats Styles to WordPress WYSIWYG Text Editor
 * https://wordpress.stackexchange.com/a/367065
 */

//Add button to Toolbar first...
function theme_add_style_selects_button_to_wysiwyg_editor($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

//...add custom styles.
function theme_custom_wysiwyg_formats($init_array)
{

    // Define the style_formats array
    $style_formats = array(
        array(
            'title' => __('Paragraf średni (18px)', 'theme'),
            'block' => 'div', //unfortunately, "p" doesn't work
            'classes' => 'text--medium',
            'wrapper' => true,
        ),
        array(
            'title' => __('Paragraf duży (20px)', 'theme'),
            'block' => 'div',
            'classes' => 'text--big',
            'wrapper' => true,
        ),
        array(
            'title' => __('Paragraf nagłówkowy (22px)', 'theme'),
            'block' => 'div',
            'classes' => 'text--header',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}
