<?php

use Timber\Timber;
use Timber\PostQuery;

$postType = get_query_var('post_type');
$term = get_queried_object();

$context = Timber::get_context();

$context['post_type'] = get_query_var('post_type');

Timber::render('pages/career.twig', $context);
