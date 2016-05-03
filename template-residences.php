<?php
/**
 * Template Name: Residences Page
 */
?>
<?php include 'header.php'; ?>
<div id="residences">

<div class="top-section">
  <div id="living-spaces" data-anchor="living-spaces">
    <?php
    $ls = get_post_meta( $post->ID, 'living-spaces', true );
    $ls = $ls[0];
    $limg= wp_get_attachment_image_src($ls['image'], 'fixed-1200', true);
    $limg = $limg[0];
    ?>


    <div class="section">
      <img src="<?php echo $limg;?>" class="intro-img"/>
      <h1 class="h-style liner"><?php echo $ls['title'];?></h2>
      <div class="copy smaller"><?php echo $ls['copy'];?></div>

    </div>


  </div>

  <div id="handcrafted-elements">
    <?php
    $he = get_post_meta( $post->ID, 'handcrafted-elements', true );
    $he = $he[0];
    $limg= wp_get_attachment_image_src($he['left-image'], 'fixed-1200', true);
    $limg = $limg[0];
    $rimg= wp_get_attachment_image_src($he['right-image'], 'fixed-1200', true);
    $rimg = $rimg[0];
    ?>

    <div class="section clearfix">
      <img src="<?php echo $limg;?>" class="limg" />
      <div class="title h-style"><?php echo $he['title'];?></div>
      <img src="<?php echo $rimg;?>" class="rimg" />


    </div>
  </div>

  <div id="kitchens" data-anchor="kitchens">
    <?php
    $ls = get_post_meta( $post->ID, 'kitchens', true );
    $ls = $ls[0];
    $limg= wp_get_attachment_image_src($ls['image'], 'fixed-1200', true);
    $limg = $limg[0];
    ?>

    <img src="<?php echo $limg;?>" class="intro-img"/>
    <div class="section">

      <h1 class="h-style liner"><?php echo $ls['title'];?></h2>
      <div class="copy smaller"><?php echo $ls['copy'];?></div>

    </div>


  </div>




  <div class="side-tag h-style">Generous Proportions</div>

</div>

<div id="bath-section" data-anchor="master-bath">
  <?php
  $ls = get_post_meta( $post->ID, 'bath-section', true );
  $ls = $ls[0];
  $limg= wp_get_attachment_image_src($ls['hero-image'], 'fixed-1200', true);
  $limg = $limg[0];



  ?>
  <div class="top clearfix">
    <h1 class="h-style"><?php echo $ls['headline'];?></h1>
    <img src="<?php echo $limg;?>" alt="<?php echo $ls['title'];?>" class="intro-img" />

  </div>

  <div class="bottom clearfix">
    <div class="section">
      <h2 class="h-style liner"><?php echo $ls['title'];?></h2>
      <div class="copy smaller"><?php echo $ls['copy'];?></div>

    </div>
      <?php
      $limg= wp_get_attachment_image_src($ls['bottom-image'], 'fixed-1200', true);
      $limg = $limg[0];
      ?>
      <img src="<?php echo $limg;?>" class="bottom-img" alt="<?php echo $ls['title'];?>" />


  </div>



</div>

<div id="master-bedrooms" data-anchor="bedrooms" class="clearfix">
<?php
$ls = get_post_meta( $post->ID, 'master-bedrooms', true );
$ls = $ls[0];
$limg= wp_get_attachment_image_src($ls['hero-image'], 'fixed-1200', true);
$limg = $limg[0];


?>
<img src="<?php echo $limg;?>" alt="<?php echo $ls['title'];?>" class="intro-img" />
<div class="section">
  <h2 class="h-style liner"><?php echo $ls['title'];?></h2>
  <div class="copy smaller"><?php echo $ls['copy'];?></div>

  <h1 class="h-style"><?php echo $ls['headline'];?></h1>

</div>

</div>

<div id="home-office" data-anchor="home-office">
  <?php
  $ls = get_post_meta( $post->ID, 'home-office', true );
  $ls = $ls[0];
  $limg= wp_get_attachment_image_src($ls['hero-image'], 'fixed-1200', true);
  $limg = $limg[0];


  ?>
  <img src="<?php echo $limg;?>" alt="<?php echo $ls['title'];?>" class="intro-img" />
  <div class="section">
    <h2 class="h-style liner"><?php echo $ls['title'];?></h2>
    <div class="copy smaller"><?php echo $ls['copy'];?></div>

  </div>


</div>







</div>


<?php include 'footer.php'; ?>
