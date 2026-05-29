<?php
if ( function_exists('yoast_breadcrumb') ) {
	echo '<div class="container">';
	yoast_breadcrumb( '<div class="custom-yoast-breadcrumb">', '</div>' );
	echo '</div>';
}
?>