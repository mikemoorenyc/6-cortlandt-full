<?php
/**
 * Template Name: Press Page
 */
?>


<?php include 'header.php'; ?>
<div id="press-section">
  <h1 class="h-style"><?php echo apply_filters('the_excerpt', get_post_field('post_excerpt', $post_id));?></h1>
    <ul id="press-list" class="no-style">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' 		=> 'pressitem',
    'posts_per_page' => 1,
    'paged' => $paged
  );
query_posts($args);
while ( have_posts() ) : the_post();
  $obj= json_decode(get_post_meta(get_the_ID(), 'press_data', true));
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
  //SPLIT THE TITLE
  $tl = strlen(get_the_title().' ');
  $smaller = floor($tl/2);
  $bigger = ceil($tl/2);
  $first = '';
  $last = '';

  $ex = explode(' ',get_the_title());
  foreach($ex as $e) {
    if(strlen($first) <= $bigger) {
      $first .= $e.' ';
    } else {
      $last .= $e.' ';
    }
  }
  ?>
  <li class="press-item" >
    <div class="poster" style="background-image:url(<?php echo $imgURL;?>);"></div>
    <h2 class="h-style liner"><?php echo $first.'<br/>'.$last;?></h2>
    <div class="excerpt">
      <?php echo $obj->excerpt;?>
    </div>
    <span class="read-more h-style">Read More</span>
    <a href="<?php echo $url;?>" target="_blank" class="cover"></a>

  </li>
  <?php
    /*
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

        <div class="poster" style="background-image:url(<?php echo $imgURL;?>);"></div>

        <?php
        //Split Title
        $tl = strlen($p->post_title.' ');
        $smaller = floor($tl/2);
        $bigger = ceil($tl/2);
        $first = '';
        $last = '';

        $ex = explode(' ',$p->post_title);
        foreach($ex as $e) {
          if(strlen($first) <= $bigger) {
            $first .= $e.' ';
          } else {
            $last .= $e.' ';
          }
        }

         ?>
        <h2 class="h-style liner"><?php echo $first.'<br/>'.$last;?></h2>
        <div class="excerpt">
          <?php echo $obj->excerpt;?>
        </div>
        <span class="read-more h-style">Read More</span>
        <a href="<?php echo $url;?>" target="_blank" class="cover"></a>
      </li>

      <?php
      */


?>


<?Php
endwhile;


?>
</ul>

  <?php

  $older = get_next_posts_link();

  if(!empty($older)) {
    ?>
    <div class="more-posts-container">
    <a class="more-posts full-button h-style" href="<?php echo $homeURL.'/presspage/page/'.($paged+1).'/';?>">More Posts</a>
    </div>
    <?php
  } else {
    ?>
    <div class="more-posts-container empty">

    </div>
    <?php
  }


   ?>


</div>
<?php include 'footer.php'; ?>
