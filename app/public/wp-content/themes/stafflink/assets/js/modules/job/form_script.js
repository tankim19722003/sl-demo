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
	};

	$(document).ready(() => {
		initEvents();
	});

})(jQuery);