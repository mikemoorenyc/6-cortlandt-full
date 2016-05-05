




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
      <?php
      $value = get_option( 'main_map_image', '' );

      if(!empty($value)) {
        ?>
        <a href="<?php echo wp_get_attachment_url( $value );?>" class="legal" target="_blank">LEGAL</a>
        <?php
      }

      ?>

    </div>
  </div>
</div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script>
  var phpvars_siteDir = '<?php echo $siteDir;?>';
  </script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-69589906-1', 'auto');


  </script>

  <script src="<?php echo $siteDir;?>/js/main.js?v=<?php echo time();?>" ></script>

  </body>
</html>
