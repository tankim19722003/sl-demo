<?php
add_action('init', function() {
	register_post_type('job', [
		'labels'      => [
			'name'          => 'Jobs',
			'singular_name' => 'Job',
			'add_new_item'  => 'Add New Job',
			'add_new'       => 'Add New Job',
			'all_items'     => 'All Jobs'
		],
		'public'      => true,
		'has_archive' => true,
		'supports'    => ['title', 'editor'],
		'rewrite'     => ['slug' => 'jobs', 'with_front' => false],
		'menu_icon'   => 'dashicons-portfolio',
	]);

	register_post_type('job_applicant', [
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => 'edit.php?post_type=job',
		'labels'          => [
			'name'          => 'Applicants',
			'singular_name' => 'Applicant',
			'add_new_item'  => 'Add New Applicant',
			'add_new'       => 'Add New Applicant',
			'all_items'     => 'All Applicants'
		],
		'supports'        => ['title'],
		'capability_type' => 'post',
		'map_meta_cap'    => true,
	]);

	$taxonomies = ['job_classification', 'job_type', 'job_location', 'salary_currency', 'nationality'];
	foreach ($taxonomies as $tax) {
		register_taxonomy($tax, 'job', [
			'hierarchical' => true,
			'labels'       => ['name' => ucwords(str_replace('_', ' ', $tax))],
		]);
	}
});