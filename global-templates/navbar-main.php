<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar navbar-light py-3 py-lg-4" aria-labelledby="main-nav-label">

	<p id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</p>


	<div class="container-xl">

		<a class="flex-grow-1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="position-relative main-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logo/logo.svg" width="200" alt="Region of Waterloo International Airport Logo"></a>

		<div class="quicknav text-light">
			<div class="row gx-6">
				<div class="col d-flex flex-column d-none d-lg-block">
					<div class="text-center quicknav-icon position-relative">
						<img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/plane.svg" alt="Flights" width="auto" height="auto">
						<a href="/#flights" class="d-block text-light mt-auto mb-0 fs-xs ls-1 fw-bold text-uppercase stretched-link">Flights</a>
						<div class="quicknav-dropdown bg-darkblue p-4 text-start text-white position-absolute w-auto">
							<ul class="list-group">
								<li class="menu-item nav-item"><a href="/fly-south/" class="mb-0 fs-xs ls-1 fw-bold text-uppercase text-white">Fly South</a></li>
								<li class="menu-item nav-item"><a href="/fly-across-canada/" class="mb-0 fs-xs ls-1 fw-bold text-uppercase text-white">Fly Across Canada</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col d-flex flex-column d-none d-lg-block">
					<div class="text-center quicknav-icon position-relative">
						<img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/p.svg" alt="Parking" width="auto" height="auto">
						<a href="/parking/" class="d-block text-light mt-auto mb-0 fs-xs ls-1 fw-bold text-uppercase stretched-link">Parking</a>
					</div>
				</div>
				<div class="col d-flex flex-column d-none d-lg-block">
					<div class="text-center quicknav-icon position-relative">
						<img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/dining.svg" alt="Dining" width="auto" height="auto">
						<a href="/dining-stockyards/" class="d-block text-light mt-auto mb-0 fs-xs ls-1 fw-bold text-uppercase stretched-link">Dining</a>
					</div>
				</div>
				<div class="col d-flex flex-column d-none d-lg-block">
					<div class="text-center quicknav-icon position-relative">
						<img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/bus.svg" alt="Transportation" width="auto" height="auto">
						<a href="/ground-transportation/" class="d-block text-light mt-auto mb-0 fs-xs ls-1 fw-bold text-uppercase stretched-link">Transit</a>
					</div>
				</div>
				<div class="col d-flex flex-column">
					<div class="text-center quicknav-icon position-relative">
						<img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/menu.svg" alt="Info" width="auto" height="auto">
						<p
						type="button"
						data-bs-toggle="offcanvas"
						data-bs-target="#navbarNavOffcanvas"
						aria-controls="navbarNavOffcanvas"
						aria-expanded="false"
						aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>" 
						class="mt-auto mb-0 fs-xs ls-1 fw-bold text-uppercase stretched-link">Menu</p>
					</div>
				</div>
			</div>
		</div>

		<div class="offcanvas offcanvas-end text-center bg-white shadow pt-5" tabindex="-1" id="navbarNavOffcanvas">

			<div class="offcanvas-header position-absolute justify-content-center text-center">
				<button
					class="btn btn-primary rounded-0 text-white px-2 py-1"
					type="button"
					data-bs-dismiss="offcanvas"
					aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>"
				>
				<svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#FFFFFF" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
			</button>
			</div><!-- .offcancas-header -->

			<div class="text-center"><a class="flex-grow-1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logo/logo-dark.svg" width="260" alt="Region of Waterloo International Airport Logo"></a></div>
			
			<div class="px-3">
				<hr class="mb-5">
				<p class="h4">Main Menu</p>
			</div>
			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'offcanvas-body',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3 fs-6 fw-light text-dark',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
			<?php if(get_field('social_links', 'option')): ?>
				<div class="social-links pb-3 pb-xl-5">
					<?php while(have_rows('social_links', 'option')): the_row(); ?>
						<div class="position-relative social-link d-inline-block rounded-circle me-2 lh-1 text-center"><a class="stretched-link" target="_blank" rel="noopener,noreferrer,nofollow" href="<?php echo esc_url(get_sub_field('link')); ?>"><?php echo get_sub_field('icon'); ?></a></div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div><!-- .offcanvas -->

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->
