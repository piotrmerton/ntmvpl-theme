<?php

use Timber\Timber;
use Theme\Terms;

$context = Timber::context();
$context['post_type'] = 'post';

$context['categories'] = Terms::getTerms('category', null, true);
$context['content_seo'] = apply_filters('the_content', get_post_meta(THEME_BLOG_PAGE_ID, 'content_seo', true));

/**
 * Pagination with custom parameters
 * https://wordpress.stackexchange.com/a/371067
 */
$context['pagination'] = Timber::get_pagination(3);

/**
 * index.php is the WordPress' default "page_for_posts" (Settings -> Reading options),
 * so let's render it with blog template
 *
 * For Homepage (show_on_front) we are using static page defined in Settings -> Reading options.
 */

Timber::render('blog.twig', $context);
