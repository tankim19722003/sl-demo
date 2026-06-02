<?php
/**
 * @param $query
 *
 * @return void
 */
function stafflink_filter_job_query( $query )
: void{
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'job' ) ) {
		$query->set( 'posts_per_page', 1 );

		if ( ! empty( $_GET['keyword'] ) ) {
			$query->set( 's', sanitize_text_field( $_GET['keyword'] ) );
		}

		$tax_query = ['relation' => 'AND'];

		if ( ! empty( $_GET['filter_classification'] ) ) {
			$tax_query[] = [
				'taxonomy' => 'job_classification',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['filter_classification'] )
			];
		}

		if ( ! empty( $_GET['filter_job_type'] ) ) {
			$tax_query[] = [
				'taxonomy' => 'job_type',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['filter_job_type'] )
			];
		}

		if ( count( $tax_query ) > 1 ) {
			$query->set( 'tax_query', $tax_query );
		}
	}
}

add_action( 'pre_get_posts', 'stafflink_filter_job_query' );