<?php
function file_box() {
		add_meta_box(
			'press_box',
			"Press Entry",
			'press_box_callback',
			'pressitem',
      'normal'
		);
}
add_action( 'add_meta_boxes', 'file_box' );
function press_box_callback( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'press_data', 'press_nonce' );
  ?>
  <div id="press-entry-point"></div>
  <?php
}


?>
