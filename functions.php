<?php
add_theme_support( 'menus' );

//$siteDir = '/wp-content/themes/w25th-build';
add_post_type_support('page', 'excerpt');
add_image_size ( 'fake-full', 2000 , 2000 , false ) ;

// Custom functions

// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security

add_theme_support('post-thumbnails');


//USE CUSTOM THEME TEMPLATE









add_action( 'admin_init', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
    add_editor_style( 'css/editor-styles.css' );
}

// DIRECTORY REPLACER

function dirReplacer($string) {
  global $siteDir;
  $time = time();
  $newString = str_replace('***REPLACEWITHTHEMEDIRECTORY***', $siteDir, $string);
  $newString = str_replace('***TIMESTAMP***', $time ,$newString);
  echo $newString;
}
//CONTENT CLEANER
function content_cleaner($content) {

    // Remove inline styling
    $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);

    // Remove font tag
    $content = preg_replace('/<font[^>]+>/', '', $content);

    // Remove empty tags
    $post_cleaners = array('<p></p>' => '', '<p> </p>' => '', '<p>&nbsp;</p>' => '', '<span></span>' => '', '<span> </span>' => '', '<span>&nbsp;</span>' => '', '<span>' => '', '</span>' => '', '<font>' => '', '</font>' => '');
    $content = strtr($content, $post_cleaners);

    return $content;
}
// add_filter('the_content', 'content_cleaner',20);



//ADD FOOTER COPY SETTING
add_filter('admin_init', 'footer_copy_setting');

function footer_copy_setting()
{
    register_setting('general', 'footer_copy', 'esc_attr');
    add_settings_field('footer_copy', '<label for="footer_copy">'.__('Footer Copy' , 'footer_copy' ).'</label>' , 'footer_copy_editor', 'general');
}

function footer_copy_editor()
{
    $value = get_option( 'footer_copy', '' );

    wp_editor( htmlspecialchars_decode($value), 'footer_copy', $settings = array(

    ) );
    ?>


</script>
    <?php
}

include 'contact-constructor.php';

include 'admin-check-off.php';
include 'press-section.php';

include 'map-component/main-include.php';
include 'login-styling.php';
include 'map-upload.php';
?>
