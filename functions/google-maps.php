<?php
function flyykf_acf_init() {
    acf_update_setting('google_api_key', get_field('google_maps_api_key', 'option'));
}
add_action('acf/init', 'flyykf_acf_init');