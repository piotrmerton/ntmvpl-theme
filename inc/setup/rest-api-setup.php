<?php

function theme_customize_rest_api()
{
    //require_once( get_template_directory() . '/inc/endpoints/posts.php' );
}

add_action('rest_api_init', 'theme_customize_rest_api');
