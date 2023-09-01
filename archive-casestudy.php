<?php

use Timber\Timber;
use Timber\PostQuery;
use Theme\Casestudy;

$postType = get_query_var('post_type');
$term = get_queried_object();

$context = Timber::get_context();

$context['post_type'] = get_query_var('post_type');
$context['term'] = $term;
$context['title'] = $term->name . ' - ' . __('archiwum', 'theme');

$context['taxonomies'] = Casestudy::getTaxonomies(true);
$context['url_params'] = $_GET;

$context['posts'] = Timber::get_posts(false, 'Theme\TimberPost');

/**
 * Pagination with custom parameters
 * https://wordpress.stackexchange.com/a/371067
 */
$context['pagination'] = Timber::get_pagination(3);

/**
 * Custom text for CPT archive page via ACF Options
 * https://www.advancedcustomfields.com/resources/options-page/
 **/
$context['content_seo'] = get_field('content_seo', 'seo');

/**
 *
 * On archive pages, we can filter posts by quering taxonomies directly via URL (both approaches work):
 *
 *
 * domain/custom-post-type-slug/?custom-taxonomy=term
 * domain/custom-post-type-slug/?custom-taxonomy=term1,term2
 *
 * domain/custom-taxonomy-slug/term/
 * domain/custom-taxonomy-slug/term,term2/
 *
 * Only first approach works for multiple taxonomies. Even premium plugins like FacetWP doesn't have friendly urls for filters.
 *
 */



Timber::render('archive-casestudy.twig', $context);
