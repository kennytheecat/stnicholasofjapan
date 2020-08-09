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
        }
        ?>
            
        <div class="service_info">
            <?php echo apply_filters( 'the_content',  $intro['content']); ?>
        </div>

        <div class="service_map">
			<iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q='<?php echo $location_full_map; ?>'&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
            <?php } ?>
    </div>
</section>


