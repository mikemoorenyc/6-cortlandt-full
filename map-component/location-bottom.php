<?php

$points = get_post_meta( $post->ID, 'map_points', true );

if(empty($points)) {
  $points = '[]';
}
?>
<!--
<script src="<?php echo get_bloginfo('template_url');?>/map-component/plain.js"></script>
-->
<script>
var APP = {}
var INITIALPOINTS = <?php echo $points;?>;
    INITIALW = 1200,
    INITIALH = 510,
    IMGSRC = '<?php echo get_bloginfo('template_url');?>/assets/imgs/map-place.jpg';
</script>

<script src="<?php echo get_bloginfo('template_url');?>/map-component/build.js"></script>

<?php





?>
