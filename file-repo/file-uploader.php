<?php
require_once('../../../../wp-blog-header.php');
$fileAllowed = true;
if(!is_user_logged_in ()) {
  $fileAllowed = false;
}



if($fileAllowed) {
  var_dump(file_get_contents('php://input'));
}

 ?>
