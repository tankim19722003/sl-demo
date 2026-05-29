(function (window) {
	'use strict';

	const DEFAULT_TITLE = 'Success!';
	const DEFAULT_TYPE = 'success';

	const DEFAULT_ERROR_TITLE = 'Error!';
	const DEFAULT_ERROR_TYPE = 'error';

	const DEFAULT_CONFIRM_BUTTON_COLOR = '#a2171c';
	const DEFAULT_TIMER = 3000;

	const canUseSweetAlert = () => typeof window.Swal === 'function';

	const showSuccessAlert = (message, options = {}) => {
		if (!canUseSweetAlert()) {
			return;
		}

		const {
			title = DEFAULT_TITLE,
			icon = DEFAULT_TYPE,
			confirmButtonColor = DEFAULT_CONFIRM_BUTTON_COLOR,
			timer = DEFAULT_TIMER,
			timerProgressBar = true
		} = options;

		window.Swal.fire({
			title,
			text: message,
			icon,
			confirmButtonColor,
			timer,
			timerProgressBar
		});
	};

	const showErrorAlert = (message, options = {}) => {
		if (!canUseSweetAlert()) {
			return;
		}

		const {
			title = DEFAULT_ERROR_TITLE,
			icon = DEFAULT_ERROR_TYPE,
			confirmButtonColor = DEFAULT_CONFIRM_BUTTON_COLOR,
		} = options;

		window.Swal.fire({
			title,
			text: message,
			icon,
			confirmButtonColor
		});
	};

	window.StafflinkNotifications = Object.freeze({
		showSuccessAlert,
		showErrorAlert
	});

})(window);
