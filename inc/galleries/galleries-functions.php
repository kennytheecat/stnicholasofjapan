<?php
function add_new_galleries_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Gallery Name', 'column name');
	$new_columns['gallery_link'] = _x('Gallery Link', 'column name');
    $new_columns['author'] = __('Author');
      
    return $new_columns;
}
add_filter('manage_edit-galleries_columns' , 'add_new_galleries_columns');

function manage_galleries_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
    case 'gallery_link':
        $link = get_post_meta( get_the_ID(), '_gallery_link', true );
        echo '<a href="' . $link . '">' . $link . '</a>';		
            break;
 
    } // end switch
}   
add_action('manage_galleries_posts_custom_column', 'manage_galleries_columns', 10, 2);

// Register the column as sortable
function register_sortable_columns_galleries( $columns ) {
    $columns['gallery_link'] = 'gallery_link';

    return $columns;
}
add_filter( 'manage_edit-galleries_sortable_columns', 'register_sortable_columns_galleries' );
?>