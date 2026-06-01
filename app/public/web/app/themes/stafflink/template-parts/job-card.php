<div class="job-item gap-3 py-4 d-flex align-items-start align-items-lg-center position-relative">
	<div class="job-date d-flex align-items-center">
		<div class="me-3 icon-calendar"></div>
		<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="text-14 text-secondary-dark-color">
			<?php echo get_the_date('d M Y'); ?>
		</time>
	</div>
	<div class="job-info flex-grow-1">
		<h2 class="mb-0">
			<a href="<?php the_permalink(); ?>" class="color-brand-hover job-title text-16 fw-medium d-block">
				<?php the_title(); ?>
			</a>
		</h2>
	</div>
	<div class="job-location d-flex align-items-center">
		<div class="me-2 icon-location"></div>
		<span class="text-14 text-secondary-dark-color">
            <?php
            $locations = wp_get_post_terms(get_the_ID(), 'job_location', ['fields' => 'names']);
            echo !empty($locations) ? esc_html($locations[0]) : 'N/A';
            ?>
        </span>
	</div>
</div>