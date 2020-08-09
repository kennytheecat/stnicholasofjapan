<section class="engage">
    <div class="wrapper">
        <div class="seraph"></div>

    <?php
    $intro = get_option('frontpage', false);
    if ( $intro ) {

    $intro['prayer_button_url'] = isset( $intro['prayer_button_url']  ) ? get_the_permalink($intro['prayer_button_url'] ) : '';
    
    if ( isset($intro['prayer_button_url_override'] ) ) {
        $intro['prayer_button_url'] = $intro['prayer_button_url_override'];
    }

    $intro['ask_button_url'] = isset( $intro['ask_button_url']  ) ? get_the_permalink($intro['ask_button_url'] ) : '';   

    if ( isset($intro['ask_button_url_override'] ) ) {
        $intro['ask_button_url'] = $intro['ask_button_url_override'];
    }  
    ?>
        
    <div class="prayer">
        <h3><?php echo $intro['prayer_heading']; ?></h3>    
        <div class="content"><?php echo $intro['prayer_content']; ?></div>
        <button><a href="<?php echo $intro['prayer_button_url']; ?>"><?php echo $intro['prayer_button']; ?></a></button>
    </div>

    <div class="ask">
        <h3><?php echo $intro['ask_heading']; ?></h3>    
        <div class="content"><?php echo $intro['ask_content']; ?></div>
        <button><a href="<?php echo $intro['ask_button_url']; ?>"><?php echo $intro['ask_button']; ?></a></button>
    </div>

<?php } ?>
    </div>

</section>