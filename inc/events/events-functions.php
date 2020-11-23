<?php
add_filter( 'manage_edit-locations_columns', 'locations_edit_term_columns' );

function locations_edit_term_columns( $columns ) {

    $columns['address'] = __( 'Address', 'jt' );

    return $columns;
}

add_filter( 'manage_locations_custom_column', 'locations_term_custom_column', 10, 3 );

function locations_term_custom_column( $out, $column, $term_id ) {

    if ( 'address' === $column ) {

		global $location_meta;  
		foreach ( $location_meta as $meta ) { 

			$value =  get_term_meta( $term_id, $meta, true );

			if ( ! $value )
				$value = '';

			$address_line[$meta] = $value;	
		}

		$address_final = $address_line['address'] . ', ' . $address_line['city'] . ', ' . $address_line['state'];

		$out = sprintf( '<span class="address-block">%s</span>', esc_attr( $address_final ) );
		
	}
	
    return $out;
}
?>