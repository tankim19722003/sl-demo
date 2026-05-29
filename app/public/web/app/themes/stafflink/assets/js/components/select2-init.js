(function ($) {
	'use strict';

	const CUSTOM_SELECT_SELECTOR = '.select2-custom';
	const FORM_SELECT_SELECTOR = '.form-select';

	window.reInitPlugins = (container = document) => {
		const $container = $(container);

		if (typeof $.fn.select2 !== 'function') {
			return;
		}

		$container.find(CUSTOM_SELECT_SELECTOR).each((_, element) => {
			const $element = $(element);
			if ($element.hasClass('select2-hidden-accessible')) {
				return;
			}

			const placeholderText = $element.find('option:disabled').first().text() || '';
			$element.select2({
				theme: 'bootstrap-5',
				placeholder: placeholderText || undefined,
				width: '100%',
				dropdownParent: $element.closest('.input-group').length ? $element.closest('.input-group') : $element.parent(),
				allowClear: true
			});
		});

		$container.find(FORM_SELECT_SELECTOR).each((_, element) => {
			const $element = $(element);
			if ($element.hasClass('select2-hidden-accessible')) {
				return;
			}

			const $modalParent = $element.closest('.modal');
			$element.select2({
				width: '100%',
				dropdownParent: $modalParent.length ? $modalParent : $('body')
			});
		});
	};

	$(document).ready(() => window.reInitPlugins());
	$(document).on('pjax:complete', () => window.reInitPlugins());

})(jQuery);