<?php

use Timber\Timber;
use Timber\PostQuery;

$postType = get_query_var('post_type');
$term = get_queried_object();

$context = Timber::get_context();

$context['post_type'] = get_query_var('post_type');

/**
 * Custom context for CPT service page via ACF Options
 * https://www.advancedcustomfields.com/resources/options-page/
 **/
$context['content'] = get_field('content_flexible', 'cpt_service_archive_content');

Timber::render('archive-service.twig', $context);
