




</div><!--main-content-container-->
</div><!-- ajax-catcher-->

<div id="footer">
  <div class="inner clearfix">
    <div class="logo">
      <a href="http://www.stribling.com/" target="_blank">
        <img src="<?php echo $siteDir;?>/assets/imgs/stribling-logo.png" alt="Stribling Marketing Associates" width="93" />
      </a>
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
      <a href="#" class="legal" target="_blank">LEGAL</a>
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
