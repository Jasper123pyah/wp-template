<?php

get_header();

if (get_field('page_title')) {
    $page_title = get_field('page_title');
} else {
    $page_title = get_the_title();
}


if (have_rows('header')) {
	while (have_rows('header')) {
		the_row();

		$block_type = get_row_layout();
		get_template_part('blocks/' . $block_type . '/index');
	}
}

if (have_rows('content')) {
	while (have_rows('content')) {
		the_row();

		$block_type = get_row_layout();
		get_template_part('blocks/' . $block_type . '/index');
	}
}

get_footer();
