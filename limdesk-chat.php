<?php
/*
	Plugin Name: Limdesk chat
	Description: Enable limdesk chat on every wordpress page
	Version: 1.0
	License: Freeware
*/

/** Insert chat inside template footer **/
add_action('wp_footer', 'insert_limdesk_chat');
function insert_limdesk_chat() {
	$hash = esc_attr( get_option('limdesk_chat_hash') ); // get value from panel
	echo '<div id="limdesk-widget" data-applet-url="//cloud.limdesk.com/applet?callback=?" data-hash="'.$hash.'"></div><script type="text/javascript" src="//cloud.limdesk.com/widget/js/widget.js"></script>';
}

/** Add options page **/
add_action( 'admin_menu', 'limdesk_chat_menu' );
function limdesk_chat_menu() {
	add_menu_page( 'Limdesk Chat Options', 'Limdesk Chat', 'administrator',  __FILE__, 'limdesk_chat_settings_page', 'dashicons-format-chat');
	add_action( 'admin_init', 'register_limdesk_chat' );
}

function register_limdesk_chat() {
	register_setting( 'limdesk-chat-settings-group', 'limdesk_chat_hash' );
}

/** Render html inside options panel **/
function limdesk_chat_settings_page() {
?>
<div class="wrap">
<h2>Limdesk Chat Plugin</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'limdesk-chat-settings-group' ); ?>
    <?php do_settings_sections( 'limdesk-chat-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Hash value</th>
        <td><input type="text" name="limdesk_chat_hash" value="<?php echo esc_attr( get_option('limdesk_chat_hash') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
