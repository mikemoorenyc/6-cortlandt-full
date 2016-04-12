<?php
add_action( 'show_user_profile', 'pgroups_off' );
add_action( 'edit_user_profile', 'pgroups_off' );
function pgroups_off( $user ) { ?>







  <table class="form-table">
<tbody><tr >
	<th><label for="_super_user">Associated Property Groups</label></th>
	<td>
    <?php

      $groups = get_terms( 'pgroup' ,array('hide_empty'=>false));

      foreach($groups as $g) {
        echo $g->term_id.' '.$g->name.'<br/>';
      }

     ?>
		</td>
</tr>


</tbody></table>

<?php }
add_action( 'personal_options_update', 'save_pgroup_off' );
add_action( 'edit_user_profile_update', 'save_pgroup_off' );
function save_pgroup_off( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, '_pgroups', $_POST['_pgroups'] );
}
?>
