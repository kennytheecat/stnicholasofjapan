<section class="services">
    <div class="wrapper">

        <?php 
        $intro = get_option('frontpage', false);
        if ( $intro ) {
        if ( isset($intro['map_address_override']) ) {
            $location_full_map = str_replace( ' ', '%20', $intro['map_address_override'] );
        } else {
            $settings = get_option( 'settings', true);
            $name = $settings['basic_info_name'];
            $street = $settings['basic_info_address_street'];
            $city = $settings['basic_info_address_city'];
            $state = $settings['basic_info_address_state'];
            $zip = $settings['basic_info_address_zip'];
            $location_full = $name . ' ' . $street . ', ' . $city . ', ' . $state . '  ' . $zip;
            $location_full_map = str_replace( ' ', '%20', $location_full );

            $src_set = isset( $settings['basic_info_map_image_id'] ) ? wp_get_attachment_image_srcset( $settings['basic_info_map_image_id'] ) : '';
            $sizes = isset( $settings['basic_info_map_image_id'] ) ? wp_get_attachment_image_sizes( $settings['basic_info_map_image_id'] ) : '';
            
                              
        }
        ?>
            
        <div class="service_info">
            <?php echo apply_filters( 'the_content',  $intro['content']); ?>
        </div>

        <div class="service_map">
            <?php
            echo '<a href="https://maps.google.com/maps?q=' . $location_full_map . '"><img loading="lazy" src="' . $settings['basic_info_map_image'] . '" srcset="' . $src_set. '" sizes="' . $sizes. '"  /></a>';            
            ?>

		</div>
            <?php } ?>
    </div>
</section>


