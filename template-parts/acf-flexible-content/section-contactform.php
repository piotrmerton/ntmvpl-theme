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
use Theme\Employee;
use Theme\Helpers;

$id_employee = $field['section_employee_id'];

if($id_employee) {
    $employee = Employee::getEmployee($id_employee, true);

    $context['section']['section_has_employee'] = true;
    $context['section']['section_employee'] = $employee;
}


/**
 * As of ACF Extended 0.8.9.3 there is no hook to update color picker on server side, so we need to manually update each field separately.
 */
$section_bg_color = Helpers::addPropertiesToAcfeColorPickedColor($field['section_settings_bgColor']);
$context['section']['section_settings_bgColor'] = $section_bg_color;


Timber::render('views/content/acf-flexible-content/section-contactform.twig', $context);
