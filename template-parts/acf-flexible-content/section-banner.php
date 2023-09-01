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

global $post;

/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);
$section_symbol_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_symbol_color']);
$section_symbol_bgColor = Helpers::addPropertiesToAcfeColorPickedColor($field['section_symbol_bgColor']);

$section_symbol_color = $section_symbol_color ? $section_symbol_color : $section_bg_color;

$context['section']['section_settings_bgColor'] = $section_bg_color;
$context['section']['section_symbol_color'] = $section_symbol_color;
$context['section']['section_symbol_bgColor'] = $section_symbol_bgColor;

Timber::render('views/content/acf-flexible-content/section-banner.twig', $context);
