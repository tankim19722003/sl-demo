<?php
add_action('wp_ajax_load_deposit_form', 'stafflink_ajax_load_deposit_form');
add_action('wp_ajax_nopriv_load_deposit_form', 'stafflink_ajax_load_deposit_form');

function stafflink_ajax_load_deposit_form()
: void{
	$args = [
		'title'         => 'Deposit Your Resume',
		'formId'        => 'resumeDepositForm',
		'nationalities' => stafflink_get_nationalities()
	];

	ob_start();
	get_template_part('template-parts/deposit-resume-form', null, $args);
	$html = ob_get_clean();

	echo $html;
	wp_die();
}

add_action('wp_ajax_submit_deposit_resume', 'stafflink_handle_resume_deposit');
add_action('wp_ajax_nopriv_submit_deposit_resume', 'stafflink_handle_resume_deposit');

function stafflink_handle_resume_deposit()
: void{
	stafflink_verify_security();

	$data = stafflink_validate_application_data();

	$applicant_id = stafflink_create_applicant_post($data);

	stafflink_save_applicant_meta($applicant_id, $data);

	stafflink_handle_resume_upload($applicant_id);

	wp_send_json_success(['message' => 'Application submitted successfully!']);
}

function stafflink_verify_security()
: void{
	if (!isset($_POST['deposit_resume_nonce']) || !wp_verify_nonce($_POST['deposit_resume_nonce'], 'deposit_resume_action')) {
		wp_send_json_error(['message' => 'Invalid security token.']);
	}
}

function stafflink_validate_application_data(): array {
	$data = [
		'name'           => sanitize_text_field($_POST['name'] ?? ''),
		'email'          => sanitize_email($_POST['email_address'] ?? ''),
		'contact'        => sanitize_text_field($_POST['contact_number'] ?? ''),
		'nationality_id' => intval($_POST['nationality_id'] ?? 0),
		'postal'         => sanitize_text_field($_POST['postal_code'] ?? ''),
		'address'        => sanitize_text_field($_POST['address'] ?? ''),
		'job_id'         => intval($_POST['job_id'] ?? 0),
	];

	if (empty($data['name']) || empty($data['email']) || empty($data['contact']) || empty($data['nationality_id']) || empty($data['postal'])) {
		wp_send_json_error(['message' => 'Please fill in all required fields (Name, Email, Contact, Nationality, Postal Code).']);
	}

	if (empty($_FILES['resumeFile']['name'])) {
		wp_send_json_error(['message' => 'Please attach your resume.']);
	}

	$file_name = $_FILES['resumeFile']['name'];
	$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	$allowed_exts = ['doc', 'docx', 'pdf'];

	if (!in_array($file_ext, $allowed_exts)) {
		wp_send_json_error(['message' => 'Invalid file format. Only DOC, DOCX, and PDF are allowed.']);
	}

	return $data;
}

function stafflink_create_applicant_post($data)
: WP_Error|int{
	$applicant_id = wp_insert_post([
		'post_title'  => $data['name'] . ' - ' . $data['email'],
		'post_type'   => 'job_applicant',
		'post_status' => 'publish',
	]);

	if (is_wp_error($applicant_id)) {
		wp_send_json_error(['message' => 'Failed to save application. Please try again.']);
	}

	return $applicant_id;
}

function stafflink_save_applicant_meta($applicant_id, $data)
: void{
	update_post_meta($applicant_id, '_applicant_name', $data['name']);
	update_post_meta($applicant_id, '_applicant_email', $data['email']);
	update_post_meta($applicant_id, '_applicant_contact', $data['contact']);
	update_post_meta($applicant_id, '_applicant_address', $data['address']);
	update_post_meta($applicant_id, '_applicant_postal', $data['postal']);

	if (!empty($data['job_id'])) {
		update_post_meta($applicant_id, '_job_id', $data['job_id']);
	}
	if (!empty($data['nationality_id'])) {
		update_post_meta($applicant_id, '_nationality_id', $data['nationality_id']);
	}
}

function stafflink_handle_resume_upload($applicant_id)
: void{
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	require_once(ABSPATH . 'wp-admin/includes/media.php');

	$attachment_id = media_handle_upload('resumeFile', $applicant_id);

	if (is_wp_error($attachment_id)) {
		wp_send_json_error(['message' => $attachment_id->get_error_message()]);
	}

	$resume_url = wp_get_attachment_url($attachment_id);
	update_post_meta($applicant_id, '_resume_url', $resume_url);
	update_post_meta($applicant_id, '_resume_attachment_id', $attachment_id);
}