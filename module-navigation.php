<nav role="navigation" id="main-navigation">

<?php
foreach($navItems as $n) {
  ?>
<a href="<?php echo $n['url'];?>" data-slug="<?php echo $n['slug'];?>"><?php echo $n['title'];?></a>
  <?php
}


//
?>



</nav>
<div id="page-sub">
  <?php
  $subs = get_post_meta( $post->ID, 'sub-nav-sections', true );
  if(empty($subs)) {
    echo "&nbsp;";
  } else {
    foreach($subs as $s) {
      $link = preg_replace("/[^A-Za-z0-9 ]/", '', $s['title']);
      $link = str_replace(" ","-",$link);
      $link = strtolower($link);

      ?>
      <button data-target="<?php echo $link;?>"><?php echo $s['title'];?></button>
      <?php
    }
  }

  ?>


</div>
