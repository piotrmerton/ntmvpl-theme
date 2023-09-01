<?php

/**
 * Template Name: Kontakt
 * Description: A custom template for Contact subpage
 *
 */

use Timber\Timber;
use Theme\Employee;

$id_page = get_queried_object_id();

$context = Timber::get_context();


$context['post'] =  Timber::get_post(false, 'Theme\TimberPost');

$employee_groups = array(
    'for_partners' => Employee::getEmployees('partners', true),
    'new_partners' => Employee::getEmployees('new-partners', true),
);
$context['employee_groups'] = $employee_groups;

Timber::render('pages/contact.twig', $context);
