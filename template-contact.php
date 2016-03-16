<?php
/**
 * Template Name: Contact Page
 */
?>


<?php include 'header.php'; ?>

<?php
$contacts = get_post_meta( $post->ID, 'contact-list', true );
contactConstructor($contacts);
?>

<?php include 'footer.php'; ?>
