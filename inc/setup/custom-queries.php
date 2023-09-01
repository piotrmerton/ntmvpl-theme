<?php

/**
 *  There is no way to stop default query from running without preventing wp() to run, so
 *  the only method to alter main query is to use pre_get_posts hook:
 *  https://developer.wordpress.org/reference/hooks/pre_get_posts/
 */
function theme_customize_main_query($query)
{

    if(is_admin() or !$query->is_main_query()) {
        return false;
    }

}

function theme_customize_tax_query($query)
{

    if(is_admin() or !$query->is_main_query()) {
        return false;
    }

}

add_action('pre_get_posts', 'theme_customize_main_query', 10, 1);
add_action('parse_tax_query', 'theme_customize_tax_query');
