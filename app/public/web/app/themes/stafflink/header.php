<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header bg-white sticky-top">
	<nav class="navbar navbar-expand-lg navbar-light header-navbar">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/uploads/common/logo.png" alt="StaffLink Logo" class="align-baseline">
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
				<span class="icon-menu"></span>
			</button>

			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
				<div class="offcanvas-body">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="#" class="nav-link">HOME</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">ABOUT US</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link active-primary">JOBS</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">EMPLOYERS</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">NEWSROOM</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">CONTACT US</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>