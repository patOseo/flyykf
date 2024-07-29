<?php
/**
* Reviews Block
*
* @package flyykf
*/

$class_name = 'block-reviews position-relative';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

?>

<?php if(have_rows('reviews')): ?>

    <div class="<?php echo esc_attr($class_name); ?>">
        <div class="swiper" id="swiper">
            <div class="swiper-wrapper">
                <?php while(have_rows('reviews')): the_row(); $rating = get_sub_field('rating'); ?>
                    <div class="swiper-slide">
                        <div class="review text-center fs-6 fw-normal">
                            <div class="review-rating mb-3">
                                <?php for($i = 1; $i <= $rating; $i++): ?>
                                    <div class="d-inline mx-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="18"><path fill="#EAAF0F" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div class="review__content px-6">
                                "<?php the_sub_field('review'); ?>"
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div class="pt-5">
            <div class="swiper-pagination"></div>
        </div>
    </div>

<?php endif;