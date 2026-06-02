<?php
global $wp_query;

$current_page = max(1, get_query_var('paged'));
$total_pages  = $wp_query->max_num_pages;

$pagination = paginate_links([
	'prev_text' => '<i class="bi bi-chevron-left"></i>',
	'next_text' => '<i class="bi bi-chevron-right"></i>',
	'type'      => 'array',
]);

if ($total_pages > 1){

	if ($current_page == 1){
		$disabled_prev = '<span class="page-link d-flex align-items-center justify-content-center text-14 border-0 color-brand-hover prev-btn background-primary text-white rounded-circle disabled" style="opacity: 0.5; cursor: not-allowed;"><i class="bi bi-chevron-left"></i></span>';
		echo "<li class='page-item disabled'>$disabled_prev</li>";
	}

	if ($pagination){
		foreach ($pagination as $page_link){
			$class     = str_contains($page_link,
				'current') ? 'page-item active-primary ' : 'page-item';
			$page_link = str_replace('page-numbers',
				'page-link d-flex align-items-center justify-content-center text-14 border-0 color-brand-hover',
				$page_link);
			$page_link = str_replace('prev',
				'prev-btn background-primary text-white rounded-circle', $page_link);
			$page_link = str_replace('next',
				'next-btn background-primary text-white rounded-circle', $page_link);
			echo "<li class='$class'>$page_link</li>";
		}
	}

	if ($current_page == $total_pages){
		$disabled_next = '<span class="page-link d-flex align-items-center justify-content-center text-14 border-0 color-brand-hover next-btn background-primary text-white rounded-circle disabled" style="opacity: 0.5; cursor: not-allowed;"><i class="bi bi-chevron-right"></i></span>';
		echo "<li class='page-item disabled'>$disabled_next</li>";
	}
}
?>