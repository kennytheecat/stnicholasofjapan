<section class="hero-section">

<?php 
$intro = get_option('frontpage', false); 
if ( $intro) {

$intro['hero_image'] = isset($intro['hero_image']) ? $intro['hero_image'] : '';

$intro['hero_button_1_url'] = isset( $intro['hero_button_1_url'] ) ? get_the_permalink($intro['hero_button_1_url'] ) : '';
if ( isset($intro['hero_button_1_url_override'] ) ) {
    $intro['hero_button_1_url'] = $intro['hero_button_1_url_override'];
}
$intro['hero_button_2_url'] = isset( $intro['hero_button_2_url'] ) ? get_the_permalink($intro['hero_button_2_url'] ) : '';
if ( isset( $intro['hero_button_2_url_override'] ) ) {
    $intro['hero_button_2_url'] = $intro['hero_button_2_url_override'];
}
?>

    <img src="<?php echo $intro['hero_image']?>" class="hero-image" />

    <div class="hero-content">
        <h2 class="hero-slogan"><?php echo $intro['hero_slogan']; ?></h2>
        <div class="cta">
            <button class="visit"><a href="<?php echo $intro['hero_button_1_url']; ?>"><?php echo $intro['hero_button_1_text']; ?></a></button>
            <button class="learn"><a href="<?php echo $intro['hero_button_2_url']; ?>"><?php echo $intro['hero_button_2_text']; ?></a></button>
        </div>			
    </div>
<?php } ?>
</section>