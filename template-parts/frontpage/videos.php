<section class="videos">
    <div class="wrapper">
        <h2>Discover the Orthodox Faith</h2>
        <?php $intro = get_option('frontpage', true);  ?>

        <?php
        for( $i = 1; $i <=4; $i++ ) {
            echo '<div class="video">';
            echo '<h3>' . $intro['videos_video_' . $i . '_title'] . '</h3>';
            echo wp_oembed_get( $intro['videos_video_' . $i] );
            echo '</div>';
        }
        ?>
    </div>
</section>