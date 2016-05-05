<?php

add_filter('admin_init', 'map_image_setting');

function map_image_setting() {
  wp_enqueue_media();
  register_setting('general', 'main_map_image', 'esc_attr');
  add_settings_field('main_map_image', '<label for="main_map_image">'.__('Legal PDF' , 'main_map_image' ).'</label>' , 'map_image_selector', 'general');
}

function map_image_selector() {

  $value = get_option( 'main_map_image', '' );
  if(empty($value)) {
    $verb = 'Upload';
    $smimg = '';
    $jv = '';
  } else {
    $verb = 'Change';
    $smimg = wp_get_attachment_url( $value );
    $smimg = $smimg;
    $jv = $value;
  }
    ?>
    <div id="map-thumb" style="margin-bottom: 10px;">

    </div>
    <input type="hidden" id="main_map_image" name="main_map_image" value="<?php echo $value;?>" class="regular-text"/ >
    <button id="map-image-opener" class="button"><?php echo $verb;?> Legal PDF</button>

    <script>
    jQuery(document).ready(function($){

      function stateUpdater(id,url) {
        if(id) {
          $('#map-image-opener').text('Change Legal PDF');
        } else {
          $('#map-image-opener').text('Add Legal PDF');
        }
        $('input#main_map_image').val(id);
        if(url) {
          var fileName = url.replace(/^.*[\\\/]/, '')
          $('#map-thumb').html('<span class="filename">'+fileName+'</span>').show();
        } else {
          $('#map-thumb').hide();
        }
      }
      stateUpdater('<?php echo $jv;?>', '<?php echo $smimg;?>');
      $('#map-image-opener').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Select or Upload a Legal PDF',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image

            var theurl;
            theurl = uploaded_image.attributes.url;
            var image_url = uploaded_image.toJSON().url;
            stateUpdater(uploaded_image.id, theurl);
            // Let's assign the url value to the input field
            //$('#image_url').val(image_url);
        });
      });
    });

    </script>
    <?php

}

?>
