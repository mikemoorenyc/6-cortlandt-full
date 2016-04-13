<?php

function file_box() {

		add_meta_box(
			'file_box',
			"Files",
			'file_box_callback',
			'file',
      'normal'
		);

}
add_action( 'add_meta_boxes', 'file_box' );
function file_box_callback( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'file_data', 'file_nonce' );

  ?>
  <div id="file-entry-point"></div>
  <?php
}
function add_file_header_scripts($hook) {
  global $post;
  if(get_post_type($post) != 'file') {
    return;
  }
  if ( !('post.php' == $hook || 'post-new.php' == $hook) ) {
      return;
  }
  wp_enqueue_script( 'react_main', 'https://fb.me/react-15.0.1.js' );
  wp_enqueue_script( 'react_dom', 'https://fb.me/react-dom-15.0.1.js' );
  wp_enqueue_style('main_style', get_bloginfo('template_url').'/file-repo/main.css');
}
add_action( 'admin_enqueue_scripts', 'add_file_header_scripts' );

add_action('admin_footer-post.php', 'file_bottom_scripts'); // Fired on post edit page
add_action('admin_footer-post-new.php', 'file_bottom_scripts'); // Fired on add new post page

function file_bottom_scripts() {
  global $post;
  if(get_post_type($post) != 'file') {
    return;
  }
	$fileJSON = get_post_meta($post->ID, 'file_info', true);

	if(empty($fileJSON)) {
		$fileJSON = '{state: "empty"}';
	}

	//GET USERS
	$userArray = array();
	$userIDs = get_users( array( 'fields' => array( 'ID' ) ) );

	foreach($userIDs as $u) {

		$userObj = array();
		$userObj['id'] = $u->ID;
		$info = get_userdata($u->ID);
		if(empty($info->last_name) || empty($info->first_name)) {
			$userObj['lastName'] = $info->user_login;
			$userObj['firstName'] = false;
		} else {
			$userObj['lastName'] = $info->last_name;
			$userObj['firstName'] = $info->first_name;
		}
		$groups = get_the_author_meta( '_pgroups', $u->ID);

		if(empty($groups)) {
			$groups = false;
		} else {
			$groups = explode(",", $groups);
		}


		$userObj['groups'] = $groups;
		array_push($userArray,$userObj);

	}

	//GET CURRENTLY SELECTED CATEGORIES
	$groups = get_the_terms ( $post->ID, 'pgroup');

	$groupArray = '[';
	$looper = 0;
	foreach($groups as $g) {
		if($looper >0) {
			$groupArray = $groupArray.',';
		}
		$groupArray = $groupArray.$g->term_id;
		$looper++;
	}
	$groupArray = $groupArray.']';


	//GET SELECTED USERS
	$selectedUsers = get_post_meta($post->ID, 'selected_users', true);
	if(empty($selectedUsers)) {
		$selectedUsers = '[]';
	}
  ?>

  <script>
  var APP = {
    siteDir : '<?php echo get_bloginfo('template_url');?>',
		fileID: <?php echo $post->ID;?>,
		file: <?php echo $fileJSON;?>,
		userList : <?php echo json_encode($userArray);?>,
		selectedGroups : <?php echo $groupArray;?>,
		selectedUsers : <?php echo $selectedUsers;?>
  }


  </script>
  <script src="<?php echo get_bloginfo('template_url');?>/file-repo/build.js"></script>
<script>
ReactDOM.render(React.createElement(MainFileComponent, null), document.getElementById('file-entry-point'));
</script>
<?php
}
