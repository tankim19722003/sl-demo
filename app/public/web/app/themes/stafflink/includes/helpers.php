<?php

/**
 * @param $post_id
 * @param $taxonomy
 *
 * @return string
 */
function stafflink_get_job_term_name($post_id, $taxonomy): string {
	$terms = get_the_terms($post_id, $taxonomy);
	return ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'N/A';
}

/**
 * @return array
 */
function stafflink_get_nationalities(): array {
	$terms = get_terms(['taxonomy' => 'nationality', 'hide_empty' => false]);
	$nationalities = [];
	
	if (!is_wp_error($terms) && !empty($terms)) {
		foreach ($terms as $term) {
			$nationalities[$term->term_id] = $term->name;
		}
	}
	
	return $nationalities;
}