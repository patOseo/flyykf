<?php
/**
* Hero Slider Block
*
* @package flyykf
*/

$class_name = 'block-hero-slider pt-5';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

?>

<style>
    #main-nav {
        background: #036ab4 !important;
    }
</style>

<div class="<?php echo esc_attr($class_name); ?>">
    <?php if(have_rows('slides')): ?>
        <div class="swiper slider-container no-swiping w-100 h-100 pt-5" id="heroSlider">
            <div class="swiper-wrapper">
                <?php while(have_rows('slides')): the_row(); ?>
                    <div class="swiper-slide d-flex align-items-center" style="background: linear-gradient(rgba(0,0,0,.25), rgba(0,0,0,.25)), url(<?php the_sub_field('image', 'full'); ?>) no-repeat center/cover;">
                        <div class="container position-relative mt-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h2 class="slide-heading mb-4 display-1 text-white lh-1"><?php echo get_sub_field('heading'); ?></h2>
                                    <?php if(get_sub_field('button_text')): ?>
                                        <a href="<?php if(get_sub_field('button_link')): echo esc_url(get_sub_field('button_link')); endif; ?>" class="btn btn-primary btn-lg fw-bold text-white rounded-0"><?php echo get_sub_field('button_text'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination hero-pagination"></div>
        </div>
    <?php endif; ?>
</div>

