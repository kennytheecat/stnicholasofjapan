(function( $ ) {
    'use strict';
 
    $(function() {

        var trs = document.getElementsByClassName('buttonSelect'),
        i,
        len;

        for (i = 0, len = trs.length; i < len; i += 1) {

            trs[i].onclick = getPartId;

        } 

        function getPartId() {
            var fileID = this.id;
            renderMediaUploader( $, fileID );
        } 
        
    });
 
})( jQuery );

/**
 * Callback function for the 'click' event of the 'Set Footer Image'
 * anchor in its meta box.
 *
 * Displays the media uploader for selecting an image.
 *
 * @since 0.1.0
 */
function renderMediaUploader( $, fileID ) {
    'use strict';
     
    var file_frame, image_data, json;
 
    /**
     * If an instance of file_frame already exists, then we can open it
     * rather than creating a new instance.
     */
    if ( undefined !== file_frame ) {
 
        file_frame.open();
        return;
 
    }
 
    /**
     * If we're this far, then an instance does not exist, so we need to
     * create our own.
     *
     * Here, use the wp.media library to define the settings of the Media
     * Uploader. We're opting to use the 'post' frame which is a template
     * defined in WordPress core and are initializing the file frame
     * with the 'insert' state.
     *
     * We're also not allowing the user to select more than one image.
     */
    file_frame = wp.media.frames.file_frame = wp.media({
        frame:    'post',
        state:    'insert',
        multiple: false
    });
 
    /**
     * Setup an event handler for what to do when an image has been
     * selected.
     *
     * Since we're using the 'view' state when initializing
     * the file_frame, we need to make sure that the handler is attached
     * to the insert event.
     */

        
   
    
    file_frame.on( 'insert', function() {

        // Read the JSON data returned from the Media Uploader
        json = file_frame.state().get( 'selection' ).first().toJSON();

        // First, make sure that we have the URL of an image to display
        if ( 0 > $.trim( json.url.length ) ) {
            return;
        }
					
        var filename;
        var str1 = '#bulletin_';
        filename = str1.concat( fileID );

        // Store the image's information into the meta data fields
        $( filename ).attr('value', json.url );
        
        
    });
 
    // Now display the actual file_frame
    file_frame.open();
}