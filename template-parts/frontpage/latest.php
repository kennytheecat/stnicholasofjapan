<?php
// Check to see if post types are empty
$media_array = array( 'post', 'events', 'galleries', 'sermons' );
foreach ( $media_array as $posttype ) {
    $hasposts = get_posts('post_type=' . $posttype );
    if ( $hasposts ) {
        $media_array_checked[] = $posttype;
    }
    
}
// the array should now only consist of post types that have items in them
$media_array = $media_array_checked;

// make an array of just values for get_posts
$post_type_array = array( 'post' );
foreach($media_array as $posttype ) {
    $post_type_array[] = $posttype;
}
$args = array( 
    'posts_per_page'    => 4, 
    'status'            => 'publish',
    'post_type'         => $post_type_array
);
$items = get_posts( $args );

        
//Check for weekly bulletin
// Are there any weekly bulletlins
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM bulletins");
if ( $results ) {
    $media_array[] = 'weekly bulletins';
}

// Is there a recent weekly bulletin
$results = $wpdb->get_results( "SELECT * FROM bulletins WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 3 DAY) AND DATE_ADD(NOW(), INTERVAL 2 DAY) ORDER BY date DESC");

foreach ($results as $result) {
    $result->post_date = $result->date;
    $bulletin_naming = get_option( 'bulletin_naming');
    $result->post_title = date( $bulletin_naming, strtotime($result->date ) );
    $result->post_type = 'bulletin';
    $items[] = $result;
}

// Sort the array by most recent post date
$date = array_column($items, 'post_date');
array_multisort($date, SORT_DESC, $items );

// make sure there is only 4 items
$items = array_slice( $items, 0, 4 );

// Check if there are at lest 3 items
$goahead = false;
$count = $items;
if ( $count >= 2 ) { $goahead = true; } else { $goahead = false; }
//check if the newest item is less than 3 months old
$then = strtotime('-3 months');
$this_date = strtotime($items[0]->post_date);

if ( $this_date >= $then ) { $goahead = true; } else { $goahead = false; }

if ( $goahead == true ) {
?>
<section class="latest">
    <div class="wrapper">
        <h3>The Latest From Our Parish</h3>
        <p class="more">More 
        <?php
        $count = count($media_array);
        $i = 1;
        foreach ( $media_array as $posttype ) {
            if ( $posttype == 'post') {
                $posttype = 'articles';
            }
            echo '<a href="' . home_url() . '/' . str_replace( ' ', '-', $posttype) . '/">' . ucwords($posttype) . '</a>';
            if ( $i < $count ) {
                echo ' \ ';
            }
            $i++;
            
        }
        ?>
        >></p>

        <?php 
        foreach ( $items as $post ) : setup_postdata( $post ); 
       
        $link = get_the_permalink();
        
        if ( has_post_thumbnail() ) {
            $image = get_the_post_thumbnail(); 
        } else {
            $images = get_option( 'settings');
            $image = $images['default_image_' . $post->post_type . '_id'];            
            $image =  wp_get_attachment_image( $image ); 
        }  

        switch ($post->post_type) {
            case 'sermons':
                $type = 'Sermon';
                break; 

                case 'documents':
                    $type = 'Document';
                    break;

                case 'events':
                    $type = 'Event';
                    break;

                case 'galleries':
                    $type = 'Gallery'; 
                    break;

                case 'bulletin':
                    $type = 'Bulletin';
                    $link = home_url() . $post->file;
                    break;                    

                default:
                $type = 'Article';
        }
        ?>
        
        <div class="spotlight">
                
            <a href="<?php echo $link; ?>">        
            <div class="type-wrapper">
                <?php echo $image; ?>
                <p class="type"><?php echo $type; ?></p>
            </div>                
            </a>

            <div class="content-wrapper">
                <h4><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h4>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
</section>

<?php } ?>

<?php wp_reset_postdata(); ?>