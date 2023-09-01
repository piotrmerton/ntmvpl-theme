<?php

/**
 * WordPress Back Office Customizations
 * 
 * Extracted from theme-functions.php
 *
 */


/**
* Removes Posts and Comments section from admin Back office menu
*/
function theme_remove_admin_menus()
{
    global $submenu;

    //remove comments
    remove_menu_page('edit-comments.php');

    // remove customize link
    unset($submenu['themes.php'][6]);

}


/**
 * Remove native Meta Boxes
 */
function theme_remove_meta_boxes()
{
    // remove native Meta Boxes - we will re-add it later using ACF with better UI
    remove_meta_box('postimagediv', 'post', 'side'); //Post Thumbnail
    remove_meta_box('categorydiv', 'post', 'side'); //Categories
    remove_meta_box('tagsdiv-post_tag', 'post', 'side'); //Tags
}

/**
 * Use own external URL in admin login screen
 * http://wp.smashingmagazine.com/2012/05/17/customize-wordpress-admin-easily/
 */
function theme_login_url()
{
    return home_url();
}



/**
 * Remove default WordPress favicon
 * https://stackoverflow.com/a/64164537
 */
function theme_remove_wordpress_favicon()
{
    exit;
}


/**
 *  Change "Enter Title Here" help text on a Custom Post Type
 *  http://wordpress.stackexchange.com/a/13004
 */
function theme_custom_enter_title($input)
{
    global $post_type;

    if (is_admin()) {
        if($post_type == "testimonial") {
            return __('Dodaj tytuł (tytuł nie będzie widoczny publicznie)');
        }
        if($post_type == "employee") {
            return __('Imię i nazwisko pracownika');
        }
    }

    return $input;
}


/**
 * Creates <select> dropdown in Post Type Edit screen allowing filtering by Custom Taxonomy
 * source:  https://wordpress.stackexchange.com/a/346273
 */
function theme_add_custom_taxonomy_filter_to_edit_screen($taxonomy_name)
{

    $taxonomy = get_taxonomy($taxonomy_name);

    if($taxonomy->query_var === false) {
        return;
    }

    $param = is_string($taxonomy->query_var) ? $taxonomy->query_var : $taxonomy;

    echo '<label class="screen-reader-text" for="'.$taxonomy_name.'">Filter by ' .
        esc_html($taxonomy->labels->singular_name) . '</label>';

    wp_dropdown_categories([
        'show_option_all' => $taxonomy->labels->all_items,
        'hide_empty'      => 0, // include categories that have no posts
        'hierarchical'    => $taxonomy->hierarchical,
        'show_count'      => 0, // don't show the category's posts count
        'orderby'         => 'name',
        'selected'        => filter_input(INPUT_GET, $param),
        'taxonomy'        => $taxonomy_name,
        'name'            => $param,
        'value_field'     => 'slug',
    ]);
}


/**
 * Back office custom columns management: add custom columns to CPT Testimonial Edit Screen
 * https://wordpress.stackexchange.com/a/253644
 */

//Filter columns via manage_{post_type}_posts_columns Hook
function theme_manage_cpt_testimonial_columns($columns)
{
    unset($columns['date']);
    $columns['quote'] = __('Opinia', 'theme');

    return $columns;
}
//Add content to Custom Column via manage_{post_type}_posts_custom_column Hook
function theme_cpt_testimonial_column_content($column, $post_id)
{
    switch ($column) {

        case 'quote':
            echo get_post_meta($post_id, 'testimonial_quote', true);
            break;

    }
}


/**
 * Add custom field to Advanced Link Field
 * https://www.acf-extended.com/features/fields/advanced-link
 */
function theme_acf_advanced_link_sub_fields($sub_fields, $field, $value){
    
    $sub_fields[] = array(
        'name'      => 'toggle_contact_form',
        'key'       => 'toggle_contact_form',
        'label'     => __('Po kliknięciu otwórz modal z Formularzem Kontaktowym'),
        'type'      => 'true_false',
        'ui'        => true
    );
    
    return $sub_fields;
    
}