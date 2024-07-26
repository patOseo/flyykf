<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="site-footer bg-darkblue text-white" id="colophon">

	<div class="wrapper py-6" id="wrapper-footer">

		<div class="<?php echo esc_attr( $container ); ?>">

			<div class="row">

				<div class="col-4 col-xl-2 mb-5 mb-xl-0 px-4 pe-md-6 border-end border-darkerblue">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logo/logo-vert.svg" alt="Waterloo International Airport">
				</div><!-- col -->

				<div class="col-8 col-md-4 col-xl mb-5 mb-md-0 px-4 px-xl-6">
					<p class="mb-4"><small class="d-block mb-2">Fly YKF is a division of:</small><strong class="d-block mb-2">Region of Waterloo International Airport (YKF)</strong>
					1-4881 Fountain Street North<br>Breslau, Ontario<br>N0B 1M0
					</p>

					<?php if(get_field('social_links', 'option')): ?>
						<div class="social-links">
							<?php while(have_rows('social_links', 'option')): the_row(); ?>
								<div class="position-relative social-link d-inline-block rounded-circle me-2 lh-1 text-center"><a class="stretched-link" target="_blank" rel="noopener,noreferrer,nofollow" href="<?php echo esc_url(get_sub_field('link')); ?>"><?php echo get_sub_field('icon'); ?></a></div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="col-12 col-md-4 col-xl px-4 px-xl-6">
					<p class="lh-lg mb-0">Telephone: <a href="tel:519-575-4781">519-575-4781</a><br>Toll-free: <a href="tel:1-866-648-2256">1-866-648-2256</a><br>Deaf or Hard of Hearing (TTY): <a href="tel:519-575-4608">519-575-4608</a><br>Fax: <strong>519-648-3540</strong></p>
				</div>

			</div><!-- .row -->

		</div><!-- .container(-fluid) -->

	</div><!-- #wrapper-footer -->

	<div class="copyright py-4">
		<div class="container">
			<div class="site-info text-center fs-sm">
				© <?php echo date( 'Y' ); ?> Region of Waterloo International Airport. All Rights Reserved.  |  Website by <a href="https://foundery.ca/" target="_blank" rel="noopener noreferrer">Foundery</a>
			</div><!-- .site-info -->
		</div>
	</div>

</footer><!-- .site-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
