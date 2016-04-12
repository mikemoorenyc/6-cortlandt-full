<?php
function contactConstructor($list) {
  if(count($list) > 2) {
    $clen = 'full';
  } else {
    $clen = '';
  }

  ?>
  <ul class="clearfix no-style contact-list <?php echo $clen;?>">
    <?php
    foreach($list as $c) {
        ?>
        <li>

        <div class="name"><?php echo $c['name'];?></div>
        <?php
        if($c['phone']!= false) {
          ?>
          <div class="phone"><?php echo $c['phone'];?></div>
          <?php
        }
        if($c['email']!= false) {
          if(is_email($c['email'])!= false) {
            ?>
            <div class="email">

              <a href="mailto:<?php echo $c['email'];?>" target="_blank"><?php echo $c['email'];?></a>
            </div>
            <?php
          }
        }
        ?>
        </li>
        <?php
    }



    ?>


  </ul>
  <?php
}
