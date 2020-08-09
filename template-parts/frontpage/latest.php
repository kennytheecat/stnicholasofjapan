<?php
// Check to see if post types are empty
$media_array = array( 'post', 'events', 'galleries', 'sermons', 'bulletins', 'links' );
foreach ( $media_array as $posttype ) {
    $args = array(
        'post_type' => $posttype,
        'date_query' => array(
            'after' => date('c', strtotime( '-4 months' )),
        ),
    );
    $hasposts = get_posts( $args );

    $media_array_checked = array();
    if ( $hasposts ) {
        $media_array_checked[] = $posttype;
    }
    
}
// the array should now only consist of post types that have items in them
$media_array = $media_array_checked;

// make an array of just values for get_posts
$post_type_array = array( 'post' );
foreach($media_array as $posttype ) {
    if ( $posttype == 'bulletins') continue;
    $post_type_array[] = $posttype;
}
$ppp = 3;
if ( is_front_page() ) {
    $ppp = 4;
}
$args = array( 
    'posts_per_page'    => $ppp, 
    'status'            => 'publish',
    'post_type'         => $post_type_array,
    'date_query' => array(
        'after' => date('c', strtotime( '-4 months' )),
    ),
);
$items = get_posts( $args );


$terms = get_terms( array(
    'hide_empty' => 0,
    'taxonomy' => 'bulletin_types',
) );

if ( $terms ) {
    foreach ( $terms as $term ) {
        
        $args = array( 
            'posts_per_page'    => 1, 
            'post_status'            => array( 'publish' ),
            'post_type'         => 'bulletins',
            'tax_query' => array(
                array(
                    'taxonomy' => 'bulletin_types',
                    'field' => 'id',
                    'terms' => $term->term_id,
                ),
            ),   
            'meta_query' => array(
                array(
                    'key' => '_bulletin_date',
                    'value' => date('c', strtotime( '-4 months' )),
                    'type' => 'numeric',
                    'compare' => '<='
                )
            ),
            'orderby' => 'meta_value',
            'meta_key' => '_bulletin_date',     
        );
        $bulletins = get_posts( $args );

        if ( $bulletins ) {


            foreach ( $bulletins as $bulletin ) {
                $items[] = $bulletin;
            }
        }
    }
}
// Sort the array by most recent post date
$date = array_column($items, 'post_date');
if ( $date ) }{
    array_multisort($date, SORT_DESC, $items );
}

// make sure there is only 4 items
$items = array_slice( $items, 0, $ppp );

// Check if there are at least 3 items
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
            $link = str_replace( ' ', '-', $posttype);
            $title = ucwords($posttype);
            if ( $posttype == 'bulletins') {
                $link = 'bulletins-newsletters';
                $title = 'Bulletins/Newsletters';
            }           
            echo '<a href="' . home_url() . '/' . $link . '/">' . $title . '</a>';
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

                case 'links':
                    $type = 'Link';
                    $link = get_post_meta( $post->ID, '_link_file', true );
                    break;

                case 'events':
                    $type = 'Event';
                    break;

                case 'galleries':
                    $type = 'Gallery'; 
                    $link = get_post_meta( $post->ID, '_gallery_link', true );
                    break;

                case 'bulletins':
                    $term = get_the_terms( $post->ID, 'bulletin_types' );
                    $type = $term[0]->name;
                    $link = get_post_meta( $post->ID, '_bulletin_file', true );
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