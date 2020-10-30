<?php
function set_bulletin_title( $data, $postarr ) {
    // Check for the custom post type and it's status
    // We only need to modify it when it's going to be published
    if ( $data['post_type'] != 'bulletins' ) { return $data; }
    if ( $data['post_status'] != 'publish' ) { return $data; }

      $post_date = $_POST['bulletin_date'];
      
      $data['post_title'] = $data['post_title'] == false ? $post_date : $data['post_title'];
         
    return $data;
}
add_filter( 'wp_insert_post_data' , 'set_bulletin_title' , 99, 2 );
?>