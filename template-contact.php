<?php
/**
 * Template Name: Contact Page
 */
?>


<?php include 'header.php'; ?>
<?php
$contactcopy = get_post_meta( $post->ID, 'contact-copy', true );
$cc = $contactcopy[0];
?>
<?php
$contacts = get_post_meta( $post->ID, 'contact-list', true );

?>

<div id="contact-top">
  <h1 class="h-style"><?php echo $cc['headline'];?></h1>

  <div class="contacts">
    <h2 class="h-style liner"><?php echo wpautop($cc['contact-heading']);?></h2>
    <?php contactConstructor($contacts); ?>
  </div>

</div>


<div id="contact-form">
  <h2 class="form-headline h-style"><?php echo $cc['form-heading'];?></h2>
  <!--
  <div id="broker-switcher">
    <div id="broker-toggler" class="clearfix">
        <a href="#" class="broker selected h-style" data-type="broker">Register as Broker</a>
        <a href="#" class="guest h-style" data-type="buyer">Register as buyer</a>

    </div>

  </div>
--> 
<?php
if(function_exists('ninja_forms_get_all_forms')){
  $all_forms = ninja_forms_get_all_forms();
}


if ( function_exists( 'ninja_forms_display_form' ) ) {
  ninja_forms_display_form( $all_forms[0]['id'] );
}


?>

</div>

<?php include 'footer.php'; ?>
