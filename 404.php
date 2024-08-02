<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$bg = get_field('default_bg', 'option')['url'];
$gradient = 'rgb(3 106 180 / 98%) 0%, rgb(3 106 180 / 60%) 90%';
?>

<div class="wrapper pt-0" id="error-404-wrapper">

	<div class="block-hero text-center">
	    <div class="hero-container bg-darkblue text-white text-shadow py-12 position-relative shape-divider" style="background:linear-gradient(<?php echo $gradient; ?>), url('<?php echo $bg; ?>') no-repeat center / cover fixed;">
	        <div class="acf-block-padding py-6">
				<p class="hero-title mb-0 fs-1 ls-lg fw-bold text-uppercase text-yellow">404</p>
				<h1 class="page-title hero-heading display-1 mb-4 lh-1"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'understrap' ); ?></h1>
	        </div>
	    </div>
	</div>


	<div id="content" tabindex="-1">

		<main class="site-main container" id="main">

			<section class="error-404 not-found">

				<div class="page-content fs-5 py-6 text-center">

					<div class="row justify-content-center">
						<div class="col-lg-7">
							<p class="mb-5"><?php esc_html_e( 'It looks like nothing was found at this location. The page may have been deleted or is no longer available.', 'understrap' ); ?></p>
							<a class="btn btn-amber px-5 rounded-0 text-white fw-bold text-uppercase ls-1" href="/">Back to Homepage</a>
						</div>
					</div>

				</div><!-- .page-content -->

			</section><!-- .error-404 -->

		</main>

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
