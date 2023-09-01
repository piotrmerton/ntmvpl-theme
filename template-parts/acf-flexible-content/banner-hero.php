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

/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);

$context['section']['section_settings_bgColor'] = $section_bg_color;

$features = $field['banner_features'];

/**
 * In Twig we cannot load source of a SVG file via absolute path, so we either build relative path or load source directly in PHP
 */
if($features) {
    foreach($features as &$feature) {
        if($feature['banner_feature_symbol'] && $feature['banner_feature_symbol']['mime_type'] == 'image/svg+xml') {
            
            //$feature['banner_feature_symbol']['source'] = file_get_contents($feature['banner_feature_symbol']['url']);
            $feature['banner_feature_symbol']['url_local'] = explode(site_url(), wp_get_attachment_url($feature['banner_feature_symbol']['id']))[1];
        }
    }
    $context['section']['banner_features'] = $features;
}

//die(print_r($features));

Timber::render('views/content/acf-flexible-content/banner-hero.twig', $context);
