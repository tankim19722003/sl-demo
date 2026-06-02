<form class="job-search-wrapper d-flex align-items-center flex-wrap gap-3" method="GET" action="<?php echo esc_url(get_post_type_archive_link('job')); ?>">
	<div class="input-group search-group item-input item-full-mobile">
		<span class="input-group-text"><i class="bi bi-search text-brand"></i></span>
		<input type="text" name="keyword" class="form-control text-14" placeholder="Search Job" value="<?php echo isset($_GET['keyword']) ? esc_attr($_GET['keyword']) : ''; ?>">
	</div>

	<div class="input-group search-group item-input item-full-mobile">
		<div class="input-group-text border-0 "><span class="icon-location"></span></div>
		<select name="filter_classification" class="form-control select2-custom" data-placeholder="Classification">
			<option value="">Classification</option>
			<?php foreach (get_terms(['taxonomy' => 'job_classification', 'hide_empty' => FALSE]) as $term): ?>
				<option value="<?php echo esc_attr($term->slug); ?>" <?php selected($_GET['filter_classification'] ?? '',
					$term->slug); ?>><?php echo esc_html($term->name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="input-group search-group item-input item-flex-mobile">
		<span class="input-group-text border-0 bg-transparent"><i class="bi bi-briefcase text-brand"></i></span>
		<select name="filter_job_type" class="form-control select2-custom" data-placeholder="Job Type">
			<option value="">Job Category</option>
			<?php foreach (get_terms(['taxonomy' => 'job_type', 'hide_empty' => FALSE]) as $term): ?>
				<option value="<?php echo esc_attr($term->slug); ?>" <?php selected($_GET['filter_job_type'] ?? '',
					$term->slug); ?>><?php echo esc_html($term->name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="search-actions d-flex gap-2">
		<button type="button" id="btn-reset-job" class="btn btn-secondary btn-circle shadow-none d-flex align-items-center justify-content-center" onclick="window.location.href='<?php echo esc_url(get_post_type_archive_link('job')); ?>'">
			<i class="bi bi-arrow-clockwise text-white"></i>
		</button>
		<button class="btn btn-brand btn-circle shadow-none background-primary" type="submit">
			<i class="bi bi-search text-white"></i></button>
	</div>

	<div class="search-deposit">
		<button type="button" class="w-100 btn-stafflink btn-outline-brand btn-load-modal" data-url="<?php echo esc_url(admin_url('admin-ajax.php?action=load_deposit_form')); ?>">Deposit Resume</button>
	</div>
</form>