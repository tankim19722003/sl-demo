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
						<?php get_template_part('template-parts/pagination'); ?>
					</ul>
				</nav>
			</div>
		</section>
	</div>

<?php get_footer(); ?>