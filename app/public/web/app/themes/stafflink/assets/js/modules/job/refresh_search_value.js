(function ($) {
	'use strict';


	const SELECTORS = {
		BUTTON_SELECTOR : '#btn-reset-job',
		KEYWORD_INPUT_SELECTOR : 'input[name="keyword"]',
		FILTER_SELECT_SELECTOR : '.select2-custom',
		PJAX_CONTAINER_SELECTOR : '#job-list-pjax'
	};


	$(document).on('click', SELECTORS.BUTTON_SELECTOR, function (event) {
		event.preventDefault();

		const $button = $(this);
		const $form = $button.closest('form');

		$(SELECTORS.KEYWORD_INPUT_SELECTOR).val('');

		if (typeof $.fn.select2 === 'function') {
			$(SELECTORS.FILTER_SELECT_SELECTOR).val(null).trigger('change');
		}

		if ($(SELECTORS.PJAX_CONTAINER_SELECTOR).length > 0) {
			$.pjax({
				url: $form.attr('action') || window.location.pathname,
				container: SELECTORS.PJAX_CONTAINER_SELECTOR,
				push: true,
				replace: false,
				scrollTo: false,
				timeout: 5000
			});
		}
	});

})(jQuery);