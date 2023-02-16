<?php
//wp_nav_menu_item_custom_fields
  function menu_item_desc( $item_id, $item ) {
    $menu_item_megamenu = get_post_meta( $item_id, '_menu_item_megamenu', true );
    ?>
    <div style="clear: both;">
        <span class="megamenu"><?php _e( "Select Megamenu", 'megamenu' ); ?></span><br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
        <select id="megamenu_options[<?php echo $item_id ;?>]" name="megamenu_options[<?php echo $item_id ;?>]">
          <option value="disable" <?php if($menu_item_megamenu == 'disable'){ echo "selected";} ?> >Disable</option>
          <option value="megamenuone"<?php if($menu_item_megamenu == 'megamenuone'){ echo "selected";} ?>>Megamenu one</option>
          <option value="megamenutwo"<?php if($menu_item_megamenu == 'megamenutwo'){ echo "selected";} ?>>Megamenu Two</option>
          <option value="megamenuthree"<?php if($menu_item_megamenu == 'megamenuthree'){ echo "selected";} ?>>Megamenu Three</option>
        </select>
    </div>
    <?php
  }
  add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_desc', 10, 2 );

  function save_menu_item_desc( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['megamenu_options'][$menu_item_db_id]  ) ) {
      $megamenu_data = sanitize_text_field( $_POST['megamenu_options'][$menu_item_db_id] );
      update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_data );
    } else {
      delete_post_meta( $menu_item_db_id, '_menu_item_megamenu' );
    }
  }
  add_action( 'wp_update_nav_menu_item', 'save_menu_item_desc', 10, 2 );
