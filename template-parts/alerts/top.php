<?php
$settings = get_option('settings', false);
if ( isset( $settings['alert-message'])) {
    $date = date('m/d/y');
    if ( $date < $settings['alert-date'] ) {
?>
<section class="alert top">
    <div class="wrapper">
        <?php echo $settings['alert-message']; ?>
    </div>
</section>
<?php 
    } 
} 
?>