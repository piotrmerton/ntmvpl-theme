<?php

/**
 * Theme misc functions
 *
 * To avoid spaghetti code some functions were extracted by logic to additional files:
 *
 * theme-assets.php - functions related to JS and CSS assets management
 * theme-admin.php - functions related to Back Office Customizations
 * theme-editor.php - functions related to WordPress default Editor
 *
 *
 * author: futuresystems.pl
 *
 */


/**
 * Disable emojis
 * https://wordpress.stackexchange.com/a/185578
 */
function theme_disable_emojis()
{
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}


/**
 *
 * WordPress Nav menu classes hierarchy is not consistent across different Custom Post Types,
 * i.e.: _wp_menu_item_classes_by_context() @ nav-menu-template.php prints current_page_parent
 * for "page_for_posts" (see Settings / Options Reading in BO) when viewing CPT archive pages;
 *
 * Solution: https://stackoverflow.com/a/18744237
 *
 * This is one possible solution that fits our needs, however it's not perfect:
 * when placing CPT item under Page item in Nav, the parent won't be highlighted.
 *
 * More:
 *
 * http://core.trac.wordpress.org/ticket/13543
 * https://stackoverflow.com/q/3269878
 * https://wordpress.stackexchange.com/q/206523
 *
 */
function theme_current_type_nav_class($css_class, $item)
{
    global $wp_query;
    static $custom_post_types, $filter_func;

    //don't add any classes for 404 page
    if(is_404()) {
        return array();
    }

    if (empty($custom_post_types)) {
        $custom_post_types = get_post_types(array('_builtin' => false));
    }

    $post_type = get_post_type();

    /**
     * Additional fail state: when Query doesn't have any results, the get_post_type() will return null
     */

    if (empty($post_type) && array_key_exists('post_type', $wp_query->query)) {
        $post_type = $wp_query->query['post_type'];
    }

    if ('page' == $item->object && in_array($post_type, $custom_post_types)) {
        $css_class = array_filter($css_class, function ($el) {
            return $el !== "current_page_parent";
        });

        $template = get_page_template_slug($item->object_id);
        if (!empty($template) && preg_match("/^page(-[^-]+)*-$post_type/", $template) === 1) {
            array_push($css_class, 'current_page_parent');
        }

    }

    return $css_class;
}

/**
 * Another problem with WP Nav:
 * it doesn't add current_page_parent class on the archive menu item of a Custom Post Type
 *
 * Solution: https://wordpress.stackexchange.com/a/351526
 *
 * More: https://wordpress.stackexchange.com/q/100220
 *
 * */
function theme_add_cpt_ancestor_class($classes, $item, $args)
{

    if(!is_singular() || is_singular(array('post', 'page'))) {
        return $classes;
    }

    global $post;

    $current_post_type = get_post_type_object(get_post_type($post->ID));

    $current_post_type_slug = is_array($current_post_type->rewrite) ? $current_post_type->rewrite['slug'] : $current_post_type->name;

    $menu_slug = strtolower(trim($item->url));

    if(strpos($menu_slug, $current_post_type_slug) !== false) {
        $classes[] = 'current_page_parent';
    }


    return $classes;


}
