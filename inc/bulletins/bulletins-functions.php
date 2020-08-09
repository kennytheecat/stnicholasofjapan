<?php
function set_bulletin_title( $data , $postarr ) {
    if($data['post_type'] == 'bulletins') {
      $post_date = get_post_meta($postarr['ID'],'_bulletin_date',true);
      //$event_venue = get_post_meta($postarr['ID'], 'venue_name' , true);
      //$event_title = $event_venue . ' - ' . $event_date;
      //$post_slug = sanitize_title_with_dashes ($event_title,'','save');
      //$post_slugsan = sanitize_title($post_slug);
      $data['post_title'] = $data['post_title'] == '' ? $post_date : $data['post_title'];

      //$data['post_title'] = $post_date;
      //$data['post_name'] = $post_slugsan;
      echo "<script>console.log('" . json_encode($data) . "');</script>";
    }
    return $data;
}
add_filter( 'wp_insert_post_data' , 'set_bulletin_title' , 99, 2 );
?>