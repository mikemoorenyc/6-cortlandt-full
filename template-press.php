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
      ?>
      <li class="press-item">
        <?php
        //Determine Link
        $readmore = get_post_meta( $p->ID, 'press-read-more-link', true )[0];
        if($readmore['link-type'] == 'upload') {
          $link = wp_get_attachment_url( $readmore['document'], 'full' );
        } else {
          $link = $readmore['external-site-url'];
        }
        ?>

          <a href="<?php echo $link;?>" target="_blank" class="thumbnail">
            <?php
            $imgURL = $siteDir.'/assets/imgs/social-poster.jpg';
            if(has_post_thumbnail($p->ID)) {
              $imgURL = wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'medium', false)[0];
            }

            ?>
        <!--  <img src="<?php echo $imgURL;?>" alt="<?php echo $p->post_title;?>"/>-->
          </a>
          <h2><?php echo $p->post_title;?></h2>
          <div class="excerpt">
            <?php echo wpautop(get_post_meta( $p->ID, 'press-excerpt', true )[0]['copy'])?>
          </div>
          <a href="<?php echo $link;?>" target="_blank" class="read-more-btn">
            Read more
          </a>



    </li>

      <?php
    }

    ?>

  </ul>
  <?php


}

?>

<?php include 'footer.php'; ?>
