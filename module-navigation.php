<nav role="navigation" id="main-navigation">

<?php
$frontpage_id = get_option( 'page_on_front' );
$args = array(
    'post_type' 		=> 'page',
    'orderby' 			=> 'menu_order',
    'order' 			=> 'ASC',
    'posts_per_page' => -1
  );
$files_in_cat_query = new WP_Query($args);
if ( $files_in_cat_query->have_posts() ) :

$nav = $files_in_cat_query->get_posts();

foreach($nav as $n){

  if($n->ID !== intval($frontpage_id)){
    ?>
    <a href="<?php echo get_permalink($n->ID);?>" data-slug="<?php echo $n->post_name;?>"><?php echo $n->post_title;?></a>
    <?php
  }
}

endif;

?>



</nav>
