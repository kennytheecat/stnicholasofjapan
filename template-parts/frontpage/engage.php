<section class="engage">
    <div class="wrapper">

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
        
    <div class="module prayer">
        <h3><?php echo $intro['prayer_heading']; ?></h3>    
        <div class="content"><?php echo $intro['prayer_content']; ?></div>
        <button><a href="<?php echo $intro['prayer_button_url']; ?>"><?php echo $intro['prayer_button']; ?></a></button>
    </div>


    <div class="image">
        <img src="http://localhost/bathemes-sandbox/wp-content/themes/tabula-rasa_nicholas-of-japan/images/seraph.png" loading="lazy" />
    </div>

    <div class="module ask">
        <h3><?php echo $intro['ask_heading']; ?></h3>    
        <div class="content"><?php echo $intro['ask_content']; ?></div>
        <button><a href="<?php echo $intro['ask_button_url']; ?>"><?php echo $intro['ask_button']; ?></a></button>
    </div>

<?php } ?>
    </div>

</section>