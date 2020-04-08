<section class="engage">
    <div class="wrapper">
        <div class="seraph"></div>

    <?php
    $intro = get_option('frontpage', true);

    if ( is_numeric( $intro['prayer_button_url'] ) ) {
        $intro['prayer_button_url'] = get_the_permalink($intro['prayer_button_url'] );
    }
    if ( is_numeric( $intro['ask_button_url'] ) ) {
        $intro['ask_button_url'] = get_the_permalink($intro['ask_button_url'] );
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

    </div>

</section>