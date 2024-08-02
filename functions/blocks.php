<?php

// Create custom Gutenberg block category for ACF Blocks
function flyykf_block_category( $categories, $post ) {
    array_unshift( $categories, array(
		'slug'	=> 'ykf-blocks',
		'title' => 'YKF Blocks'
	) );

	return $categories;
}
add_filter( 'block_categories_all', 'flyykf_block_category', 1, 2);


/**
 * Registers custom ACF blocks.
 */
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/../blocks/accordion' );
    register_block_type( __DIR__ . '/../blocks/boxed-content' );
	register_block_type( __DIR__ . '/../blocks/page-hero' );
	register_block_type( __DIR__ . '/../blocks/hero-slider' );
	register_block_type( __DIR__ . '/../blocks/destinations' );
	register_block_type( __DIR__ . '/../blocks/reviews' );
}