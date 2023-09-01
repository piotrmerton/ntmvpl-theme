<?php

use Timber\Timber;

$id_post = get_queried_object_id();

$context = Timber::get_context();

$context['post'] =  Timber::get_post(false, 'Theme\TimberPost');
$context['post_type'] = get_post_type();

Timber::render('single.twig', $context);
