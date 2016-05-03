<div id="header">
  <h1 class="logo">
    <a href="<?php echo $homeURL;?>/">
    <span class="hide">Six Cortlandt Alley</span>
  </a>
  </h1>
  <button class="menu-open h-style">Menu</button>
<nav role="navigation" id="main-navigation">
  <button class="menu-close">
    <span class="hide">Close</span>
    <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close"></use></svg>
  </button>
  <div class="menu-list clearfix">
<?php
foreach($navItems as $n) {
  ?>
  <div class="link">
    <a href="<?php echo $n['url'];?>" data-slug="<?php echo $n['class'];?>" class="h-style"><?php echo $n['title'];?></a>
    <?php
    $subs = get_post_meta( $n['id'], 'sub-nav-sections', true );
    if(empty($subs)) {

    } else {
      echo '<div class="sub-nav">';
      foreach($subs as $s) {
        $link = preg_replace("/[^A-Za-z0-9 ]/", '', $s['title']);
        $link = str_replace(" ","-",$link);
        $link = strtolower($link);

        ?>
        <button data-target="<?php echo $link;?>"><?php echo $s['title'];?></button>
        <?php
      }
      echo '</div>';
    }

    ?>
  </div>

  <?php
}


//
?>
</div>



</nav>
<!--
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
-->
</div>
