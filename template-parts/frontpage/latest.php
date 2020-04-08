<?php
$args = array( 
    'posts_per_page'    => 4, 
    'status'            => 'publish',
    'post_type'         => array('post', 'sermons', 'events', 'galleries', 'documents' ),
);
$items = get_posts( $args );

//Check for weekly bulletin
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM bulletins WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ORDER BY date DESC");

foreach ($results as $result) {
    $result->post_date = $result->date;
    $result->post_title = $result->date;
    $result->post_type = 'bulletin';
    $items[] = $result;
}

$date = array_column($items, 'post_date');
array_multisort($date, SORT_DESC, $items );
$items = array_slice( $items, 0, 4 );

?>
<section class="latest">
    <div class="wrapper">
        <h3>The Latest From Our Parish</h3>
        <p class="more">More <a href="<?php echo home_url(); ?>/articles/">Articles</a> \ <a href="<?php echo home_url(); ?>/sermons/">Sermons</a> \ <a href="<?php echo home_url(); ?>/events/">Events</a> \ <a href="<?php echo home_url(); ?>/galleries/">Galleries</a> >></p>

        <?php 
        foreach ( $items as $post ) : setup_postdata( $post ); 

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
                    break;                    

                default:
                $type = 'Article';
        }
        ?>
        
        <div class="spotlight">
            <?php 
            if ( $type == 'Bulletin') {
                $link = home_url() . $post->file;
            } else {
                $link = get_the_permalink();
            }        
            ?>
                
            <a href="<?php echo $link; ?>">        
            <div class="type-wrapper">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(); 
                } else {
                    $images = get_option( 'settings');
                    $image = $images['default_image_' . $post->post_type . '_id'];
                    echo wp_get_attachment_image( $image ); 
                }               
                ?>
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


<?php wp_reset_postdata(); ?>