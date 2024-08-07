<?php 

$dest_id = $args['dest'];
$dest = get_field('destination', $dest_id);

?>

<div class="col my-4">
    <div id="dest_<?php echo esc_attr($dest['airport_code']); ?>" class="destination-card position-relative d-flex flex-column h-100 border border-light shadow-sm rounded-3 text-center">
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
                    $airline_term = get_term($airline_id, 'airline');
                    $airline_name = $airline_term->name;
                ?>
                    <div class="col-4">
                        <?php if($airline_link): ?><a <?php if(count($dest['airlines']) == 1) { echo 'class="stretched-link" ';  } ?>href="<?php echo esc_url($airline_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo 'Book a flight to ' . $dest['city'] . ' with ' . $airline_name; ?>"><?php endif; ?>
                            <?php echo wp_get_attachment_image(get_field('logo', 'airline_' . $airline_id)['id'], 'medium'); ?>
                        <?php if($airline_link): ?></a><?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>