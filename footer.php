




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
