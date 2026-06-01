(function ($) {
	'use strict';

	const SELECTORS = {
		MODAL: '#global-modal',
		MODAL_BODY: '.modal-body',
		FORM: '#resumeDepositForm',
		LOAD_BUTTON: '.btn-load-modal',
		FILE_INPUT: 'input[id^="jobapplicant-resumefile-"]',
		NATIONALITY_SELECT: '#jobapplyform-nationality_id',
		FILE_DISPLAY: '#file-name-display-resumeDepositForm'
	};

	const LABELS = {
		DEFAULT_FILE: 'File...',
		LOADING_HTML: '<div class="text-center p-5"><div class="spinner-border text-danger"></div><p class="mt-2">Loading form...</p></div>'
	};

	const loadModalContent = (url) => {
		const $modalBody = $(SELECTORS.MODAL_BODY);

		$modalBody.html(LABELS.LOADING_HTML);
		$(SELECTORS.MODAL).modal('show');

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'html',
			success: (html) => {
				$modalBody.html(html);
				if (typeof window.reInitPlugins === 'function') {
					window.reInitPlugins($modalBody);
				}
			},
			error: () => {
				$modalBody.html('<div class="alert alert-danger">Could not load the form. Please try again.</div>');
			}
		});
	};

	const updateFileLabel = (input) => {
		const $displaySpan = $(input).siblings('.form-file-path');
		if ($displaySpan.length === 0) {
			return;
		}

		const fileName = input.files.length > 0 ? input.files[0].name : LABELS.DEFAULT_FILE;
		$displaySpan.text(fileName)
			.toggleClass('text-muted', input.files.length === 0)
			.toggleClass('text-dark', input.files.length > 0);
	};

	const resetResumeForm = () => {
		const $form = $(SELECTORS.FORM);
		if (!$form.length) {
			return;
		}

		$form[0].reset();
		$(SELECTORS.NATIONALITY_SELECT).val('').trigger('change');


		$(SELECTORS.FILE_DISPLAY).text(LABELS.DEFAULT_FILE)
			.removeClass('text-dark').addClass('text-muted');

		$form.find('.text-danger').text('');
		$form.find('.has-error, .is-invalid').removeClass('has-error is-invalid');
	};

	const validateForm = ($form) => {
		let isValid = true;

		// 1. Reset sạch sẽ các thông báo lỗi và viền đỏ cũ
		$form.find('.form-error-message').text('');
		$form.find('.is-invalid').removeClass('is-invalid');
		$form.find('.border-danger').removeClass('border-danger');

		// 2. Hàm Helper: Bắn lỗi chính xác vào ngay dưới input
		const showError = ($input, msg) => {
			$input.addClass('is-invalid');

			if ($input.attr('type') === 'file') {
				// Với file: Tìm cái khung bọc ngoài, bôi đỏ khung, rồi điền chữ vào thẻ lỗi ngay dưới khung đó
				$input.closest('.form-file-upload')
					.addClass('border-danger')
					.next('.form-error-message')
					.text(msg);
			} else {
				// Với text/select: Điền chữ vào thẻ lỗi nằm ngay sát bên dưới input
				$input.siblings('.form-error-message').text(msg);
			}

			isValid = false;
		};

		// 3. Kiểm tra các trường Text/Select bắt buộc
		const requiredFields = [
			{ name: 'name', msg: 'Name is required.' },
			{ name: 'nationality_id', msg: 'Nationality is required.' },
			{ name: 'contact_number', msg: 'Contact Number is required.' },
			{ name: 'postal_code', msg: 'Postal Code is required.' }
		];

		requiredFields.forEach(field => {
			const $input = $form.find(`[name="${field.name}"]`);
			if (!$input.val() || !$input.val().trim()) {
				showError($input, field.msg);
			}
		});

		// 4. Kiểm tra riêng Email (Trống & Sai định dạng)
		const $email = $form.find('[name="email_address"]');
		const emailVal = $email.val() ? $email.val().trim() : '';
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if (!emailVal) {
			showError($email, 'Email Address is required.');
		} else if (!emailRegex.test(emailVal)) {
			showError($email, 'Please enter a valid email address.');
		}

		// 5. Kiểm tra file Resume
		const $fileInput = $form.find('[name="resumeFile"]');
		if ($fileInput.length > 0) {
			const files = $fileInput[0].files;

			if (files.length === 0) {
				showError($fileInput, 'Resume File is required.');
			} else if (files[0].size > 5242880) { // 5MB limit
				showError($fileInput, 'File size must be less than 5MB.');
			}
		}

		return isValid;
	};

	const handleFormSubmit = function (e) {
		e.preventDefault();
		const $form = $(this);

		if (!validateForm($form)) {
			return;
		}

		const formData = new FormData(this);
		formData.append('action', 'submit_deposit_resume');

		const $submitBtn = $(this).find('button[type="submit"]');
		const originalBtnText = $submitBtn.text();
		$submitBtn.prop('disabled', true).text('Submitting...');

		$.ajax({
			url: stafflink_ajax.ajax_url,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: (response) => {
				if (response.success) {
					$(SELECTORS.MODAL).modal('hide');
					StafflinkNotifications.showSuccessAlert(response.data.message);
				} else {
					StafflinkNotifications.showErrorAlert(response.data.message);
				}
			},
			error: () => {
				StafflinkNotifications.showErrorAlert('A server error occurred. Please try again.');
			},
			complete: () => {
				$submitBtn.prop('disabled', false).text(originalBtnText);
			}
		});
	};

	const initEvents = () => {
		$(document).on('click', SELECTORS.LOAD_BUTTON, function (e) {
			e.preventDefault();
			loadModalContent($(this).data('url'));
		});

		$(document).on('change', SELECTORS.FILE_INPUT, function () {
			updateFileLabel(this);
		});

		$(document).on('hidden.bs.modal', SELECTORS.MODAL, () => {
			resetResumeForm();
		});

		$(document).on('submit', SELECTORS.FORM, handleFormSubmit);
	};

	$(document).ready(() => {
		initEvents();
	});

})(jQuery);