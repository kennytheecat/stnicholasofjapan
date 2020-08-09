<section class="videos">
    <div class="wrapper">
        <h3>Discover the Orthodox Faith</h3>
        <?php 
        $settings = get_option( 'settings', true);        
        $intro = get_option('frontpage', true); 
        $count = 2;
        if ( is_front_page() ) {
            $count = 4; 
        }
        for( $i = 1; $i <=$count; $i++ ) {
            echo '<div class="video">';

            if ( !is_front_page() && $settings['video-404-' . $i . '-override'] ) {
                echo '<h4>' . $settings['video-404-' . $i . '-override-title'] . '</h4>';
                echo wp_oembed_get( $settings['video-404-' . $i . '-override'] );
            } else {
                echo '<h4>' . $intro['videos_video_' . $i . '_title'] . '</h4>';
                echo wp_oembed_get( $intro['videos_video_' . $i] );
            }


            echo '</div>';
        }
        ?>
    </div>
</section>