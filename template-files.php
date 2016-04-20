<?php
/**
 * Template Name: Files
 */
?>


<?php include 'header.php'; ?>

<ul id="files-list" class="no-style">
<?php
$args = array(
    'post_type' 		=> 'file',
    'orderby' 			=> 'date',
    'order' 			=> 'ASC',
    'posts_per_page' => -1
  );
$files_in_cat_query = new WP_Query($args);
if ( $files_in_cat_query->have_posts() ) {
$files = $files_in_cat_query->get_posts();
foreach($files as $f) {
  $finfo = json_decode(get_post_meta($f->ID, 'file_info', true));

  if(has_post_thumbnail($f->ID) ) {

    $imgSrc = wp_get_attachment_image_src(get_post_thumbnail_id($f->ID), 'medium', false);
    $imgSrc = $imgSrc[0];
    $img = 'style=" background-image:url('.$imgSrc.');"';

  } else {
    $img = '';
  }
  ?>
  <li>
<a href="#" target="_blank" <?php echo $img;?>>



  <div class="overlay" style="background-color: <?php echo $finfo->color;?>;">
    <span class="title text-overflow"><?php echo $f->post_title;?></span>
  </div>


</a>
</li>
  <?php
}

}


 ?>



</ul>

<?php include 'footer.php'; ?>
