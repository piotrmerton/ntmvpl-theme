<?php

use Timber\Timber;
use Theme\Casestudy;

$id_post = get_queried_object_id();
$post_lead = get_post_meta($id_post, 'post_lead', true);

$industries = Casestudy::getIndustries($id_post);
$services = Casestudy::getServices($id_post);

$context = Timber::get_context();

$context['post'] =  Timber::get_post(false, 'Theme\TimberPost');
$context['post_type'] = get_post_type();
$context['post_header'] = get_post_meta($id_post, 'post_header', true);
$context['post_lead'] = apply_filters( 'the_content', $post_lead );
$context['post_tags'] = array_merge($industries, $services);

Timber::render('single-casestudy.twig', $context);
