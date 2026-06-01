<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

	<div class="job-seeker">
		<section class="mt-lg-1">
			<div class="container">
				<h1 class="mb-0 fw-bold text-primary-color page-title-section">Job Opportunities</h1>
			</div>
		</section>

		<section class="py-4">
			<div class="container">
				<?php get_template_part('template-parts/job-filter'); ?>
			</div>
		</section>

		<section class="job-list-section cs-bg-light">
			<div class="container">
				<div class='job-items-wrapper position-relative'>
					<?php
					if (have_posts()) :
						while (have_posts()) : the_post();
							get_template_part('template-parts/job-card');
						endwhile;
					else :
						echo '<p class="mt-4">No jobs found matching your criteria.</p>';
					endif;
					?>
				</div>

				<nav class="pagination-wrapper d-flex justify-content-center mt-4">
					<ul class="pagination custom-pagination align-items-center gap-3 mb-0">
						<?php
						$pagination = paginate_links([
							'prev_text' => '<i class="bi bi-chevron-left"></i>',
							'next_text' => '<i class="bi bi-chevron-right"></i>',
							'type'      => 'array',
						]);

						if ($pagination) {
							foreach ($pagination as $page_link) {
								$class = str_contains($page_link, 'current') ? 'page-item active' : 'page-item';
								$page_link = str_replace('page-numbers', 'page-link d-flex align-items-center justify-content-center text-14 border-0 color-brand-hover', $page_link);
								$page_link = str_replace('prev', 'prev-btn background-primary text-white rounded-circle', $page_link);
								$page_link = str_replace('next', 'next-btn background-primary text-white rounded-circle', $page_link);
								echo "<li class='$class'>$page_link</li>";
							}
						}
						?>
					</ul>
				</nav>
			</div>
		</section>
	</div>

<?php get_footer(); ?>