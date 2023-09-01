<?php

$post_type = get_post_type();

wp_redirect(get_post_type_archive_link($post_type));
