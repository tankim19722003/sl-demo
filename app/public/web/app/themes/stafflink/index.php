<?php
get_header(); ?>

	<main>
		<?php get_template_part('template-parts/banner'); ?>

		<?php get_template_part('template-parts/breadcrumb'); ?>

		<div class="container">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
					the_content();
				endwhile;
			else :
				echo '<p>' . esc_html__('Sorry, no content matched your criteria.',
						'stafflink') . '</p>';
			endif;
			?>
		</div>
	</main>

<?php get_footer(); ?>