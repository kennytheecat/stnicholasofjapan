<?php
$settings = get_option( 'settings', true);
$buttons = $settings['sidebar_buttons'];

foreach ($buttons as $button ) {

    if ( is_numeric( $button['url'] ) ) {
        $button['url'] = get_the_permalink($button['url'] );
    }
    if ( $button['url_override'] ) {
        $button['url'] = $button['url_override'];
    }

    echo '<button><a href="' . $button['url'] . '">' . $button['title'] . '</a></button>'; 
}

?>