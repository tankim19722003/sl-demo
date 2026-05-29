<?php
function stafflink_enqueue_assets()
: void{
	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/assets/css/vendors/bootstrap/css/bootstrap.min.css',
		[],
		'5.3.8',
		'all'
	);

	wp_enqueue_style(
		'bootstrap-icons',
		get_template_directory_uri() . '/assets/css/vendors/bootstrap/icon/bootstrap-icons.css',
		[],
		'1.13.1',
		'all'
	);

	wp_enqueue_style(
		'stafflink-main-style',
		get_template_directory_uri() . '/assets/css/main.css',
		['bootstrap', 'bootstrap-icons'],
		'1.0',
		'all'
	);

	wp_enqueue_script(
		'bootstrap-js',
		get_template_directory_uri() . '/assets/css/vendors/bootstrap/js/bootstrap.min.js',
		[],
		'5.3.8',
		true
	);
}

add_action('wp_enqueue_scripts', 'stafflink_enqueue_assets');

