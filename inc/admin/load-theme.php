<?php
function load_ba_theme() {

    $theme_installed = get_option( 'theme_installed');
    if ( $theme_installed ) { return; }

    // Install plugins

    // Add Pages with Content
    //get json data for post by id
    //get_ba_content();

    // Add Pages without content
    //publish_ba_pages();

    // Add Caldera Forms Content
    load_contact_forms();

    // Add menus

    // Load Front Page Default Options
    $frontpage = get_frontpage_array();
    //update_option( 'frontpage', $frontpage );

    // Load Settings Default Options
    $settings = get_settings_array();
    //update_option( 'settings', $settings );
    

    // Set option so process is not ran twice
    //update_option( 'theme_installed', true );
}
add_action('after_switch_theme', 'load_ba_theme' );

function load_contact_forms() {

    $slugs = array( 'ask-the-priest-export', 'coffee-contact-export', 'general-contact-export', 'prayer-requests-export' );

    foreach ( $slugs as $slug ) {
        $location = get_template_directory_uri() . '/inc/admin/contact-forms/' . $slug . '.json';

        $data = json_decode( file_get_contents($location ), true  );
        $new_form_id = Caldera_Forms_Forms::import_form( $data, true );
    }
}

/*
function get_ba_content() {

    $slugs = array(
        'plan-a-visit', 
        'learn'
    );
    
    foreach( $slugs as $slug ) {
        $url = 'http://www.bothanddesign.com/wp-json/wp/v2/posts?slug=' . $slug;
        $response = wp_remote_get( $url );
        $results = json_decode( wp_remote_retrieve_body( $response ), true );	
        
        
        $args = array(
            'post_title'    => $results[0]['title']['rendered'],
            'post_content'  => $results[0]['content']['rendered'],
            'post_status'   => 'publish',
            'post_type'			=> 'page'
        );
        $new_post_id = wp_insert_post( $args );    
    }
}

function publish_ba_pages() {

    $pages = array( 'Bulletins and Newsletters', 'Calendar', 'Contact', 'Ask the Priest', 'Prayer Request', 'Let\'s Get Coffee', 'Media', 'Articles', 'Sermons', 'Parish Info');

    foreach ( $pages as $page ) {
        $content = '';
        $template = '';
        $parent = 0;

        if ( $page == 'Ask the Priest' ) {
            $caldera_form = '';
            $content = '<p class="has-text-align-center"><strong>This service is reserved for local residents. If you are not a local resident,&nbsp;<a rel="noreferrer noopener" href="https://orthodoxyinamerica.org/" target="_blank">please contact your local parish.</a></strong></p>' . $caldera_form;
            $template = 'page-templates\contact.php';
        }
        if ( $page == 'Prayer Request' ) {
            $caldera_form = '';
            $content = '<p class="has-text-align-center"><strong>This service is reserved for local residents. If you are not a local resident,&nbsp;<a rel="noreferrer noopener" href="https://orthodoxyinamerica.org/" target="_blank">please contact your local parish.</a></strong></p>
            <p>It is the tradition of the Orthodox church to maintain a list of people in need of prayer. Throughout the various services of the church these people will be prayed for by name. We don\'t add the reason they are asking for prayer. We simply say their name and ask God to have mercy on them.</p>
            <p>If you would like us to add your name or the name of others to our prayer list, please do so below.</p>';
            $template = 'page-templates\contact.php';
        }
        if ( $page == 'Let\'s Get Coffee' ) {
            $caldera_form = '';
            $content = '';
            $template = 'page-templates\contact.php';
        }
        if ( $page == 'Media' ) {
            $content = '';
            $template = 'page-templates\media-archive.php';
        }
        if ( $page == 'Articles' || $page == 'Sermons' ) {
            $post = get_page_by_title( 'Media' );
            $parent = $post->ID;
        }
        if ( $page == 'Parish Info' ) {
            $content = '';
            $template = 'page-info.php';
        }
        if ( $page == 'Bulletins and Newsletters' ) {
            $content = '';
            $template = 'page-templates\bulletins.php';
        }
        if ( $page == 'Calendar' ) {
            $content = '';
            $template = 'page-templates\calendar.php';
        }
        if ( $page == 'Contact' ) {
            $content = '';
            $template = 'contact.php';
        }
        $args = array(
            'post_title'        => $page,
            'post_content'      => $content,
            'post_status'       => 'publish',
            'post_type'			=> 'page',
            'page_template'     => $template,
            'post_parent'       => $parent
        );
        $new_post_id = wp_insert_post( $args );    
    }

    // add bulletins templates, calendat emplates, contacts
}
*/

/*

function get_frontpage_array() {

    $long_content = get_long_content();

    $frontpage = array(
        //'hero_image' => 'test',
        'hero_slogan' => 'Welcome Home',
        'hero_button_1_url' =>  '',
        'hero_button_1_override' =>  '',
        'hero_button_1_text' =>  'First Visit?',
        'hero_button_2_url' =>  '',
        'hero_button_2_override' =>  '',
        'hero_button_2_text' =>  'What is Orthodoxy?',
        'content' =>    $long_content['content'],
        'map_embed' =>  $long_content['map_embed'],
        'welcome_heading'   =>  'Welcome to St Nicholas!',
        'welcome_content'   =>  $long_content['welcome_content'],
        'prayer_heading'   =>  'Need Prayer?',
        'prayer_content'   =>  $long_content['prayer_content'],
        'prayer_button' =>  'Submit a Prayer Request',
        'ask_heading'   =>  'Have Questions about Orthodoxy?',
        'ask_content'   =>  $long_content['ask_content'],
        'ask_button'    =>  'Submit a Question',
        //welcome_image_id' => 102
        //'welcome_image' => http://stnicholasofjapan.bothanddesign.com/wp-content/uploads/2019/11/frate_family-1.jpg
        //'prayer_image_id' => 103
        //'prayer_image' => http://stnicholasofjapan.bothanddesign.com/wp-content/uploads/2019/11/prayer.jpg
        //'ask_image_id' => 104
        //'ask_image' => http://stnicholasofjapan.bothanddesign.com/wp-content/uploads/2019/11/ask-scaled.jpg
        //'hero_image_id' => 112
        //'hero_image' => http://localhost/bathemes/wp-content/uploads/2020/03/Image006-copy.jpg
        //'hero_button_1_url' => 44
        //'prayer_button_url' => 26
        'videos_video_1' => 'https://www.youtube.com/watch?v=WosgwLekgn8',
        'videos_video_2' => 'https://www.youtube.com/watch?v=6bemSZaIUAY',
        'videos_video_4_title' => 'And this thing too',
        'videos_video_4' => 'https://www.youtube.com/watch?v=T7Y4R_Jh8wQ',
        'videos_video_3_title' => 'What about Salvation?',
        'videos_video_3' => 'https://www.youtube.com/watch?v=T7Y4R_Jh8wQ',
        'videos_video_1_title' => 'Welcome to Our Church',
        'videos_video_2_title' => 'What about Mary?',
        //'yourprefix_post_multicheckbox' => 18
        //'hero_button_2_url' => 48
        'map_embed_override' => '1508 Northside Dr, Prescott, AZ 86301',
        //[_oembed_fe39049443aaaea63cc0f6bf10963744] => 
        //[_oembed_time_fe39049443aaaea63cc0f6bf10963744] => 1596328818
        //[_oembed_8efc226975f2ef3e2340bcf2ad687725] => 
        //[_oembed_time_8efc226975f2ef3e2340bcf2ad687725] => 1596328818
        //[_oembed_4125a057c968bdc32d2b39f50c0340ed] => 
        //[_oembed_time_4125a057c968bdc32d2b39f50c0340ed] => 1596328818
    );

    return $frontpage;

}

function get_settings_array() {

    $settings = array( 
        
        'basic_info_name' => 'St George Orthodox Church',
        'basic_info_address_street' => '609 W Gurley St',
        'basic_info_address_city' => 'Prescott',
        'basic_info_address_state' => 'AZ',
        'basic_info_address_zip' => '86301',
        'basic_info_phone' => '520-233-8853',
        'basic_info_email' => 'kennytheecat@gmail.com',
        'basic_info_facebook' => 'https://www.facebook.com/BrightWingMedia/',
        'basic_info_instagram' => 'https://www.instagram.com/groworthodoxy/',
        'basic_info_youtube' => 'https://www.youtube.com/channel/UCD-hPfNt3SgcmvjEfFRS-_A/',
        'footer_line_1' => 'Sunday - 8:30am, 9:30am',
        'footer_line_2' => 'Wednesday - 6:30pm',
        'video-404-2-override-title' => 'What about Job?',
        'video-404-2-override' => 'https://www.youtube.com/watch?v=GswSg2ohqmA',
        'basic_info_flickr' => 'http://google.com',
        'default_image_articles_id' => '101',
        'default_image_articles' => '//localhost:3000:3000:3000:3000/bathemes/wp-content/uploads/2019/11/Bird-hunting_1920x1200.jpg',
        'default_image_bulletins_id' => '173',
        'default_image_bulletins' => '//localhost:3000:3000:3000:3000/bathemes/wp-content/uploads/2019/11/blurred-background-dark-colors_1159-757.jpg',
        'default_image_gallerys_id' => '169',
        'default_image_gallerys' => '//localhost:3000:3000:3000:3000/bathemes/wp-content/uploads/2019/11/hiking-2540186_1920.jpg',
        'default_image_events_id' => '174',
        'default_image_events' => '//localhost:3000:3000:3000:3000/bathemes/wp-content/uploads/2019/11/999968-pastel-colors-background-1920x1080-hd-1080p.jpg',
        'default_image_sermons_id' => '103',
        'default_image_sermons' => '//localhost:3000:3000:3000:3000/bathemes/wp-content/uploads/2019/11/prayer.jpg',
        
        'sidebar_group' => array(

            '0' => array(
                'sidebar_title' => 'Plan a Visit',
                'sidebar_url' => '',
            ),
            '1' => array(
                'sidebar_title' => 'What is Orthodoxy?',
                'sidebar_url' => '',
            ),
            '2' => array(
                'sidebar_title' => 'Submit a Prayer Request',
                'sidebar_url' => '',
            ),
            '3' => array(
                'sidebar_title' => 'Ask a Question',
                'sidebar_url' => '',
            )

        ), 
        'sidebar_buttons' => array(

            '0' => array(
                'title' => 'Plan a Visit',
                'url' => 44,
                'url_override' => '',
            ),
            '1' => array(
                'title' => 'What is Orthodoxy?',
                'url' => 48,
                'url_override' => 'http://www.google.com',
            ),
            '2' => array(
                'title' => 'Submit a Prayer Request',
                'url' => 42,
                'url_override' => '',
            ),
            '3' => array(
                'title' => 'Ask a Question',
                'url' => 40,
                'url_override' => '',
            )

            ),
    
        'sidebar_image_id' => 286,
        'sidebar_image' => 'http://localhost/bathemes/wp-content/uploads/2020/07/tree.png',
        '_oembed_942132be2a29f16b00855c410ff1cbae' => 'someurliguess',    
        '_oembed_time_942132be2a29f16b00855c410ff1cbae' => '1595725204',
        'contact_buttons' => array(

            '0' => array(
                'desc' => 'General questions',
                'title' => 'Contact Us',
                'url' => 38,
                'url_override' => '',
            ),  
            '1' => array(
                'desc' => 'Have a question about Orthodoxy?',
                'title' => 'Ask the Priest',
                'url' => 40,
                'url_override' => '',
            ),
            '2' => array(
                'desc' => 'Would you like to meet face to face?',
                'title' => 'Let\'s Get Coffee',
                'url' => 287,
                'url_override' => '',
            ),
            '3' => array(
                'desc' => 'Put your name on our prayer list',
                'title' => 'Prayer Request',
                'url' => 42,
                'url_override' => '',
            ),

        ),    
         

    );
    return $settings;
    
}
function get_long_content() {

    $long_content = array(

    'content' => '<h3>Services</h3>
    <ul>
         <li><strong>Sunday:</strong> 8:30AM Matins, followed by 9:30 Divine Liturgy</li>
         <li><strong>Wednesday:</strong> 6:30PM Vespers</li>
         <li><strong>Saturday:</strong> 5PM Vespers</li>
    </ul>
    Weekday service times subject to change.
    
    Please view <a href="3000/bathemes/calendar/">calendar</a> for current service times.',

    'map_embed' => '<div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=609%20W %20Gurley%20St%2C%20Prescott%2C%20az%2086305&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com"></a></div>',

    'welcome_content' => 'Saint Herman Antiochian Orthodox Church is a parish serving the Matanuska-Susitna Valley.  We are committed to living out the Orthodox Christian faith through participation in Divine Services, study of Holy Scripture, caring for the poor and needy as well as through worshiping Christ daily in our homes and community.  We welcome all who wish to come and see.  "Taste and see that the Lord is good!"',

    'prayer_content' => 'Saint Herman Antiochian Orthodox Church is a parish serving the Matanuska-Susitna Valley.  We are committed to living out the Orthodox Christian faith through participation in Divine Services, study of Holy Scripture, caring for the poor and needy as well as through worshiping Christ daily in our homes and community.',

    'ask_content' => '"Saint Herman Antiochian Orthodox Church is a parish serving the Matanuska-Susitna Valley.  We are committed to living out the Orthodox Christian faith through participation in Divine Services, study of Holy Scripture, caring for the poor and needy as well as through worshiping Christ daily in our homes and community.',

    );

    return $long_content;
    
}
*/
?>