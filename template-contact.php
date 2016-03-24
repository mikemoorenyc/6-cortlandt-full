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


<div id="contact-form">
<?php
$all_forms = ninja_forms_get_all_forms();

if ( function_exists( 'ninja_forms_display_form' ) ) {
  ninja_forms_display_form( $all_forms[0]['id'] );
}


?>

</div>

<?php include 'footer.php'; ?>
