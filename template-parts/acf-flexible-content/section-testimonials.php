<?php

/*
 * ACF Flexible Content Layout custom "controller".
 *
 * @array   $loop   Twig loop context
 * @array   $field  Flexible content field values
 *
 * @see theme_render_flexible_content() @ inc/setup/timber-setup.php
 */

use Timber\Timber;
use Theme\Testimonial;
use Theme\Helpers;

$layout = $field['section_settings_layout'];
$id_testimonial = $field['section_related_cpt_testimonial_id'];

if($layout == 'list') {
    $context['section']['has_slider'] = true;
    $context['section']['testimonials'] = Testimonial::getPosts();
} elseif ($layout == 'single' && is_int($id_testimonial)) {
    $context['section']['has_slider'] = false;
    $context['section']['testimonials'] = Testimonial::getPosts($id_testimonial);
}

/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);
$context['section']['section_settings_bgColor'] = $section_bg_color;

Timber::render('views/content/acf-flexible-content/section-testimonials.twig', $context);
