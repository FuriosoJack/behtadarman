<?php


if ( class_exists( 'Admin_Notice' ) ) {
	return;
}

/**
 * Class Admin_Notice
 */
final class Admin_Notice {
	protected static $_instance = null;

	public static function get_instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public static function email_notice() {
		$status = ZhUpClient::get_options( 'send-admin-notifications' );
		if ( ! $status || $status !== '1' ) {
			return false;
		}
		self::get_notice( true );
	}

	public static function save_new_notif( $new_notif ) {
		$all_selected_product = array_merge( zhUpClient_check::checked_updated_plugin_list(), zhUpClient_check::checked_updated_theme_list() );
		$old_notification     = maybe_unserialize( get_option( 'zhupclient_notifications', [] ) );
		$new_notifications    = [];
		$all_plugins = get_plugins();
		foreach ( (array)$new_notif as $notif ) {
			$notif = (array) $notif;
			if ( isset( $old_notification[ $notif['id'] ]['dismiss'] ) && $old_notification[ $notif['id'] ]['dismiss'] === true ) {
				$new_notifications[ $notif['id'] ] = $old_notification[ $notif['id'] ];
				continue;
			}
			//check if product and version compare match
			if ( isset( $notif['product_name'] ) && $notif['product_name'] !== false ) {
				if ( ! array_key_exists( $notif['product_name'], $all_selected_product ) ) {
					continue;
				}
				if ( isset( $notif['product_version'] ) && $notif['product_version'] !== false ) {
					if ( array_key_exists($notif['product_name'],$all_plugins)) {
						if (  version_compare( substr($notif['product_version'],1),$all_plugins[$notif['product_name']]['Version'], substr($notif['product_version'],0,1) ) ) {
							continue;
						}
					} else {
						if ( version_compare( $notif['product_version'], wp_get_theme( $notif['product_name'] )->Version,  substr($notif['product_version'],0,1) ) ) {
							continue;
						}
					}
				}
			}
			//check if enc time not received
			if ( isset( $notif['end_time'] ) && $notif['end_time'] !== false && strtotime($notif['end_time']) < time() ) {
				continue;
			}

			$new_notifications[ $notif['id'] ] = $notif;
		}
		update_option( 'zhupclient_notifications', $new_notifications );
	}


	public static function general_notice() {
		if ( isset( $_GET['page'] ) && $_GET['page'] === 'required_ioncube' ) {
			return false;
		}
		$last_errors = get_option( 'zhupclient_errors' );
		$arg         = [
			'id'         => 'system',
			'type'       => 'error',
			'no_dismiss' => false
		];
		if ( isset( $last_errors ) && ! empty( $last_errors ) ) {
			$arg['simple_content'] = sprintf( "<strong> %s :</strong> %s", __( 'Zhaket updater problem', 'zhaket-updater' ), $last_errors );
			echo self::generate_notice_html( $arg ,true);
		}
		if ( ! self::ionCube_active() ) {
			$arg['simple_content'] = sprintf( "<strong> %s :</strong> %s", __( 'Zhaket updater problem', 'zhaket-updater' ), self::ionCube_active_message() );
			$arg['no_dismiss']     = true;
			echo self::generate_notice_html( $arg ,true);
		}
		if ( ! self::php_version_status() ) {
			$arg['simple_content'] = sprintf( "<strong> %s :</strong> %s", __( 'Zhaket updater problem', 'zhaket-updater' ), self::php_version_message() );
			$arg['no_dismiss']     = true;
			echo self::generate_notice_html( $arg ,true);
		}
	}

	/**
	 *call to show all notice
	 *
	 * @param bool $email
	 *
	 * @return bool
	 */
	public static function get_notice( $email = false ) {
		if ($email==='')$email=false;
		if (!$email && !current_user_can('update_plugins')) return false;
		if ( isset( $_GET['dismiss_nonce'] ) && isset( $_GET['dismiss_id'] ) ) {
			self::dismiss_notice();
		}

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'required_ioncube' ) {
			return false;
		}

		$all_notice = maybe_unserialize( get_option( 'zhupclient_notifications', [] ) );
		if (is_array($all_notice) &&  count( $all_notice ) > 0 ) {
			usort( $all_notice, function ( $a, $b ) {
				if ( ! isset( $a['position'] ) || ! isset( $b['position'] ) ) {
					return 1;
				}
				return  $b['position'] - $a['position'] ;
			} );
			$item = 0;
			foreach ($all_notice as $notice ) {
				if ( isset( $notice['dismiss'] ) && $notice['dismiss'] === true ) {
					continue;
				}
				if ( ! $email && isset( $notice['show'] ) && $notice['show'] === 'only_email' ) {
					continue;
				}
				if ( isset( $notice['start_time'] ) && $notice['start_time'] !== false && strtotime($notice['start_time']) > time() ) {
					continue;
				}
				if ( isset( $notice['end_time'] ) && $notice['end_time'] !== false && strtotime($notice['end_time']) < time() ) {
					self::dismiss_notice( $notice['id'] );
					continue;
				}

				if ( ! $email && isset( $notice['display_page'] ) && $notice['display_page'] !== false ) {
					if ( strpos($_SERVER['REQUEST_URI'],$notice['display_page'])===false ) {
						continue;
					}
					echo self::generate_notice_html( $notice );
					continue;
				}
				if ( ! $email && (!isset($notice['show']) || $notice['show']!=='only_email')) {
					echo self::generate_notice_html( $notice );
				}

				if ($email && $item < 1 && (!isset($notice['show']) || $notice['show']!=='only_admin') && !isset($notice['dismiss_email'])) {
					self::generate_notice_email_html( $notice );
					$item ++;
				}

			}
		}
	}


	private static function generate_notice_email_html( $item = array() ) {
		$email_address  = ZhUpClient::get_options( 'email-address' );
		$email_template = ZhUpClient_plugin_dir . 'inc/email-html/notification_default.html';
		$ready          = false;
		if ( isset( $item['email_html_address'] ) && $item['email_html_address'] !== false ) {

			if (!filter_var($item['email_html_address'], FILTER_VALIDATE_URL)) return false;

			$api_response=wp_remote_get($item['email_html_address'], array('timeout' => 60,'sslverify'=>false));
			if (is_wp_error($api_response) || wp_remote_retrieve_response_code($api_response) !== 200) return false;
			$body = wp_remote_retrieve_body($api_response);
			$subject=(isset($item['email_subject']) && !empty($item['email_subject']))?$item['email_subject']:false;
			$ready          = true;
		}

		if ( ! $ready ) {
			$template = @file_get_contents( $email_template );
			if ( isset( $item['html_content'] ) && $item['html_content'] !== false ) {
				$content = $item['html_content'];
			} else {
				$content = $item['simple_content'];
			}
			$subject=false;
			$body = sprintf( $template, $content );
		}

		self::dismiss_notice( $item['id'] ,'email');

		self::send_notification_email( $email_address, $body ,$subject);

	}

	private static function send_notification_email( $to, $body,$subject=false ) {
		ZhUpClient::add_log( 'general-notification', 0, $body, 0, 'general-notification' );
		$subject = ($subject===false)?__( 'New notification for you', 'zhaket-updater' ) . ' (' . site_url() . ')':$subject;
		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		wp_mail( $to, $subject, $body, $headers );
	}

	/**
	 * generate notice html
	 *
	 * @param array $item
	 * @param $system :float
	 *
	 * @return string
	 */
	public static function generate_notice_html( $item = array(),$system=false) {
		if ( ! isset( $item['no_dismiss'] ) || $item['no_dismiss'] !== true ) {
			global $pagenow;
			$query_var = add_query_arg( [
				'dismiss_nonce' => wp_create_nonce( 'zhupclient_dismiss_me' ),
				'dismiss_id'    => ($system && $system===true)?"system":(isset($item['id']))?$item['id']:'',
			] );
			$dismiss   = sprintf( "<a href=\"%s\"  class=\"notice-dismiss\" style='text-decoration: none;'>
				<span class=\"screen-reader-text\">%s</span>
			</a>", $query_var, __( 'Dismiss this notice', 'zhaket-updater' ) );
		} else {
			$dismiss = '';
		}

		if ( isset( $item['html_content'] ) && $item['html_content'] !== false ) {
			$html = "<div  class='notice' style='position: relative; background:initial; border-right: none; margin: 0; padding: initial'>";
			$html .= $item['html_content'];
			$html .= $dismiss;
			$html .= '</div>';

			return $html;
		}
        if (!isset($item['simple_content']) || strlen($item['simple_content'])<10) return '';
		$html = sprintf( "<div class='notice notice-%s' style='position: relative;'>", $item['type'] );
		$html .= sprintf( "<p>%s</p>", $item['simple_content'] );
		$html .= $dismiss;
		$html .= '</div>';

		return $html;
	}

	public static function dismiss_notice( $key = '',$type='admin' ) {
		if ($type!=='email' &&  ! wp_verify_nonce( $_GET['dismiss_nonce'], 'zhupclient_dismiss_me' ) ) {
			return false;
		}

        $key=(strlen($key)>0)? $key:$_GET['dismiss_id'];

		if ( $key === 'system' ) {
			delete_option( 'zhupclient_errors' );
			return true;
		}

		if ($key==='')
		$key = (int) $_GET['dismiss_id'];

		$all_notice = maybe_unserialize( get_option( 'zhupclient_notifications', [] ) );

		if ( isset( $all_notice[ $key ] ) ) {
			if ($type==='email'){
				$all_notice[$key]['dismiss_email']=true;
			}else{
				$all_notice[ $key ]['dismiss'] = true;
			}
			update_option( 'zhupclient_notifications', $all_notice );
		}
	}

    public static function php_version_status(){
        if(version_compare(phpversion(),"5.6",'>='))
            return true;
        return false;
    }

    public static function ionCube_active()
    {
        if (!extension_loaded('ionCube Loader')) return false;
        if (!function_exists('ioncube_loader_version') || !version_compare(ioncube_loader_version(),'10.2','>=')) return false;
        return true;
    }

    public static function ionCube_active_message() {
        return __('we detect you do not have ionCube loader or it is too old , please call to your host service to update ionCube loader version to upper than 10.2','zhaket-updater');
    }

    public static function php_version_message(){
        return __('We your server php version is to old, this plugin need php version 5.6 to up.  please call to your host service to update php','zhaket-updater');
    }

}