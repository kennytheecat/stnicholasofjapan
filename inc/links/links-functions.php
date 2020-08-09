<?php
function add_new_links_columns($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Link Title', 'column name');
	$new_columns['link_url'] = _x('Url', 'column name');
    $new_columns['author'] = __('Author');
    $new_columns['date'] = __('Date');

    return $new_columns;
}
add_filter('manage_edit-links_columns' , 'add_new_links_columns');

function manage_links_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
    case 'link_url':
        $link = get_post_meta( get_the_ID(), '_link_file', true );
        echo '<a href="' . $link . '">' . $link . '</a>';		
            break;
 
    } // end switch
}   
add_action('manage_links_posts_custom_column', 'manage_links_columns', 10, 2);

// Register the column as sortable
function register_sortable_columns_links( $columns ) {
    $columns['link_url'] = 'link_url';

    return $columns;
}
add_filter( 'manage_edit-links_sortable_columns', 'register_sortable_columns_links' );
?>