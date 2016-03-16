<?php
/**
 * Template Name: Avail Page
 */
?>


<?php include 'header.php'; ?>
<table width="100%" align="center">
<thead>
  <tr>
    <td class="name">
      Unit
    </td>
    <td class="bedrooms">
      Bedrooms
    </td>
    <td class="bathrooms">
      Bathrooms
    </td>
    <td class="isq">
      Interior Sq.Ft.
    </td>
    <td class="esq">
      Exterior Sq.Ft.
    </td>
    <td class="price">
      Price
    </td>
    <td class="download">
      Floor Plan
    </td>
  </tr>
</thead>
<tbody>
<?php
$avail = get_post_meta( $post->ID, 'avail-list', true );

foreach($avail as $a) {
  makeList($a);
}
function makeList($a) {
  if($a['hidden'] == 'hidden') {
    return;
  }
  ?>
  <tr>
    <td class="name">
      <?php echo $a['unit'];?>
    </td>
    <td class="bedrooms">
      <?php echo dasher($a['bedrooms']);?>
    </td>
    <td class="bathrooms">
      <?php echo dasher($a['bathrooms']);?>
    </td>
    <td class="isq">
      <?php echo numberer($a['interior-square-feet']);?>
    </td>
    <td class="esq">
      <?php echo numberer($a['exterior-square-feet']);?>
    </td>
    <td class="price">
      <?php echo numberer($a['price'], '$');?>
    </td>
    <td class="download">
      <?php
        if($a['floor-plan'] != false) {
          ?>
          <a href="<?php echo wp_get_attachment_url($a['floor-plan'], 'full' );?>" target="_blank">Download Floor Plan</a>
          <?php
        } else {
          echo '&ndash;';
        }
      ?>
    </td>

  </tr>
  <?php
}

function numberer($n, $symbol = '') {
  if($n == false) {
    return '&ndash;';
  }
  $num= number_format(intval(preg_replace("/[^0-9]/","",$n)));
  return $symbol.$num;
}

function dasher($d) {
  if($d == false) {
    return '&ndash;';
  } else {
    return $d;
  }
}
?>
</tbody>
</table>


<?php include 'footer.php'; ?>
