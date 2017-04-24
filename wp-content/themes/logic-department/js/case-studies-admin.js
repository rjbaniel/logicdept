/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
 
    // Runs when the image button is clicked.
    $('#ld-case-study-images-button').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' },
            multiple: true
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachments = meta_image_frame.state().get('selection').toJSON();
            var image_ids = '';
            media_attachments.forEach(function(object, index) {
                if ( index === 0 ) {
                    new_value_string = object.id;
                } else {
                    new_value_string += ', ' + object.id;
                }
            });
            // Sends the attachment URL to our custom image input field.
            $('#ld-case-study-images').val(new_value_string);
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
    });
});