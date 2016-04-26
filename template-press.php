<?php
/**
 * Template Name: Press Page
 */
?>


<?php include 'header.php'; ?>

<?php
$args = array(
    'post_type' 		=> 'press',
    'posts_per_page' => -1
  );
$files_in_cat_query = new WP_Query($args);
if ( $files_in_cat_query->have_posts() ) {
$press = $files_in_cat_query->get_posts();
  ?>
  <ul id="press-list" class="no-style">

    <?php
    foreach($press as $p) {
      $obj= json_decode(get_post_meta($p->ID, 'press_data', true));
      //GET THE LINK
      if($obj->linkType == 'external') {
        $url = $obj->linkURL;
      } else {
        $url = wp_get_attachment_url( $obj->linkID, 'full' );
      }
      if(empty($obj->imgID)) {
        $imgURL = $siteDir.'/assets/imgs/press-fallback.jpg';
      } else {
        $imgURL = wp_get_attachment_image_src($obj->imgID, 'medium', false);
        $imgURL = $imgURL[0];
      }
      ?>
      <li class="press-item" >

        <div class="poster" style="width:200px; height:200px; background-image:url(<?php echo $imgURL;?>);"></div>


        <h2><?php echo $p->post_title;?></h2>
        <p class="excerpt">
          <?php echo $obj->excerpt;?>
        </p>
        <span class="read-more">Read More</span>
        <a href="<?php echo $url;?>" target="_blank" class="cover"></a>
      </li>

      <?php
    }

    ?>

  </ul>
  <?php


}

?>

<?php include 'footer.php'; ?>
