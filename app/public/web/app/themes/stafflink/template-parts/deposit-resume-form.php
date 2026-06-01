<?php
$title = $args['title'] ?? 'Apply This Job';
$jobId = $args['jobId'] ?? null;
$formId = $args['formId'] ?? 'resumeDepositForm';
$nationalities = $args['nationalities'] ?? [];
?>

<div id="form-body">
    <div class="d-flex align-items-center mb-3">
       <div class="me-3">
          <span class="icon-send"></span>
       </div>
       <h5 class="fw-bold form-title"><?php echo esc_html($title); ?></h5>
    </div>

    <form id="<?php echo esc_attr($formId); ?>" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit_deposit_resume">
        <?php wp_nonce_field('deposit_resume_action', 'deposit_resume_nonce'); ?>

        <?php if ($jobId): ?>
            <input type="hidden" name="job_id" value="<?php echo esc_attr($jobId); ?>">
        <?php endif; ?>

        <div class="mb-2 required">
            <div class="d-flex justify-content-between">
                <label class="form-label form-form-label text-14" for="apply-name">Name</label>
                <span class="form-required-note">
                    <span class="text-danger">*</span> is required
                </span>
            </div>
            <input type="text" id="apply-name" name="name" class="form-control form-input text-14 border-secondary-color">
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <div class="mb-2 d-flex flex-column nation-select required">
            <label class="form-label form-form-label text-14" for="apply-nationality">Nationality</label>
            <select id="apply-nationality" name="nationality_id" class="form-select color-text-placeholder">
                <option value="">Select nationality</option>
                <?php foreach ($nationalities as $key => $nation): ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($nation); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <div class="mb-2 required">
            <label class="form-label form-form-label text-14" for="apply-contact">Contact Number</label>
            <input type="text" id="apply-contact" name="contact_number" class="form-control form-input text-14 border-secondary-color">
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <div class="mb-2 required">
            <label class="form-label form-form-label text-14" for="apply-email">Email Address</label>
            <input type="email" id="apply-email" name="email_address" class="form-control form-input text-14 border-secondary-color">
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <div class="mb-2">
            <label class="form-label form-form-label text-14" for="apply-address">Address</label>
            <input type="text" id="apply-address" name="address" class="form-control form-input text-14 border-secondary-color">
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <div class="mb-2 required">
            <label class="form-label form-form-label text-14" for="apply-postal">Postal Code</label>
            <input type="text" id="apply-postal" name="postal_code" class="form-control form-input text-14 border-secondary-color">
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
        </div>

        <hr class="my-3 form-divider">

        <div class="mb-2 form-group required">
            <label class="form-label form-form-label text-14">Resume File</label>
            <div class="form-file-upload border rounded d-flex align-items-center">
                <span class="form-file-path flex-grow-1 text-muted px-3" id="file-name-display-<?php echo esc_attr($formId); ?>">File...</span>
                <label for="jobapplicant-resumefile-<?php echo esc_attr($formId); ?>" class="form-btn-browse py-2 px-3 fw-medium mb-0" style="cursor:pointer;">Browse</label>
                <input type="file" id="jobapplicant-resumefile-<?php echo esc_attr($formId); ?>" name="resumeFile" class="d-none" accept=".doc,.docx,.pdf">
            </div>
            <div class="text-danger text-14 mt-1 d-block form-error-message"></div>
	        <span class="form-file-hint text-muted mt-2 d-block text-12">
                MS Word document or PDF preferred, max file size 5MB.
            </span>
        </div>

        <button type="submit" class="btn-stafflink btn-outline-brand w-100 m-0">
           Submit <i class="bi bi-arrow-right form-submit-icon text-16 ms-3"></i>
        </button>
    </form>
</div>