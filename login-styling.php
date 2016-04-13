<?php
function my_login_logo() { ?>
    <style type="text/css">
      body.login {
        background:#f3f3f2;
      }
      .login h1 a {
        display:none !important;
      }
        .login h1 {
            width:250px;
            height: 96px;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/imgs/logo-png.png);
            background-size:100% 100%;
            margin: 0 0 25px 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>
