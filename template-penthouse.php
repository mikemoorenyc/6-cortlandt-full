<?php
/**
 * Template Name: Penthouse Page
 */
?>


<?php include 'header.php'; ?>
<div id="penthouse-top">
<?php

$contactcopy = get_post_meta( $post->ID, 'penthouse-top-copy', true );
$ptop = $contactcopy[0];
?>
<h1 class="h-style"><?php echo wpautop($ptop['headline']);?></h1>
<div class="copy">
  <?php echo $ptop['copy'];?>
</div>



</div>

<div id="penthouse-img">
<?php
$introimg = wp_get_attachment_image_src($ptop['image'], 'fixed-1200', true);
$introimg = $introimg[0];

?>
<img src="<?php echo $introimg;?>" alt="Penthouse View" />

  <div class="side-tag h-style">Open City Views</div>
</div>

<ul id="penthouse-items" class="clearfix no-style">
  <?php
  $pitems = get_post_meta( $post->ID, 'penthouse-items', true );
  foreach($pitems as $p) {
    ?>
    <li>
      <?php
      $icon = 'pha-icon.svg';
      $slug = strtolower($p['title']);
      if($slug == 'penthouse b') {
        $icon = 'phb-icon.svg';
      }

      ?>
      <img class="icon" src="<?php echo $siteDir;?>/assets/imgs/<?php echo $icon;?>" alt="<?php echo $p['title'];?>" />
      <h2 class="h-style liner"><?php echo $p['title'];?></h2>
      <div class="copy smaller"><?php echo $p['copy'];?></div>
      <?php
      if(!empty($p['floorplan-download'])) {
        $btnText = 'View Floor Plan';
        if(!empty($p['button-text'])) {
          $btnText = $p['button-text'];
        }
        ?>
        <a class="read-more h-style" href="<?php echo wp_get_attachment_url( $p['floorplan-download']);?>" target="_blank"><?php echo $btnText;?></a>
        <?php
      }

      ?>

    </li>

    <?php
  }
  ?>

</ul>

<?php include 'footer.php'; ?>
