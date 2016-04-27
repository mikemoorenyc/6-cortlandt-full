




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

  <script>
  var phpvars_siteDir = '<?php echo $siteDir;?>';
  </script>

  <script src="<?php echo $siteDir;?>/js/main.js?v=<?php echo time();?>" ></script>

  </body>
</html>
