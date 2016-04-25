<?php

function press_ui_content() {

  	global $post;
    if($post->post_type !== 'press') {
      return;
    }

    $pressJSON = get_post_meta($post->ID, 'press_data', true);
    if(empty($pressJSON)){
      $pressJSON = "{title: '',excerpt: '',linkType: 'external',linkURL: '',linkID: '',imgID: '',imgURL: ''}";
    }
    $decoded = json_decode($pressJSON);
    if(empty($decoded->linkURL)) {
      $linkURL = false;
    } else {
      $linkURL = $decoded->linkURL;
    }
    if(empty($decoded->linkID)) {
      $linkID = "''";
    } else {
      $linkID = $decoded->linkID;
      $linkURL = wp_get_attachment_url( $decoded->linkID, 'full' );
    }
    if(empty($decoded->imgID)) {
      $imgID = "''";
      $imgURL = false;
    } else {
      $imgID = $decoded->imgID;
      $imgURL = wp_get_attachment_image_src($decoded->imgID, 'medium', false);
      $imgURL = $imgURL[0];
    }

    ?>

    <script>

    var APP = {
      title: '<?php echo $decoded->title;?>',
      excerpt: '<?php echo $decoded->excerpt;?>',
      linkType: '<?php echo $decoded->linkType;?>',
      linkID: <?php echo $linkID;?>,
      linkURL: '<?php echo $linkURL;?>',
      imgID: <?php echo $imgID;?>,
      imgURL: '<?php echo $imgURL;?>'
    };



    </script>
    <script src="<?php echo get_bloginfo('template_url');?>/press-section/build.js"></script>
<script>
ReactDOM.render(React.createElement(MainPress, null), document.getElementById('press-entry-point'));
</script>
    <!--
    <script>
    jQuery(document).ready(function($){
      $('#submitdiv').after($('#required-field-list-template'));
      $('#required-field-list-template').show();
      $('textarea[name="press-excerpt_copy"]').attr('maxlength', 150);
      $('textarea[name="press-excerpt_copy"]').after('<div class="info">Max length: 150 characters</div>');
      var docType = $('input[name=press-read-more-link_link-type]:checked').val();
      docSwitcher();
      $('input[name=press-read-more-link_link-type]').on('change',function(){
        docSwitcher();
      });

      function docSwitcher() {
        docType = $('input[name=press-read-more-link_link-type]:checked').val();
        if(docType == 'external') {
          $('#press-read-more-link li.row-document').hide();
          $('#press-read-more-link li.row-external-site-url').show();
        } else {
          $('#press-read-more-link li.row-document').show();
          $('#press-read-more-link li.row-external-site-url').hide();
        }
      }

      function stateChecker() {
        var ready = true;
        $('#required-field-list-template li').addClass("success");
        $('#publishing-action input.button').removeAttr('disabled');


        //CHECK TITLE
        var title = $('input#title').val();
        if(title == '') {
          ready = false;
          $('#required-field-list-template li.title').removeClass("success");
        }
        //CHECK EXCERPT
        var excerpt = $('textarea[name="press-excerpt_copy"]').val();
        if(excerpt == '') {
          ready = false;
          $('#required-field-list-template li.excerpt').removeClass("success");
        }
        //CHECK READ MORE
        if(docType == 'external') {
          if($('input[name="press-read-more-link_external-site-url"]').val() == '') {
            ready = false;
            $('#required-field-list-template li.read').removeClass("success");
          }
        } else {
          if($('input[name="press-read-more-link_document"]').val() == '') {
            ready = false;
            $('#required-field-list-template li.read').removeClass("success");
          }
        }
        // FEATURED IMAGE
        var img = $('#set-post-thumbnail > img').attr('src');
        if(img == undefined) {
          $('#required-field-list-template li.image').removeClass("success");
        }
        //BUTTON
        if(ready == false) {
          $('#publishing-action input.button').attr('disabled','');
        }
      }

      stateChecker();


      setInterval(function(){
        stateChecker();
      },1000);
    });



    </script>
    <style>
    /*#46b450*/
    #required-field-list li {
      position:relative;
      min-height:20px;
      padding-left:30px;
      margin-left: 10px;
      margin-right:10px;
    }
    #required-field-list li.success {
      color:#46b450;
    }
    #required-field-list li:before {
      display:block;
      content:'';
      width:15px;
      height: 15px;
      position:absolute;
      left: 0;
      top: -2px;
      border-radius:50%;
      border:1px solid rgba(238,238,238,1);
    }
    #required-field-list li.success:before {
      border-color:#46b450;
      background: #46b450;
    }


    </style>
  -->
    <?php
  }








?>
