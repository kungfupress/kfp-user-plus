<?php
/**
 * Plugin Name:  KFP User Plus
 * Description:  Ejemplo de como añadir campos adicionales al perfil de un usuario de WordPress
 * Version:      0.1.1
 * Author:       Juanan Ruiz
 * Author URI:   https://kungfupress.com/
 */

add_action( 'show_user_profile', 'user_plus_profile_fields' );
add_action( 'edit_user_profile', 'user_plus_profile_fields' );

function user_plus_profile_fields( $user ) { ?>
    <h3><?php _e("Pérfil plus de usuario", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Address"); ?></label></th>
        <td>
            <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your address."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your city."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
        <td>
            <input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your postal code."); ?></span>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_user_plus_profile_fields' );
add_action( 'edit_user_profile_update', 'save_user_plus_profile_fields' );

function save_user_plus_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'address', $_POST['address'] );
    update_user_meta( $user_id, 'city', $_POST['city'] );
    update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}