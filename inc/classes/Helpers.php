<?php

namespace Theme;

use Theme\ThemeSettings;

class Helpers
{
    /**
     * For ACF sections colors (backgrounds or other elements) we are using ACF Extended Color Picker (https://www.acf-extended.com/features/fields/color-picker), however it doesn't use slugs. So let's read slugs from theme.json and add them to template.
     *
     * See acfe_field_color_picker() @ acf-extended-pro/includes/fields/field-color-picker.php for reference
     *
     *
     * @param $color ACF Extended Color Picker field
     * @return $array
     */

    public static function addPropertiesToAcfeColorPickedColor($color)
    {

        if(!is_array($color)) {
            return null;
        }

        $theme_settings = ThemeSettings::getThemeSettings();

        if(!empty($color) && isset($theme_settings['color']['palette']['theme'])) {

            foreach($theme_settings['color']['palette']['theme'] as $palette) {
                if($palette['name'] == $color['label']) {
                    $color['slug'] = $palette['slug'];
                    $color['whiteText'] = $palette['whiteText']; //custom property
                }
            }
        }

        return $color;

    }

}
