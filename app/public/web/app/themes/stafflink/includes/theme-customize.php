<?php
function stafflink_customize_yoast_breadcrumb( $links ): array {
	if ( is_post_type_archive( 'job' ) ) {
		$last_index = count( $links ) - 1;
		if ( isset( $links[$last_index] ) ) {
			$links[$last_index]['text'] = 'Jobseeker';
		}
	}
	elseif ( is_singular( 'job' ) ) {
		$archive_index = count( $links ) - 2;
		$current_index = count( $links ) - 1;

		if ( isset( $links[$archive_index] ) ) {
			$links[$archive_index]['text'] = 'Jobseeker';
		}

		if ( isset( $links[$current_index] ) ) {
			$links[$current_index]['text'] = 'Job Detail';
		}
	}

	return $links;
}

add_filter( 'wpseo_breadcrumb_links', 'stafflink_customize_yoast_breadcrumb' );