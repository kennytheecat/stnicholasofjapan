<div class="line">
    <div class="wrapper"></div>
</div>

<section class="welcome">
    <div class="wrapper">

        <?php 
        $intro = get_option('frontpage', true); 
        $src_set = isset( $intro['welcome_image_id'] ) ?wp_get_attachment_image_srcset( $intro['welcome_image_id'] ) : '';
        $sizes = isset( $intro['welcome_image_id'] ) ?wp_get_attachment_image_sizes( $intro['welcome_image_id'] ) : '';
        ?>
            
        <div class="welcome_content">
            <h3><?php echo $intro['welcome_heading']; ?></h3>    
            <?php echo apply_filters( 'the_content', $intro['welcome_content']); ?>
        </div>

        <div class="welcome_media">
            <?php 
            if ( isset($intro['welcome_image'] ) ) {
                echo '<img loading="lazy" src="' . $intro['welcome_image'] . '" srcset="' . $src_set. '" sizes="' . $sizes. '"  />';
            }     
            if ( isset( $intro['welcome_video'] ) ) {
				echo wp_oembed_get( $intro['welcome_video'] );
            }      
            ?> 
        </div>

    </div>
</section>