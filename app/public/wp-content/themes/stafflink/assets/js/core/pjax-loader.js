$(document).on('pjax:send', function () {
	$('#pjax-global-loader').css('display', 'flex').fadeIn(100);
});
$(document).on('pjax:complete', function () {
	$('#pjax-global-loader').fadeOut(100);
});