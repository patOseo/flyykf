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

				<div class="col-4 col-md-2 mb-5 mb-md-0 px-4 pe-md-6 border-end border-darkerblue">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ykf-logo-vert.png" alt="Waterloo International Airport">
				</div><!-- col -->

				<div class="col-8 col-md mb-5 mb-md-0 px-4 px-md-6">
					<p class="mb-0"><strong class="d-block mb-3">Region of Waterloo International Airport (YKF)</strong>
					1-4881 Fountain Street North<br>Breslau, Ontario<br>N0B 1M0
					</p>
				</div>

				<div class="col-12 col-md px-4 px-md-6">
					<p class="lh-lg mb-0">Telephone: <a href="tel:519-575-4781">519-575-4781</a><br>Toll-free: <a href="tel:1-866-648-2256">1-866-648-2256</a><br>Deaf or Hard of Hearing (TTY): <a href="tel:519-575-4608">519-575-4608</a><br>Fax: <strong>519-648-3540</strong></p>
				</div>

			</div><!-- .row -->

		</div><!-- .container(-fluid) -->

	</div><!-- #wrapper-footer -->

	<div class="copyright py-4">
		<div class="container">
			<div class="site-info text-center">
				© <?php echo date( 'Y' ); ?> Region of Waterloo International Airport. All Rights Reserved.
			</div><!-- .site-info -->
		</div>
	</div>

</footer><!-- .site-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

