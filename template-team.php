<?php
/**
 * Template Name: Team Page
 */
?>
<?php include 'header.php'; ?>
<div id="team-section">

  <ul id="team-list" class="no-style clearfix">
    <?php
    $teams = get_post_meta( $post->ID, 'team-entries', true );
    $looper = 0;
    foreach($teams as $t) {
      if ($looper % 2 == 0) {
        $sideClass = 'even';
      } else {
        $sideClass = 'odd';
      }
      ?>
      <li class="<?php echo $sideClass;?>">
        <h1 class="h-style liner">
          <?php echo wpautop($t['team-name']);?>

        </h1>
        <?php
        $ccount = strlen($t['bio']);

        if($ccount < 470) {
          $noheight = 'all-content';
          $readmore = '';
        } else {
          $noheight = '';
          $readmore = '<a href="#" class="read-more h-style">Read More</a>';
        }

        ?>
        <div class="copy smaller <?php echo $noheight;?>">
          <div class="inner">
          <?php echo $t['bio'];?>
        </div>

        </div>
        <?php echo $readmore;?>


      </li>


      <?php
      $looper++;
    }


    ?>



  </ul>

<div class="side-tag h-style">A Collaboration</div>
</div>

<?php include 'footer.php'; ?>
