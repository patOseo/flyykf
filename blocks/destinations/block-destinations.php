<?php
/**
* Destinations Block
*
* @package flyykf
*/

$class_name = 'block-destinations';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

$args = array(
    'post_type' => 'destination',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids'
);

$all_dests = new WP_Query($args);

?>

<?php if(have_rows('destination_sections')): 
    
    // Setting up an array with all the destinations for the map
    $map_dests = array();
    $map_nondests = array();
    while(have_rows('destination_sections')): the_row();
        $destinations = get_sub_field('destinations');
        foreach($destinations as $destination): 
            $dest = get_field('destination', $destination);
            $address = get_field('address', $destination);
            $map_dests[] = array(
                'city' => $dest['city'],
                'lat' => $address['lat'],
                'lng' => $address['lng'],
                'airport_code' => $dest['airport_code']
            );
        endforeach;
    endwhile;
?>

<div class="<?php echo esc_attr($class_name); ?>">
    <?php if($map_dests): // If we have destinations, render the map ?>
    <div class="destinations-map shadow mt-n4 mx-n2 mt-lg-n5 mx-lg-n4 mb-5">
        <div class="ykf-map rounded-2" id="ykf-map" data-zoom="16">
            <?php $ykf = get_field('ykf_airport_address', 'option'); // This is the marker for the YKF Airport. We grab latlng values from the Options field. ?>
                <div class="marker" data-lat="<?= $ykf['lat']; ?>" data-lng="<?= $ykf['lng']; ?>" data-city="Waterloo, ON" data-airport-code="YKF" data-type="origin"></div>

            <?php foreach($map_dests as $map_dest): // We add a marker for each destination ?>
                <div class="marker" data-lat="<?php echo $map_dest['lat']; ?>" data-lng="<?php echo $map_dest['lng']; ?>" data-type="destination" data-city="<?php echo $map_dest['city']; ?>" data-airport-code="<?php echo $map_dest['airport_code']; ?>"></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php while(have_rows('destination_sections')): the_row(); // If we have destination sections, loop through each and render them
        $destinations = get_sub_field('destinations');
    ?>
        <div class="destination-section mb-5">
            <div class="text-center">
                <h2 class="h3 mb-4"><?php echo get_sub_field('heading'); ?></h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                    <?php foreach($destinations as $destination): $dest = get_field('destination', $destination); // Loop through each destination and render as a col + destination card ?>
                        <div class="col my-4">
                            <div id="dest_<?php echo esc_attr($dest['airport_code']); ?>" class="destination-card position-relative d-flex flex-column h-100 border border-light shadow-sm rounded-3">
                                <div class="position-relative mb-5">
                                    <div class="destination-image overflow-hidden"><?php echo wp_get_attachment_image($dest['image'], 'large', '', array('class' => 'ratio ratio-16x9')) ?></div>
                                    <div class="airport-code position-absolute start-50 top-100 translate-middle bg-primary shadow-sm text-center px-4 py-2">
                                        <p class="text-white text-uppercase fs-6 fw-bold mb-0"><?php echo $dest['airport_code']; ?></p>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h3 class="h4 text-darkblue"><?php echo $dest['city']; ?></h3>
                                    <p><?php echo $dest['description']; ?></p>
                                </div>
                                <?php if($dest['airlines']): ?>
                                    <div class="row mt-auto mx-2 py-4 justify-content-center align-items-center">
                                        <?php foreach($dest['airlines'] as $airline):
                                            $airline_id = $airline['airline'];
                                            $airline_link = $airline['booking_link'];    
                                        ?>
                                            <div class="col-4">
                                                <?php if($airline_link): ?><a <?php if(count($dest['airlines']) == 1) { echo 'class="stretched-link" ';  } ?>href="<?php echo esc_url($airline_link); ?>" target="_blank" rel="noopener noreferrer"><?php endif; ?>
                                                    <?php echo wp_get_attachment_image(get_field('logo', 'airline_' . $airline_id)['id'], 'medium'); ?>
                                                <?php if($airline_link): ?></a><?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php 
@include_once('map.php');

endif;