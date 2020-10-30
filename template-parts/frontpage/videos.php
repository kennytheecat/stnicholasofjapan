<section class="videos">
    <div class="wrapper">
        <?php 
        $settings = get_option( 'settings', false);        
        $intro = get_option('frontpage', false); 

        if ( $intro || $settings ) {
            echo '<h2>Discover the Orthodox Faith</h2>';
            $count = 2;
            if ( is_front_page() ) {
                $count = 4; 
            }
            for( $i = 1; $i <=$count; $i++ ) {
                echo '<div class="video">';

                if ( !is_front_page() && isset($settings['video-404-' . $i . '-override'] ) ) {
                    echo '<h4>' . $settings['video-404-' . $i . '-override-title'] . '</h4>';
                    //echo '<iframe src="" frameborder="0" allowfullscreen="allowfullscreen" data-src="' . $settings['video-404-' . $i . '-override'] . '"></iframe>';
                    echo wp_oembed_get( $settings['video-404-' . $i . '-override'], array( 'width' => 400, ) );
                } else {
                    echo '<h4>' . $intro['videos_video_' . $i . '_title'] . '</h4>';
                    //echo '<iframe src="" frameborder="0" allowfullscreen="allowfullscreen" data-src="' . $intro['videos_video_' . $i] . '"></iframe>';
                    echo wp_oembed_get( $intro['videos_video_' . $i], array( 'width' => 400) );
                }

                echo '</div>';
            }
        }
        ?>
    </div>
</section>