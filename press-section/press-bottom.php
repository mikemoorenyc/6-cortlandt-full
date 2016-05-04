<?php

function press_ui_content() {

  	global $post;
    if($post->post_type !== 'pressitem') {
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
    if(empty($decoded->linkType)) {
      $type = 'external';
    } else {
      $type = $decoded->linkType;
    }

    ?>

    <script>

    var APP = {

      linkType: '<?php echo $type;?>',
      linkID: <?php echo $linkID;?>,
      linkURL: '<?php echo $linkURL;?>',
      imgID: <?php echo $imgID;?>,
      imgURL: '<?php echo $imgURL;?>',
      linkerror: '',
      titleerror: '',
      excerpterror: ''
    };



    </script>
    <div id="unsafe-values" style="display:none;">
      <div class="title"><?php echo $decoded->title;?></div>
      <div class="excerpt"><?php echo $decoded->excerpt;?></div>
    </div>
    <script src="<?php echo get_bloginfo('template_url');?>/press-section/build.js"></script>

<script>
ReactDOM.render(React.createElement(MainPress, null), document.getElementById('press-entry-point'));
</script>

    <?php
  }








?>
