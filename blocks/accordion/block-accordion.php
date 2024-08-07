<?php
/**
 * Accordion Block
 *
 * @package flyykf
 */

$class_name = 'accordion-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$htmltag = get_field('title_html_tag'); 
$htmltagopen = "<" . $htmltag . " class='my-0'>";
$htmltagclose = "</" . $htmltag . ">";
$random = rand(1, 1000);

$multi = get_field('allow_multi');

if(get_field('button_size') == 'large') {
	$btnsize = 'fs-4';
	$txtsize = 'fs-6';
} else {
	$btnsize = 'fs-5';
	$txtsize = '';
}
?>

<?php if(have_rows('accordion')): ?>

	<div id="accordion-<?= $random; ?>" class="<?php echo esc_attr( $class_name ); ?> accordion">
		<?php $i = 1; while(have_rows('accordion')): the_row(); ?>

			<div class="accordion-card">
				<div class="hover position-relative mb-3 bg-light" id="heading<?php echo $i; ?>">
					<?php echo $htmltagopen; ?>
					<button class="collapsed d-flex align-items-center w-100 py-3 border-0 <?php echo esc_attr($btnsize); ?> fw-bold text-start text-darkblue bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>-<?= $random; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>-<?= $random; ?>">
						<div class="d-inline mx-3 accordion-icon">
							<svg width="21" height="13" viewBox="0 0 21 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M10.8488 12.7314L0.878906 2.7615L3.59036 0.0500488L10.8789 7.33859L18.1675 0.0500496L20.8789 2.7615L10.909 12.7314L10.8789 12.7013L10.8488 12.7314Z" fill="#19BEE6"/>
							</svg>
						</div>
						<?php echo get_sub_field('title'); ?>
					</button>
					<?php echo $htmltagclose; ?>

				</div>
				<div id="collapse<?php echo $i; ?>-<?= $random; ?>" class="collapse multi-collapse" aria-labelledby="heading<?php echo $i; ?>" <?php if($multi == 0) { echo 'data-bs-parent="#accordion-' . $random . '"'; } ?>>
					<div class="card-body px-3 px-lg-5 py-4">
						<div class="px-1 <?php echo esc_attr($txtsize); ?>"><?php echo get_sub_field('content'); ?></div>
					</div>
				</div>
			</div>

		<?php $i++; endwhile; ?>
	</div>

<?php endif;