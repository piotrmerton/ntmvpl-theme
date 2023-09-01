<?php

/*
 * ACF Flexible Content Layout custom "controller".
 *
 * @array   $loop   Twig loop context
 * @array   $field  Flexible content field values
 *
 * @see theme_render_flexible_content() @ inc/setup/timber-setup.php
 */

use Timber\Timber;

$text_block = $field['section_content']['text_block'];
$text_block_2 = $field['section_content']['text_block_2'];

$context['section']['section_content']['text_block'] = apply_filters( 'the_content', $text_block );
$context['section']['section_content']['text_block_2'] = apply_filters( 'the_content', $text_block_2 );

Timber::render('views/content/acf-flexible-content/section-text.twig', $context);
