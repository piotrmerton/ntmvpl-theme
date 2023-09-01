<?php

/*
 * ACF Flexible Content Layout custom "controller"
 *
 * @array   $loop   Twig loop context
 * @array   $field  Flexible content field values
 *
 * @see theme_render_flexible_content() @ inc/setup/timber-setup.php
 */

use Timber\Timber;
use Theme\Helpers;

$section_layout = $field['section_settings_layout'];
$section_cards = $field['cards'];
$section_columns = $field['section_settings_columns'];


//Slider always initialized due to mobile UX
//$has_slider = $section_layout == 'horizontal' && count($section_cards) > $section_columns ? true : false;
$has_slider = $section_layout == 'horizontal' ? true : false;

$context['section']['has_slider'] = $has_slider;

/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);
$context['section']['section_settings_bgColor'] = $section_bg_color;

Timber::render('views/content/acf-flexible-content/section-cards.twig', $context);
