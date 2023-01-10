<section class="b-base">
    <div class="b-base__container">
            <?php
            $args = array('headers' => array('x-functions-key' => '69184266eb17821afdd22b65e99d673c'));
            $url = 'https://corego-distance-reader.azurewebsites.net/api/distance';
            $response = wp_remote_request($url, $args);
            if ( is_wp_error( $response ) ) {
                echo "Error";
            } else {
                $body = wp_remote_retrieve_body( $response );
                $data = json_decode( $body );     
            }

            if ($data):?>
            <h4><?php _e('Total distance:', 'swiss');?> <?php echo round($data->totalDistance/1000,1);?></h4>
            <h4><?php _e('Distance today:', 'swiss');?> <?php echo $data->distanceToday?></h4>
            <?php endif ?>
    </div>
</section>
