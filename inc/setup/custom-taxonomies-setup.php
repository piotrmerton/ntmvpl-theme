<?php

/**
 * Custom Taxonomies setup
 */

function theme_custom_taxonomies()
{

    require_once(get_template_directory() . '/inc/taxonomies/casestudy_service.php');
    require_once(get_template_directory() . '/inc/taxonomies/casestudy_industry.php');
    require_once(get_template_directory() . '/inc/taxonomies/employee_group.php');

}

add_action('init', 'theme_custom_taxonomies');
