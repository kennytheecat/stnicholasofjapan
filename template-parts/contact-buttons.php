
<section class="buttons">
    <?php
    $settings = get_option( 'settings', false);
    if ( $settings ) {
        echo '<p class="headline">We have a few contact forms for you to choose from.</p>';
        $buttons = $settings['contact_buttons'];

        foreach ($buttons as $button ) {
            if ( $button['desc'] ) {
                $button['desc'] = $button['desc'];
            } else {
                $button['desc'] = '';
            }
            if ( is_numeric( $button['url'] ) ) {
                $button['url'] = get_the_permalink($button['url'] );
            }
            if ( $button['url_override'] ) {
                $button['url'] = $button['url_override'];
            }

            echo '
            <div class="contact-button">
                <p>' . $button['desc'] . '</p>
                <button><a href="' . $button['url'] . '">' . $button['title'] . '</a></button>
            </div>'; 
        }
    }
    ?>
</section>