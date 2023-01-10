<?php
namespace Evermade\Swiss\Shortcodes;

function button($atts)
{
    extract(shortcode_atts(array(
        'class' => '',
        'text' => 'Submit',
        'url' => '#',
        'aria_label' => ''
    ), $atts));

    return sprintf('<p><a href="%s" class="c-btn %s" aria-label="%s">%s</a></p>', $url, $class, $aria_label, $text);
}

add_shortcode('button', 'Evermade\Swiss\Shortcodes\button');



function distancetotal($atts)
{
    // Get any existing copy of our transient data
    if ( false === ( $get_distance_total = get_transient( 'distance_total' ) ) ) {
        $args = array('headers' => array('x-functions-key' => '69184266eb17821afdd22b65e99d673c'));
        $url = 'https://corego-distance-reader.azurewebsites.net/api/distance';
        $response = wp_remote_request($url, $args);
        if ( is_wp_error( $response ) ) {
            // Error
            $distance = __('data error', 'swiss');
        } else {
            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );     
            $get_distance_total = round($data->totalDistance/1000,1);
            set_transient( 'distance_total', $get_distance_total, 1 * HOUR_IN_SECONDS );
        }
    }
    return $get_distance_total;
}


add_shortcode('distancetotal', 'Evermade\Swiss\Shortcodes\distancetotal');

function distancetoday($atts)
{
    // Get any existing copy of our transient data
    if ( false === ( $get_distance_today = get_transient( 'distance_today' ) ) ) {
        $args = array('headers' => array('x-functions-key' => '69184266eb17821afdd22b65e99d673c'));
        $url = 'https://corego-distance-reader.azurewebsites.net/api/distance';
        $response = wp_remote_request($url, $args);
        if ( is_wp_error( $response ) ) {
            // Error
            $distance = __('data error', 'swiss');
        } else {
            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );
            $get_distance_today = round($data->distanceToday/1000,1);
            set_transient( 'distance_today', $get_distance_today, 1 * HOUR_IN_SECONDS );
        }
    }
    return $get_distance_today;
}


add_shortcode('distancetoday', 'Evermade\Swiss\Shortcodes\distancetoday');
