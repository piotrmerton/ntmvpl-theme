<?php

namespace Theme;

/**
 * helper theme class that prepares simple meta tags for SEO
 *
 */

class ThemeSettings
{
    /**
     * Get theme settings from theme.json
     * see:
     *
     * https://developer.wordpress.org/themes/advanced-topics/theme-json/
     * https://developer.wordpress.org/reference/classes/wp_theme_json_resolver/get_theme_data/
     */
    public static function getThemeSettings()
    {

        $theme_data = \WP_Theme_JSON_Resolver::get_theme_data();
        $theme_settings = $theme_data->get_settings();

        return $theme_settings;
    }

}
