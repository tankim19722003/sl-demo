<?php
$banner = get_field('page_banner');
if (!empty($banner)): ?>
	<img src="<?php echo esc_url($banner['url']); ?>" alt="Banner" class="banner-image">
<?php endif; ?>