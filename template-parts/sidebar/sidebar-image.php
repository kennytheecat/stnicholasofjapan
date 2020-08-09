<?php
$settings = get_option( 'settings', true);
$image = $settings['sidebar_image'];

echo '<div class="tree">
    <div class="wrapper" style="background-image: url(' . $image . ');"></div>
</div>';
?>