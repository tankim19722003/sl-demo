<?php
function stafflink_enqueue_assets()
: void{
	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/assets/vendors/bootstrap/css/bootstrap.min.css',
		[],
		'5.3.8',
		'all'
	);

	wp_enqueue_style(
		'bootstrap-icons',
		get_template_directory_uri() . '/assets/vendors/bootstrap/icon/bootstrap-icons.css',
		[],
		'1.13.1',
		'all'
	);

	wp_enqueue_style(
		'select2',
		get_template_directory_uri() . '/assets/vendors/select2/css/select2.min.css',
		[],
		'4.0.13',
		'all'
	);

	wp_enqueue_style(
		'select2-bootstrap-5-theme',
		get_template_directory_uri() . '/assets/vendors/select2/css/select2-bootstrap-5-theme.min.css',
		['select2', 'bootstrap'],
		'1.3.0',
		'all'
	);

	wp_enqueue_style(
		'sweetalert2',
		get_template_directory_uri() . '/assets/vendors/sweetalert2/css/sweetalert2.css',
		[],
		'11.26.24',
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
		get_template_directory_uri() . '/assets/vendors/bootstrap/js/bootstrap.min.js',
		[],
		'5.3.8',
		true
	);

	wp_enqueue_script(
		'select2-js',
		get_template_directory_uri() . '/assets/vendors/select2/js/select2.min.js',
		['jquery'],
		'4.0.13',
		true
	);

	wp_enqueue_script(
		'stafflink-select2-init',
		get_template_directory_uri() . '/assets/js/components/select2-init.js',
		['jquery', 'select2-js'],
		'1.0',
		true
	);

	wp_enqueue_script(
		'sweetalert2-js',
		get_template_directory_uri() . '/assets/vendors/sweetalert2/js/sweetalert2.all.min.js',
		[],
		'11.26.24',
		true
	);

	wp_enqueue_script(
		'stafflink-notifications',
		get_template_directory_uri() . '/assets/js/core/notifications.js',
		['sweetalert2-js'],
		'1.0',
		true
	);

	wp_enqueue_script(
		'stafflink-job-form-script',
		get_template_directory_uri() . '/assets/js/modules/job/form_script.js',
		['jquery', 'stafflink-notifications'],
		'1.0',
		true
	);

	wp_localize_script(
		'stafflink-job-form-script',
		'stafflink_ajax',
		[
			'ajax_url' => admin_url('admin-ajax.php')
		]
	);

}

add_action('wp_enqueue_scripts', 'stafflink_enqueue_assets');
