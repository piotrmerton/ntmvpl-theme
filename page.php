<?php

use Timber\Timber;

$id_page = get_queried_object_id();

$context = Timber::get_context();

/**
 * If we are extending Timber Post with Custom Class, we need to inititate it properly
 *
 * see:
 *
 * TimberPost @ inc\classes\TimberPost.php
 * vendor\timber\timber\lib\PostGetter.php
 *
 * Docs:
 *
 * https://timber.github.io/docs/guides/extending-timber/#an-example-that-extends-timberpost
 * https://stackoverflow.com/a/54910445
 *
 */
$context['post'] =  Timber::get_post(false, 'Theme\TimberPost');
$context['is_frontpage'] = get_option('page_on_front') == $id_page ? true : false;

Timber::render('page.twig', $context);
