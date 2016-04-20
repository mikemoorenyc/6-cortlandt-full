


<?php
  $ctas = get_post_meta( $post->ID, 'bottom-ctas', true );

  if(!empty($ctas)) {
    $ctas = $ctas[0];
    $full = false;
    foreach($ctas as $cta) {
      if(!empty($cta)) {
        $full = true;
      }
    }
    if($full == true) {
      ?>
      <div class="footer-ctas clearfix">
        <?php
        foreach($ctas as $c) {
          if(!empty($c)) {
            $post = get_page_by_title($c);
            if(!empty($post)) {
              ?>
              <a  href="<?php echo get_permalink($post->ID);?>">
                <?php echo $post->post_title;?>

              </a>

              <?php
            }
          }
        }


        ?>

      </div>

      <?php
    }
  }


?>

</div><!--main-content-container-->
</div><!-- ajax-catcher-->

<div id="footer">
  <div class="inner clearfix">
    <div class="logo">

    </div>
    <div class="contact-block">
      <?php
      $contactPage = get_page_by_title('Contact');
      $contacts = get_post_meta( $contactPage->ID, 'contact-list', true );
      if(!empty($contacts)) {
        contactConstructor($contacts);
      }

      ?>
    </div>
    <div class="disclaimer">
      <?php echo htmlspecialchars_decode(get_option('footer_copy',''));?>
    </div>
  </div>
</div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script id="inline-scripts"><?php $inlinejs = file_get_contents($siteDir.'/js/inline-load.js'); dirReplacer($inlinejs);?></script>
  <script src="<?php echo $siteDir;?>/js/main.js?v=<?php echo time();?>" async="true"></script>

  </body>
</html>
