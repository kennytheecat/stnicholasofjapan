<?php
function add_new_sermons_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
     
		$new_columns['title'] = _x('Gallery Name', 'column name');
		
    $new_columns['sermon_date'] = _x('Sermon Date', 'column name');
    $new_columns['author'] = __('Author');
     
 
    return $new_columns;
}
add_filter('manage_edit-sermons_columns' , 'add_new_sermons_columns');

add_action('manage_sermons_posts_custom_column', 'manage_sermons_columns', 10, 2);
function manage_sermons_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
    case 'sermon_date':
        echo get_post_meta( get_the_ID(), '_podox_sermon_date', 1 );		
            break;
 
    } // end switch
}   

// Register the column as sortable
function register_sortable_columns_sermons( $columns ) {
    $columns['sermon_date'] = 'sermon_date';

    return $columns;
}
add_filter( 'manage_edit-sermons_sortable_columns', 'register_sortable_columns_sermons' );
?>