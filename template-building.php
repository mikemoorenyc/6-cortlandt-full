<?php
/**
 * Template Name: Building Page
 */
?>
<?php include 'header.php'; ?>


<div id="home-header" class="clearfix">
<?php

$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fake-full', true);
$thumb = $thumb[0];
$introcopy = get_post_meta( $post->ID, 'home-intro-line', true );
$introcopy = $introcopy[0]['text'];
?>
<div class="img-container">
  <div class="inner">
    <img src="<?php echo $thumb;?>" />
  </div>

</div>


<h1 class="h-style">
  <span class="copy"><?php echo $introcopy;?></span>
  <a href="#" class="go-down">
    <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrows"></use></svg>
  </a>
</h1>

</div>

<div id="building-intro" >
<?php
$intro = get_post_meta( $post->ID, 'home-top-section', true );
$intro = $intro[0];
$introimg = wp_get_attachment_image_src($intro['image'], 'fake-full', true);
$introimg = $introimg[0];
?>

<h1 class="h-style"><?php echo $intro['intro-line'];?></h1>

<div class="top-copy">
  <?php echo $intro['top-copy'];?>
</div>
<img src="<?php echo $introimg;?>" alt="6 Cortlandt Alley"/>

<div class="bottom-copy">
<?php echo $intro['bottom-copy'];?>

</div>

  <div class="side-tag h-style">SIX CORTLANDT ALLEY</div>
</div>


<div id="amenities-section" data-anchor="amenities">
  <?php
  $amenintro = get_post_meta( $post->ID, 'amenties-intro', true );
  $amenintro = $amenintro[0];
  ?>
  <h1 class="h-style"><?php echo $amenintro['intro-line'];?></h1>
  <div class="copy"><?php echo $amenintro['copy'];?></div>
  <ul id="amen-list" class="no-style clearfix">
    <?php
    $amenlist = get_post_meta( $post->ID, 'amen-list', true );

    foreach($amenlist as $a) {
      $title = explode(" ", $a['title']);
      $looper = 0;
      ?>
      <li>
      <h1 class="h-style">
        <?php
        foreach($title as $t) {
          if($looper < 2) {
            if($looper > 0) {
              echo ' <br/>';
            }
            echo $t;
            $looper++;
          }

        }


        ?>

      </h1>
      <div class="copy">
        <?php
        if(strlen($a['copy']) < 145) {

          $noheight = 'all-content';
          $readmore = '';
        } else {
          $noheight = '';
          $readmore = '<a href="#" class="read-more h-style">Read More</a>';

          }
          ?>
          <div class="copy-box <?php echo $noheight;?>">
            <div class="inner">
              <?php echo $a['copy'];?>
            </div>
          </div>

          <?php echo $readmore;?>

          <?php




        ?>


      </div>
      </li>
      <?php
    }

    ?>


  </ul>

</div>

<div id="history-section" data-anchor="history">

  <div class="hero">
      <?php
      $hishero = get_post_meta( $post->ID, 'history-hero-image', true );
      $hishero = $hishero[0];
      $introimg = wp_get_attachment_image_src($hishero['image'], 'fixed-1200', true);
      $introimg = $introimg[0];


      ?>
      <img src="<?php echo $introimg;?>" alt="History" />
  </div>
  <ul id="history-list" class="clearfix no-style">
  <?php
$hislist = get_post_meta( $post->ID, 'history-items', true );
$looper = 0;
foreach($hislist as $hl) {
  if ($looper % 2 == 0) {
    $sideClass = 'even';
  } else {
    $sideClass = 'odd';
  }
  ?>
  <li class="<?php echo $sideClass;?>" data-side="<?php echo $sideClass;?>">
    <div class="aside">
      <div class="inner">
        <?php
        if(empty($hl['image'])) {
          ?>
          <h2 class="h-style"><?php echo $hl['side-copy'];?></h2>
          <?php
        } else {
          $img = wp_get_attachment_image_src($hl['image'], 'medium', true);
          $imgSrc = $img[0];

          if($img[1] <= $img[2]) {
            $portraitClass = 'portrait';
          }
          ?>
          <img src="<?php echo $imgSrc;?>" class="<?php echo $portraitClass;?>" alt="<?php echo $hl['side-copy'];?>" />
          <div class="side-copy"><?php echo $hl['side-copy'];?></div>
          <?php


        }



        ?>

      </div>
    </div>

    <div class="copy">
      <?php echo $hl['copy'];?>
    </div>



  </li>


  <?php

$looper++;
}



  ?>

</ul>

</div>


<?php include 'footer.php'; ?>
