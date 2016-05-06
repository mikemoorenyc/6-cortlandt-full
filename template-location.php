<?php
/**
 * Template Name: Location Page
 */
?>


<?php include 'header.php'; ?>
<div id="location-top">
<?php

$contactcopy = get_post_meta( $post->ID, 'tribeca-copy', true );
$loc = $contactcopy[0];
?>

<h1 class="h-style"><?php echo wpautop($loc['headline']);?></h1>
<div class="copy"><?php echo $loc['copy'];?></div>

</div>
<?php
function slugMaker($fullName) {
  $slug = preg_replace("/[^A-Za-z0-9 ]/", '', $fullName);
  $slug = str_replace(" ","-",$slug);
  $slug = strtolower($slug);
  return $slug;
}
$mimgs = get_post_meta( $post->ID, 'map-images', true );
$mitems = get_post_meta( $post->ID, 'map-items', true );

//MAKE THE CATEGORY ARRAY
$catArray = array();
foreach ($mimgs as $i) {
  $name = $i['category'];
  $slug = slugMaker($name);
  $imgURL = wp_get_attachment_image_src($i['image'], 'fixed-1200');
  $imgURL = $imgURL[0];
  $inArray = false;
  foreach($catArray as $c) {
    if($c['slug'] == $slug) {
      $inArray = true;
    }
  }
  if($inArray === false) {
    array_push($catArray,
                array(
                  'name' => $name,
                  'slug'=> $slug,
                  'url' => $imgURL
                )
              );
  }

}


//MAKE THE POINTARRAYS
$iterator = 1;
$loop = 0;
foreach($catArray as $c) {
  $pointArray = array();
  foreach($mitems as $i) {
    $slug = slugMaker($i['category']);
    if($slug == $c['slug']) {
      //THE POINT IS IN THE ARRAY
      $point = array(
        'name' => $i['title'],
        'number' => $iterator
      );
      array_push($pointArray, $point);
      $iterator++;
    }
  }
  //ADD To Cat Array
  $catArray[$loop]['points'] = $pointArray;
  $loop++;
}


?>
<div id="map-apparatus">
  <?php
  $contactcopy = get_post_meta( $post->ID, 'blank-map-image', true );
  $blank = $contactcopy[0];
  $blank = wp_get_attachment_image_src($blank['image'], 'fixed-1200');
  $blank = $blank[0];
  ?>
  <div id="map-image-container">
    <img src="<?php echo $blank;?>" alt="<?php echo $siteTitle;?>" class="blank"/>
  <?php
  $looper = 0;
  foreach($catArray as $c) {
    if($looper < 1) {
      $active = "__activated";
    } else {
      $active = '';
    }
    ?>
  <img class="<?php echo $active;?>" src="<?php echo $c['url'];?>" alt="<?php echo $c['name'];?>" data-slug="<?php echo $c['slug'];?>" />
    <?php
    $looper++;
  }
  ?>
  </div>
  <div id="dt-map-key">
    <ul id="map-list" class="clearfix no-style">
      <?php
      $looper = 0;
      $activated = '__activated';
      foreach($catArray as $c) {
        ?>
        <li data-slug="<?php echo $c['slug'];?>" class="<?php echo $activated;?>">
          <h2 class="h-style"><?php echo $c['name'];?>
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 10">
              <polygon class="cls-1" points="6 10 0 0 12 0 6 10"/>
            </svg>
          </h2>
          <ul class="point-list no-style clearfix">
            <?php
            foreach($c['points'] as $p) {
              ?>
              <li>
                <span class="number"><?php echo $p['number'];?></span>
                <span class="name"><?php echo $p['name'];?></span>
              </li>
              <?php
            }

            ?>

          </ul>

        </li>
        <?php
        $activated = '';
      }
      ?>

    </ul>


  </div>



</div>
<div id="mobile-map-key">
  <div class="cats">
    <?php
    $activated = '__activated';
    foreach($catArray as $c) {
      ?>
      <button class="h-style <?php echo $activated;?>" data-slug="<?php echo $c['slug'];?>">
        <?php echo $c['name'];?>
      </button>
      <?php
      $activated = '';
    }
    ?>
  </div>
  <ul class="point-list no-style clearfix">
    <?php
    foreach($catArray[0]['points'] as $p) {
      ?>
      <li>
        <span class="number"><?php echo $p['number'];?></span>
        <span class="name"><?php echo $p['name'];?></span>
      </li>
      <?php
    }

    ?>

  </ul>

</div>


<?php include 'footer.php'; ?>
