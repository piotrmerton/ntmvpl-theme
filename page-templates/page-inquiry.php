<?php

/**
 * Template Name: Bezpłatna wycena
 * Description: A custom template for Inquiry dedicated subpage
 *
 */

use Timber\Timber;

$id_page = get_queried_object_id();

$context = Timber::get_context();

$context['post'] =  Timber::get_post(false, 'Theme\TimberPost');

Timber::render('pages/inquiry.twig', $context);
