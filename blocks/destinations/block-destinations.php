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

$show_dests = get_field('show_dests');

$args = array(
    'post_type' => 'destination',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'orderby' => 'title',
    'order' => 'ASC'
);

$all_dests = new WP_Query($args);

$all_dests_ids = $all_dests->posts;

?>

<?php if($show_dests != 'all' && have_rows('destination_sections')): 
    
    // Setting up an array with all the destinations for the map
    $map_dests = array();
    $map_dests_ids = array();
    while(have_rows('destination_sections')): the_row();
        $destinations = get_sub_field('destinations');
        foreach($destinations as $destination): 
            $dest = get_field('destination', $destination);
            $address = get_field('address', $destination);
            $map_dests[] = array(
                'city' => $dest['city'],
                'country' => $address['country'],
                'lat' => $address['lat'],
                'lng' => $address['lng'],
                'airport_code' => $dest['airport_code'],
                'dest_id' => $destination
            );

            if($dest['destination_status'] == 1) {
                $map_dests[count($map_dests) - 1]['enabled'] = '1';
            } else {
                $map_dests[count($map_dests) - 1]['enabled'] = '0';
            }

            $map_dests_ids[] = $destination;
        endforeach;
    endwhile;

    // If we have destinations, we need to get the ones that are not in the map
    foreach($all_dests_ids as $all_dest_id) {
        if(!in_array($all_dest_id, $map_dests_ids)) {
            $dest = get_field('destination', $all_dest_id);
            $address = get_field('address', $all_dest_id);
            $non_map_dests[] = array(
                'city' => $dest['city'],
                'lat' => $address['lat'],
                'lng' => $address['lng'],
                'country' => $address['country'],
                'airport_code' => $dest['airport_code'],
                'enabled' => '0',
                'dest_id' => $all_dest_id
            );
        }
    }
?>

<?php elseif($show_dests == 'all'):

    $map_dests = array();

    foreach($all_dests_ids as $dest_id) {
        $dest = get_field('destination', $dest_id);
        $address = get_field('address', $dest_id);
        $map_dests[] = array(
            'city' => $dest['city'],
            'country' => $address['country'],
            'lat' => $address['lat'],
            'lng' => $address['lng'],
            'airport_code' => $dest['airport_code'],
            'dest_id' => $dest_id
        );

        if($dest['destination_status'] == 1) {
            $map_dests[count($map_dests) - 1]['enabled'] = '1';
        } else {
            $map_dests[count($map_dests) - 1]['enabled'] = '0';
        }
    }

endif; ?>


<?php if(isset($map_dests) && $map_dests): ?>
<div class="<?php echo esc_attr($class_name); ?>">
    <?php if($map_dests):  // If we have destinations, render the map ?>
    <div class="destinations-map shadow mt-n4 mx-n2 mt-lg-n5 mx-lg-n4 mb-5">
        <div class="ykf-map rounded-2" id="ykf-map" role="application" tabindex="0" aria-label="Map of YKF destinations with a map marker for each destination" data-zoom="16">
            <?php $ykf = get_field('ykf_airport_address', 'option'); // This is the marker for the YKF Airport. We grab latlng values from the Options field. ?>
                <div class="marker" data-lat="<?= $ykf['lat']; ?>" data-lng="<?= $ykf['lng']; ?>" data-city="Waterloo, ON" data-country="<?= $ykf['country']; ?>" data-airport-code="YKF" data-type="origin" aria-label="Map marker for YKF Airport in Waterloo, ON"></div>

            <?php foreach($map_dests as $map_dest): // We add a marker for each destination ?>
                <div class="marker" data-enabled="<?php echo $map_dest['enabled']; ?>" data-lat="<?php echo $map_dest['lat']; ?>" data-lng="<?php echo $map_dest['lng']; ?>" data-type="destination" data-city="<?php echo $map_dest['city']; ?>" data-country="<?php echo $map_dest['country']; ?>" data-airport-code="<?php echo $map_dest['airport_code']; ?>" aria-label="Map marker for <?php echo $map_dest['city']; ?>"></div>
            <?php endforeach; ?>

            <?php if(isset($non_map_dests) && get_field('show_greyed_out_destinations') != 0): foreach($non_map_dests as $non_map_dest): // We add a marker for each disabled destination ?>
                <div class="marker" data-enabled="<?php echo $non_map_dest['enabled']; ?>" data-lat="<?php echo $non_map_dest['lat']; ?>" data-lng="<?php echo $non_map_dest['lng']; ?>" data-type="destination" data-city="<?php echo $non_map_dest['city']; ?>" data-country="<?= $non_map_dest['country']; ?>" data-airport-code="<?php echo $non_map_dest['airport_code']; ?>" aria-label="Disabled map marker for <?php echo $non_map_dest['city']; ?>"></div>
            <?php endforeach; endif; ?>
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
                    <?php foreach($destinations as $destination): ?>
                        <?php get_template_part('blocks/destinations/loop', 'destinations', array('dest' => $destination)); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <?php if($show_dests == 'all' && get_field('show_dest_cards')): ?>
        <div class="destination-section">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                <?php foreach($all_dests_ids as $dest_id): ?>
                    <?php get_template_part('blocks/destinations/loop', 'destinations', array('dest' => $dest_id)); ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php 
@include_once('map.php');

endif;