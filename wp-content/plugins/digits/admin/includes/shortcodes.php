<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digit_shortcodes( $showbuttons = true ) {

	if ( $showbuttons ) {
		echo "<h1>" . __( "Shortcodes", "digits" ) . "</h1>";
	}

	?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="digit_loginreg_short"><?php _e( "Login/Signup Page", "digits" ); ?> </label>
            </th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_loginreg_short" value="[dm-page]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row"><label
                        for="digit_loginreg_modal_short"><?php _e( "Login/Signup Modal", "digits" ); ?> </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_loginreg_modal_short" value="[dm-modal]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>


        <tr>
            <th scope="row"><label for="digit_login_short"><?php _e( "Login Page", "digits" ); ?> </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_login_short" value="[dm-login-page]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digit_login_modal_short"><?php _e( "Login Modal", "digits" ); ?>
                </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_login_modal_short" value="[dm-login-modal]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digit_reg_page_short"><?php _e( "Sign Up Page", "digits" ); ?>
                </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_reg_page_short" value="[dm-signup-page]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>


        <tr>
            <th scope="row"><label for="digit_reg_short"><?php _e( "Sign Up Modal", "digits" ); ?>
                </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_reg_short" value="[dm-signup-modal]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label
                        for="digit_forg_page_short"><?php _e( "Forgot Password Page", "digits" ); ?>
                </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_forg_page_short" value="[dm-forgot-password-page]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label
                        for="digit_forg_short"><?php _e( "Forgot Password Modal", "digits" ); ?>
                </label></th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_forg_short" value="[dm-forgot-password-modal]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digit_logout_short"><?php _e( "Logout Shortcode", "digits" ); ?> </label>
            </th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_logout_short" value="[dm-logout]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digit_edit_phone_short"><?php _e( "باکس ویرایش شماره موبایل", "digits" ); ?> </label>
            </th>
            <td>
                <div class="digits_shortcode_tbs">
                    <input type="text" id="digit_edit_phone_short" value="[digits-edit-phone]" readonly/>
                    <img class="dig_copy_shortcode" alt="<?php _e( 'Copy', "digits" ); ?>"
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2326263A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-copy'%3E%3Crect x='9' y='9' width='13' height='13' rx='2' ry='2'%3E%3C/rect%3E%3Cpath d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'%3E%3C/path%3E%3C/svg%3E">
                </div>
            </td>
        </tr>

    </table>


	<?php
	if ( $showbuttons ) {
		?>
        <p class="digits-setup-action step">
            <a href="<?php echo admin_url( 'index.php?page=digits-setup&step=ready' ); ?>"
               class="button-primary button button-large button-next"><?php _e( "Continue", "digits" ); ?></a>
            <a href="<?php echo admin_url( 'index.php?page=digits-setup&step=apisettings' ); ?>"
               class="button"><?php _e( "Back", "digits" ); ?></a>
        </p>
		<?php
	}
}

function digit_shortcodes_translations() {

	?>


    <div class="dig_admin_head"><span><?php _e( 'Menu Items', 'digits' ); ?></span></div>
	<?php

	$diglogintrans     = get_option( "diglogintrans", __( "Login / Register", "digits" ) );
	$digregistertrans  = get_option( "digregistertrans", __( "Register", "digits" ) );
	$digforgottrans    = get_option( "digforgottrans", __( "Forgot your Password?", "digits" ) );
	$digmyaccounttrans = get_option( "digmyaccounttrans", __( "My Account", "digits" ) );
	$diglogouttrans    = get_option( "diglogouttrans", __( "Logout", "digits" ) );

	$digonlylogintrans = get_option( "digonlylogintrans", __( "Login", "digits" ) );
	?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="diglogintrans"><?php _e( "Login / Register", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="diglogintrans" name="diglogintrans" class="regular-text"
                       value="<?php echo $diglogintrans; ?>" required/>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digonlylogintrans"><?php _e( "Login", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="digonlylogintrans" name="digonlylogintrans" class="regular-text"
                       value="<?php echo $digonlylogintrans; ?>" required/>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digregistertrans"><?php _e( "Register", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="digregistertrans" name="digregistertrans" class="regular-text"
                       value="<?php echo $digregistertrans; ?>" required/>
            </td>
        </tr>


        <tr>
            <th scope="row"><label for="digforgottrans"><?php _e( "Forgot", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="digforgottrans" name="digforgottrans" class="regular-text"
                       value="<?php echo $digforgottrans; ?>" required/>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="digmyaccounttrans"><?php _e( "My Account", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="digmyaccounttrans" name="digmyaccounttrans" class="regular-text"
                       value="<?php echo $digmyaccounttrans; ?>" required/>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="diglogouttrans"><?php _e( "Logout", "digits" ); ?> </label></th>
            <td>
                <input type="text" id="diglogouttrans" name="diglogouttrans" class="regular-text"
                       value="<?php echo $diglogouttrans; ?>" required/>
            </td>
        </tr>


    </table>

    <div class="dig_desc_sep_pc"></div>
    <p class="dig_ecr_desc dig_cntr_algn dig_ltr_trnsdc"><?php _e( 'Transation of whole plugin can be done through POT file present in the plugin languages folder. You\'ll need to upload .MO and .PO files to the languages folder of this plugin. The easiest way to translate is to use Loco Translate WordPress plugin.', 'digits' ); ?>
    </p>
	<?php
}