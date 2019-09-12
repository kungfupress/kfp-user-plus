<?php
/**
 * Plugin Name:  KFP User Plus
 * Description:  Ejemplo de como añadir campos adicionales al perfil de un usuario de WordPress
 * Version:      0.1.1
 * Author:       Juanan Ruiz
 * Author URI:   https://kungfupress.com/
 */

// Para agregar información de contacto de redes sociales y demás
function modify_contact_methods($profile_fields) {

	$profile_fields['twitter'] = 'Twitter';
	$profile_fields['facebook'] = 'Facebook (URL)';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

// Para cualquier otro tipo de información
add_action( 'show_user_profile', 'user_plus_profile_fields', 10, 1 );
add_action( 'edit_user_profile', 'user_plus_profile_fields', 10, 1 );
add_action( 'personal_options_update', 'save_user_plus_profile_fields' );
add_action( 'edit_user_profile_update', 'save_user_plus_profile_fields' );

function user_plus_profile_fields( $user ) { 
    ob_start();
    ?>
    <h3><?php _e("Domicilio", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Dirección"); ?></label></th>
        <td>
            <input type="text" name="address" id="address" class="regular-text"
                value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>"><br />
            <span class="description"><?php _e("Por favor, indica tu dirección."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("Ciudad"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" class="regular-text"
                value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>"><br />
            <span class="description"><?php _e("Por favor, indica tu ciudad."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="postalcode"><?php _e("Código postal"); ?></label></th>
        <td>
            <input type="text" name="postalcode" id="postalcode"  class="regular-text"
                value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>"><br />
            <span class="description"><?php _e("Por favor, indica tu código postal."); ?></span>
        </td>
    </tr>
    <th><label for="province"><?php _e("Provincia"); ?></label></th>
        <td>
            <input type="text" name="province" id="province"  class="regular-text"
                value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>"><br />
            <span class="description"><?php _e("Por favor, indica tu provincia."); ?></span>
        </td>
    </tr>
    </table>
    <?php
    echo ob_get_clean();
}

function save_user_plus_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'address', sanitize_text_field($_POST['address'] ));
    update_user_meta( $user_id, 'city', sanitize_text_field($_POST['city'] ));
    update_user_meta( $user_id, 'postalcode', sanitize_text_field($_POST['postalcode'] ));
    update_user_meta( $user_id, 'province', sanitize_text_field($_POST['province'] ));
}