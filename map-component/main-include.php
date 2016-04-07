<?php
//ADD IN THE MAIN MAP BOX
function main_map_box() {
  if(basename(get_page_template()) != 'template-location.php') {
    return;
  }
  add_meta_box(
		'main_map_box',
		"Map Points",
		'main_map_callback',
		'page',
    'normal'
	);
}
function main_map_callback() {
  // Add a nonce field so we can check for it later.
	wp_nonce_field( 'main_map_data', 'main_map_nonce' );
  include 'main-map-template.php';
}
//INCLUDE HEADER SCRIPTS
function add_location_header_scripts($hook) {
  global $post;
  if(basename(get_page_template()) != 'template-location.php') {
    return;
  }
  if ( !('post.php' == $hook || 'post-new.php' == $hook) ) {
      return;
  }

  wp_enqueue_script( 'react_main', 'https://fb.me/react-0.14.8.js' );
  wp_enqueue_script( 'react_dom', 'https://fb.me/react-dom-0.14.8.js' );
  wp_enqueue_style('main_style', get_bloginfo('template_url').'/map-component/main.css');


}
add_action( 'admin_enqueue_scripts', 'add_location_header_scripts' );

add_action( 'add_meta_boxes', 'main_map_box' );

//LOAD FOOTER STUFF
add_action('admin_footer-post.php', 'location_bottom_scripts'); // Fired on post edit page
add_action('admin_footer-post-new.php', 'location_bottom_scripts'); // Fired on add new post page
function location_bottom_scripts() {
  if(basename(get_page_template()) != 'template-location.php') {
    return;
  }
  include 'location-bottom.php';

}




?>
