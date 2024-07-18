<?php 
$api_key = get_field('google_maps_api_key', 'option');
?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&callback=Function.prototype"></script>
<script type="text/javascript">
(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 16,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        styles      : [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#4d4d4d"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"weight":1}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"color":"#ededed"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"color":"#adb5bd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c0bfbf"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#bdccdb"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    var originMarker = null; // Marker without data-type="destination"
    var destinationMarkers = []; // Markers with data-type="destination"

    $markers.each(function(){
        var $this = $(this);
        var type = $this.data('type');

        var marker = initMarker( $(this), map );

        if (type === 'destination') {
            destinationMarkers.push(marker);
        } else { 
            originMarker = marker;
        }
    });

    if (originMarker) {
        destinationMarkers.forEach(function(destinationMarker) {
            var line = new google.maps.Polyline({
                path: [originMarker.getPosition(), destinationMarker.getPosition()],
                geodesic: true,
                strokeColor: '#19BEE6',
                strokeOpacity: .65,
                strokeWeight: 2,
                map: map
            });
        });
    }


    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var type = $marker.data('type');
    var icon;
    if (type === 'destination') {
        icon = {
            url: '<?php echo get_stylesheet_directory_uri() . '/assets/icons/arrival.svg'; ?>',
            anchor: new google.maps.Point(16, 16) // Adjust based on the icon's dimensions
        };
    } else {
        icon = {
            url: '<?php echo get_stylesheet_directory_uri() . '/assets/icons/ykf-marker.svg'; ?>',
            anchor: new google.maps.Point(16, 16) // Adjust based on the icon's dimensions
        };
    }
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    // Create marker instance.
    var marker = new google.maps.Marker({
        position : latLng,
        map: map,
        icon: icon
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

    }

    // Attach click event directly to the marker
    google.maps.event.addListener(marker, 'click', function() {
        var destId = 'dest_' + $marker.data('airport-code');
        var dests = $('.destination-card');
        var dest = $('#' + destId);
        if (dest.length) {
            $('html, body').animate({
                scrollTop: dest.offset().top - 200
            }, 0);
            
            dests.removeClass('active');
            
            setTimeout(function() {
                dest.addClass('active');
            }, 600);
        }
    });

    return marker;
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function(){
    $('.ykf-map').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);
</script>