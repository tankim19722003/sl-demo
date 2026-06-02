<?php
get_header();
get_template_part('template-parts/breadcrumb');
?>

	<div class="job-detail-page">
		<div class="container">
			<div class="mt-lg-4 mb-lg-3 d-lg-block d-none">
				<a href="<?php echo esc_url(get_post_type_archive_link('job')); ?>" class="text-brand text-14 d-flex align-items-center">
					<i class="bi bi-chevron-left text-brand fw-medium fs-2"></i>
					<span class="ms-lg-2"><?php esc_html_e("Back to listing",
							"stafflink"); ?></span>
				</a>
			</div>
			<div class="row mt-4 gx-lg-5">
				<div class="col-lg-8 left-content mb-4 mb-lg-5">
					<article>
						<h3 class="fw-semibold text-brand mb-0">
							<?php the_title(); ?>
						</h3>
						<hr class="border-secondary-color">

						<div class="job-body-content">
							<?php the_content(); ?>
						</div>

						<hr class="border-secondary-color my-4">

						<div class="job-summary-grid">
							<div class="row">
								<div class="col-md-6 mb-4">
									<div class="fw-bold mb-1">Job Type</div>
									<div><?php echo stafflink_get_job_term_name(get_the_ID(),
											'job_type'); ?></div>
								</div>

								<div class="col-md-6 mb-4">
									<div class="fw-bold mb-1">Location</div>
									<div><?php echo stafflink_get_job_term_name(get_the_ID(),
											'job_location'); ?></div>
								</div>

								<div class="col-md-6 mb-4">
									<div class="fw-bold mb-1">Working Hours</div>
									<div>
										<?php echo esc_html(get_field('working_hours')); ?>
									</div>
								</div>

								<div class="col-md-6 mb-4">
									<div class="fw-bold mb-1">Classification</div>
									<div><?php echo stafflink_get_job_term_name(get_the_ID(),
											'job_classification'); ?></div>
								</div>

								<div class="col-12">
									<div class="fw-bold mb-1">Salary</div>
									<div>
										From <?php echo stafflink_get_job_term_name(get_the_ID(),
											'salary_currency'); ?><?php echo number_format((float) get_field('min_salary'),
											2); ?>
										to <?php echo stafflink_get_job_term_name(get_the_ID(),
											'salary_currency'); ?><?php echo number_format((float) get_field('max_salary'),
											2); ?>
									</div>
								</div>
							</div>
						</div>
					</article>
					<hr class="border-secondary-color">

					<!-- Social Share Links -->
					<section class="d-flex justify-content-end gap-3 mb-3">
						<a href="#" class="social-item d-flex align-items-center justify-content-center">
							<span class="icon-facebook"></span>
						</a>
						<a href="#" class="social-item d-flex align-items-center justify-content-center">
							<span class="icon-twitter"></span>
						</a>
						<a href="#" class="social-item d-flex align-items-center justify-content-center">
							<span class="icon-linkedin"></span>
						</a>
						<a href="#" class="social-item d-flex align-items-center justify-content-center">
							<span class="icon-printer"></span>
						</a>
						<a href="#" class="social-item d-flex align-items-center justify-content-center">
							<span class="icon-plus"></span>
						</a>
					</section>

					<!-- EA Personnel Information -->
					<section class="px-4 py-3 border-secondary-color background-secondary">
						<p class="text-14">EA Personnel: <?php echo esc_html(get_field('ea_personnel')); ?></p>
						<p class="text-14 mb-0">EA Personnel Reg. No.: <?php echo esc_html(get_field('ea_reg_no')); ?></p>
					</section>
					<hr class="border-secondary-color my-4 d-lg-block d-none">

					<!-- Desktop Policy Notice -->
					<section class="d-none d-lg-block">
						<p class="text-14 text-policy">
							All applications received will be treated with strictest confidence. We
							regret that only short-listed applicants will be notified.
							By submitting your resume or personal data to us in connection with your
							job application, you are deemed to have consented to the collection, use
							and disclosure of your personal data by us and our affiliates, in
							accordance with our Privacy Policy. </p>
						<p class="text-14 text-policy mb-0">
							Please access our website at
							<a class="text-brand">www.stafflink.com.sg</a> for a copy of our
							Privacy Policy. If you wish to withdraw your consent, please email to let
							us know. </p>
					</section>
				</div>

				<div class="col-lg-4 right-sidebar">
					<div class="border-secondary-color p-4" id="apply-form">
						<?php
						// Render the application form template part
						get_template_part('template-parts/deposit-resume-form', NULL, [
							'jobId'         => get_the_ID(),
							'nationalities' => stafflink_get_nationalities(),
						]);
						?>
					</div>

					<hr class="border-secondary-color">

					<!-- Mobile Policy Notice -->
					<section class="d-block d-lg-none mb-5">
						<p class="text-14 text-policy">
							All applications received will be treated with strictest confidence. We
							regret that only short-listed applicants will be notified.
							By submitting your resume or personal data to us in connection with your
							job application, you are deemed to have consented to the collection, use
							and disclosure of your personal data by us and our affiliates, in
							accordance with our Privacy Policy. </p>
						<p class="text-14 text-policy mb-0">
							Please access our website at
							<a class="text-brand">www.stafflink.com.sg</a> for a copy of our
							Privacy Policy. If you wish to withdraw your consent, please email to let
							us know. </p>
					</section>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>