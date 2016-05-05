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


<?php include 'footer.php'; ?>
