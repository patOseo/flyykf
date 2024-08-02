<?php
/**
* Hero Slider Block
*
* @package flyykf
*/

$class_name = 'block-img-slider-container d-flex flex-column h-100 position-relative overflow-hidden';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

?>

<div class="<?php echo esc_attr($class_name); ?>">
    
    <?php if(have_rows('background_images')): ?>
        <div id="imgSliderCarousel" class="carousel slide carousel-fade position-absolute w-100 h-100" data-bs-touch="false" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner h-100">
                <?php while(have_rows('background_images')): the_row(); ?>
                <div class="carousel-item h-100<?php if(get_row_index() == 1) { echo ' active'; } ?>">
                    <img src="<?php echo get_sub_field('image', 'full'); ?>" class="d-block w-100 h-100" alt="...">
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="content-container px-3 position-relative py-12 overflow-hidden">
        <InnerBlocks />
    </div>
</div>