<?php

/**
 * Custom Post Types setup
 */

function theme_custom_post_types()
{
    require_once(get_template_directory() . '/inc/post-types/service.php');
    require_once(get_template_directory() . '/inc/post-types/casestudy.php');
    require_once(get_template_directory() . '/inc/post-types/testimonial.php');
    require_once(get_template_directory() . '/inc/post-types/employee.php');
    require_once(get_template_directory() . '/inc/post-types/job_offer.php');
}

add_action('init', 'theme_custom_post_types');
