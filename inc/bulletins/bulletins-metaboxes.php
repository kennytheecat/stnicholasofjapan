<?php
/*
Plugin Name: Custom Meta Box Template
Plugin URI: http://themefoundation.com/
Description: Provides a starting point for creating custom meta boxes.
Author: Theme Foundation
Version: 1.0
Author URI: http://themefoundation.com/
Source: // https://github.com/themefoundation/custom-meta-box-template/blob/master/custom-meta-box-template.php
*/


function displayBulletinList( $results ) { 

global $post;
// Get WordPress' media upload URL
$upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

// See if there's a media id already saved as post meta
$your_img_id = get_post_meta( $post->ID, '_your_img_id', true );

// Get the image src
$your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );

// For convenience, see if the array is valid
$you_have_img = is_array( $your_img_src );

	if ($results) { ?>
			<table>
				<tr>
					<th>Date</th>
					<th>Name</th>
					<th>Upload</th>
				</tr>
		<?php
	foreach ( $results as $result ) {
		
		if ( $result ) { 
			
			$bulletin_id = $result['bulletin_id'];
			$date = $result['date'];
			$name = $result['name'];
			$file = $result['file'];
			?>		
			<tr id="bulletin_<?php echo $bulletin_id; ?>">
				<td>
					<input type="hidden" name="bulletin_ids[]" value="<?php echo $bulletin_id; ?>">
					<input type="date" name="bulletin_<?php echo $bulletin_id; ?>[date]" value="<?php echo $date; ?>">
				</td>
				<td>
					<input type="text" name="bulletin_<?php echo $bulletin_id; ?>[name]" value="<?php echo $name; ?>">
				</td>
				<!--
				<td>
					<input type="file" name="bulletin_<?php echo $bulletin_id; ?>[file]" value="<?php echo $name; ?>">
				</td>
				-->
				<td colspan="2">
                    <input type="text" name="bulletin_<?php echo $bulletin_id; ?>[file]" id="bulletin_<?php echo $bulletin_id; ?>_file" value="<?php if ( isset ( $file) ) echo $file; ?>" />
					<input type="button" id="<?php echo $bulletin_id; ?>_file" class="meta-image-button buttonSelect" value="Upload File" />       
				</td>	

			</tr>
	<?php		
			}
		} ?>
	</table>   
                                      
<?php	
	}				
}

/**
 * Adds a meta box to the post editing screen
 */
function bulletins_meta() {
	global $post;
	if ( $post->ID == 235 ) {
		add_meta_box( 'bulletins_meta', __( 'Bulletins', 'cop-textdomain' ), 'bulletins_callback' );
	}
}
add_action( 'add_meta_boxes', 'bulletins_meta' );
/**
 * Outputs the content of the meta box
 */
function bulletins_callback( $post ) {

	global $wpdb;
	$bulletin_term = $post->ID;
	
	wp_nonce_field( basename( __FILE__ ), 'cop_bulletin_nonce' );

	$bulletin_naming = get_option( 'bulletin_naming' );
	?>
<section class="bulletin-naming-meyabox">
	<h2>Choose Default Naming Convention</h2>

	<?php 
	$values = array( 
		'F jS, Y'	=>	'January 1st, 2020',
		'M d, Y'	=>	'Jan 01, 2020',
		'm-d-Y'	=>	'01/01/2020',
		'm/d/Y'	=>	'01-01-2020'
	);

	foreach ( $values as $key => $value ) { ?>
	<input type="radio" name="bulletin_naming" id="bulletin_naming" value="<?php echo $key; ?>" <?php if ( $bulletin_naming == $key ) { echo ' checked'; } ?>><?php echo $value; ?>
	<?php } ?>
</section>
<hr />

<section class="bulletins-metabox">
	<div class="add-bulletin">
		<h2>Add Bulletin</h2>
		<?php
	
		
		$results = array (
			 array ( 'bulletin_id' => 'new',  'date' => '', 'file' => ''),
			);
		displayBulletinList( $results ); ?>
	</div>
	
	<div class="bulletin-list past">
		<h2>Bulletin List (Past)</h2>
		<?php
		$results = $wpdb->get_results( "SELECT * FROM bulletins ORDER BY date DESC", ARRAY_A );
		
		displayBulletinList( $results );

		?>			
	</div>	
	</section>
	<?php
}
/**
 * Saves the custom meta input
 */
function cop_meta_save( $post_id ) {
	global $wpdb;
		
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'cop_bulletin_nonce' ] ) && wp_verify_nonce( $_POST[ 'cop_bulletin_nonce' ], basename( __FILE__ ) ) ) ? true : false;
 
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}
	
	
	if( isset( $_POST[ 'bulletin_naming' ] ) ) {
		update_option('bulletin_naming', $_POST[ 'bulletin_naming' ] );
	}

 if( isset( $_POST[ 'bulletin_ids' ] ) ) {
	foreach ( $_POST[ 'bulletin_ids' ] as $bulletin_id ) {
			$bulletin = $_POST[ "bulletin_" . $bulletin_id . "" ];
			$bulletin_date = $bulletin['date'];
			$bulletin_name = $bulletin['name'];
            
			if ( $bulletin['file'] ) {			
				$bulletin_file = $bulletin['file'];
				$bulletin_file = str_replace( home_url(), "", $bulletin_file );
			} else { $bulletin_file = ''; }
				        
			$status = 'update';
			if ( $bulletin_id == 'new') {
				
				if ( !empty($bulletin_date) ) {
				$status = 'insert';
				
					$wpdb->insert( 
						'bulletins',
						array( 
							'date' => $bulletin_date,
							'name' => $bulletin_name,
							'file' => $bulletin_file,
						),  
						array( 
							'%s', '%s', '%s', 
						)
					);	
					$bulletin_id = $wpdb->insert_id;
						
				}
			} else {
				$wpdb->update( 
					'bulletins',
					array( 
						'date' => $bulletin_date,
						'name' => $bulletin_name,
						'file' => $bulletin_file,
					), 
					array( 'bulletin_id' => $bulletin_id ), 
					array( 
						'%s', '%s', '%s', ),
					array( '%d' )
				);			
				

			}
		}	
	}
}

add_action( 'save_post', 'cop_meta_save' );


/**
 * Loads the image management javascript
 */
function cop_image_enqueue() {
	//global $typenow;
	//if( $typenow == 'bulletin' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'meta-box-image', get_template_directory_uri() . '/inc/bulletins/meta-box-image.js', array( 'jquery' ) );
		wp_localize_script( 'meta-box-image', 'meta_image',
			array(
				'title' => __( 'Choose or Upload an Image', 'cop-textdomain' ),
				'button' => __( 'Use this image', 'cop-textdomain' ),
			)
		);
		wp_enqueue_script( 'meta-box-image' );
	//}
}
add_action( 'admin_enqueue_scripts', 'cop_image_enqueue' );
?>