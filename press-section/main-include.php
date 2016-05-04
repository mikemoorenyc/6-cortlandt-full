<?php
function post_types_init() {

//PROPERTY
$propargs = array(
  'label' => 'Press',
  'public' => false,
  'labels' => array(
    'add_new_item' => 'Add New Press Item',
    'name' => 'Press',
    'edit_item' => 'Edit Press Item',
    'search_items' => 'Search Press',
    'not_found' => 'No press items Found.',
    'all_items' => 'All Press'
  ),
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'has_archive' => false,
  'rewrite' => array('slug' => 'press'),
  'query_var' => true,
  'menu_icon' => 'dashicons-media-document',
  'supports' => array(
      'revisions',
      'title'
    )
  );
register_post_type( 'pressitem', $propargs );
if ( ! function_exists( 'unregister_post_type' ) ) :
function unregister_post_type( $post_type ) {
    global $wp_post_types;
    if ( isset( $wp_post_types[ $post_type ] ) ) {
        unset( $wp_post_types[ $post_type ] );
        return true;
    }
    return false;
}
endif;
unregister_post_type('press');


}

add_action( 'init', 'post_types_init' );

//ADD react
function add_file_header_scripts($hook) {
  global $post;
  if(get_post_type($post) != 'pressitem') {
    return;
  }
  if ( !('post.php' == $hook || 'post-new.php' == $hook) ) {
      return;
  }
  wp_enqueue_media();
  wp_enqueue_script( 'react_main', 'https://fb.me/react-15.0.1.js' );
  wp_enqueue_script( 'react_dom', 'https://fb.me/react-dom-15.0.1.js' );
  wp_enqueue_style('main_style', get_bloginfo('template_url').'/press-section/main.css');
}
add_action( 'admin_enqueue_scripts', 'add_file_header_scripts' );



//FOOTER STUFF/

add_action('admin_footer-post.php', 'press_ui_content');
add_action('admin_footer-post-new.php', 'press_ui_content');
include 'press-bottom.php';

include 'meta-box.php';
include 'save-function.php';
?>
