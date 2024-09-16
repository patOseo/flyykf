<?php 

$dest_id = $args['dest'];
$dest = get_field('destination', $dest_id);
$status = $dest['destination_status'];
?>

<div class="col my-4">
    <div id="dest_<?php echo esc_attr($dest['airport_code']); ?>" class="destination-card position-relative d-flex flex-column h-100 border border-light shadow-sm rounded-3 text-center">
        <?php if($status == 0): ?>
        <div class="not-operating position-absolute top-0 start-0 w-100 h-100 z-1">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="destination-status opacity-75 text-white border fw-bold rounded-0 p-3 top-0 end-0 position-absolute mt-3 me-3">
                    <p class="mb-0">Not Operating</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

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

                    <?php if($status != false && $airline_name == 'WestJet'): ?>
                        <!-- Modal -->
                        <div class="modal fade" id="modal<?php echo $dest['airport_code']; ?>" tabindex="-1" aria-labelledby="modal<?php echo $dest['airport_code']; ?>Label" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body overflow-y-scroll" height="600">
                              <?php // echo wp_get_attachment_image(get_field('logo', 'airline_' . $airline_id)['id'], 'medium'); ?>
                                <iframe src="https://www.westjet.com/booking-widget/widget.html?locale=en-CA&origin=ykf&destination=<?= $dest['airport_code']; ?>" width="100%" height="720" title="WestJet Booking Widget" style="width:100%"></iframe>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-4">
                        <?php if($status == 1 && $airline_link && $airline_name != 'WestJet'): ?><a <?php if(count($dest['airlines']) == 1) { echo 'class="stretched-link" ';  } ?>href="<?php echo esc_url($airline_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo 'Book a flight to ' . $dest['city'] . ' with ' . $airline_name; ?>"><?php endif; ?>
                        <?php if($status == 1 && $airline_name == 'WestJet'): ?><a href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dest['airport_code']; ?>"><?php endif; ?>
                            <?php echo wp_get_attachment_image(get_field('logo', 'airline_' . $airline_id)['id'], 'medium'); ?>
                        <?php if($status == 1 && $airline_link || $airline_name == 'WestJet'): ?></a><?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>