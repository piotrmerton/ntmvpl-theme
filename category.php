<?php

use Timber\Timber;
use Theme\Terms;

$postType = get_query_var('post_type');
$term = get_queried_object();

$context = Timber::get_context();

$context['post_type'] = get_query_var('post_type');
$context['term'] = $term;
$context['title'] = $term->name . ' - ' . __('archiwum', 'theme');
$context['categories'] = Terms::getTerms('category', null, true);

$content_seo = $term->description ? $term->description : get_post_meta(THEME_BLOG_PAGE_ID, 'content_seo', true);

$context['content_seo'] = apply_filters('the_content', $content_seo);

Timber::render(array('archive-category.twig' ), $context);
