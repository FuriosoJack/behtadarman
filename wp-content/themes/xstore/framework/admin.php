<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add admin styles and scripts
// **********************************************************************// 

if(!function_exists('etheme_load_admin_styles')) {
	add_action( 'admin_enqueue_scripts', 'etheme_load_admin_styles', 150 );
	function etheme_load_admin_styles() {
		global $pagenow;

		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';
		
	    wp_enqueue_style('farbtastic');
	    wp_enqueue_style('etheme_admin_css', ETHEME_CODE_CSS.'admin-backend-style.css');
	    if ( is_rtl() ) {
	    	wp_enqueue_style('etheme_admin_rtl_css', ETHEME_CODE_CSS.'admin-rtl-backend-style.css');
	    }
	    wp_enqueue_style('xstore-icons', ETHEME_CODE_CSS.'xstore-admin-icons.css');
	    wp_enqueue_style("font-awesome", get_template_directory_uri().'/css/font-awesome.min.css');

	    // Variations Gallery Images script 
		if ( in_array( $screen_id, array( 'product', 'edit-product' ) ) && etheme_get_option('enable_variation_gallery') ) {
			wp_enqueue_script('etheme_admin_product_variations_js', ETHEME_CODE_JS.'product-variations.js', array('etheme_admin_js'), false,true);
		}
	}
}

if(!function_exists('etheme_add_admin_script')) {
	add_action('admin_init','etheme_add_admin_script', 1130);
	function etheme_add_admin_script(){
		global $pagenow;

	    add_thickbox();

	    wp_enqueue_script('theme-preview');
	    wp_enqueue_script('common');
	    wp_enqueue_script('wp-lists');
	    // wp_enqueue_script('postbox');
	    wp_enqueue_script('farbtastic');
	    //wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
	    wp_enqueue_script('etheme_admin_js', ETHEME_CODE_JS.'admin-scripts.js', array(), false,true);

    	wp_localize_script( 'etheme_admin_js', 'et_variation_gallery_admin', array(
			'choose_image' => esc_html__( 'Choose Image', 'xstore' ),
			'add_image'    => esc_html__( 'Add Images', 'xstore' )
		) );

	}
}

// **********************************************************************// 
// ! Notice "extra notice" dismiss
// **********************************************************************// 
//add_action( 'wp_ajax_et_close_extra_notice', 'et_close_extra_notice' ); 
function et_close_extra_notice(){
	update_option( 'etheme_extra_notice_show', false );
}

// **********************************************************************// 
// ! Notice "extra notice from remote"
// **********************************************************************// 
//add_action( 'admin_notices', 'etheme_extra_notice', 50 );
function etheme_extra_notice(){
	$show = get_option( 'etheme_extra_notice_show', false );

	if ( get_transient( 'etheme_extra_notice' ) ) {
		if ( $show ) {
			echo wp_specialchars_decode(get_transient( 'etheme_extra_notice' ));
		}
		return;
	}

	$headers    = array( 'type'=>'Type', 'notice' => 'Notice' );
	$notice     = wp_remote_get( 'https://xstore.8theme.com/et-notice.txt' );
	$notice     = wp_remote_retrieve_body( $notice );
	$old_notice = get_option( 'etheme_extra_notice_data', false );

	if ( ! $show && $old_notice == $notice ) return;

	$file_data = str_replace( "\r", "\n", $notice );

	foreach ( $headers as $field => $regex ) {
		if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] ){
			$headers[ $field ] = _cleanup_header_comment( $match[1] );
		}
	}

	if ( ! in_array( $headers['type'] , array( 'success', 'info', 'error' ) ) ) {
		return;
	}

	if ( ! isset( $headers['notice'] ) || empty( $headers['notice'] ) ) return;

	$out = '
		<div class="et-extra-message et-message et-' . $headers['type'] . '">
			' . $headers['notice'] . '
			<button type="button" class="notice-dismiss close-btn"></button>
		</div>
	';

	update_option( 'etheme_extra_notice_show', true );
	update_option( 'etheme_extra_notice_data', $notice );
	set_transient( 'etheme_extra_notice', $out, DAY_IN_SECONDS*2 );

	echo wp_specialchars_decode($out);
}

add_action('wp_ajax_etheme_deactivate_theme', 'etheme_deactivate_theme');
if( ! function_exists( 'etheme_deactivate_theme' ) ) {
	function etheme_deactivate_theme() {
		// $activated_data = get_option( 'etheme_activated_data' );
		// $theme_id = 15780546;
		// $api_url = ETHEME_API;
		// $status = '';
		// $errors = array();
		// $api = ( ! empty( $activated_data['api_key'] ) ) ? $activated_data['api_key'] : false;

		// $domain = get_option( 'siteurl' );
	 //    $domain = str_replace( 'http://', '', $domain );
	 //    $domain = str_replace( 'https://', '', $domain );
	 //    $domain = str_replace( 'www', '', $domain );
	 //    $domain = urlencode( $domain );

		// $response = wp_remote_get( $api_url . 'deactivate/' . $api . '?envato_id='. $theme_id .'&domain=' . $domain );
		// $response_code = wp_remote_retrieve_response_code( $response );

  //       if( $response_code != '200' ) {
  //           $errors[] = 'API error (5)';
  //           echo json_encode( $errors );
  //           die();
  //       }

  //       $data = json_decode( wp_remote_retrieve_body( $response ), true );

  //       if( isset( $data['error'] ) ) {
  //           $errors[] = $data['error'];
  //           echo json_encode( $errors );
  //           die();
  //       }

		// if ( isset( $data['status'] ) ) {
			// $status = $data['status'];
		 	$status = 'deleted';
			$data = array(
				'api_key' => 0,
				'theme' => 0,
				'purchase' => 0,
	      	);
			update_option( 'etheme_activated_data', maybe_unserialize( $data ) );
			update_option( 'envato_purchase_code_15780546', '' );

			echo json_encode( $status );
			die();
		// }
	}
}

add_action( 'wp_ajax_et_update_menu_ajax', 'et_update_menu_ajax' ); 
if ( ! function_exists('et_update_menu_ajax')) {

	function et_update_menu_ajax () {

		$post = $_POST['item_menu'];

		// update_post_meta( $post['db_id'], '_menu-item-disable_titles', $post['dis_titles']);
		update_post_meta( $post['db_id'], '_menu-item-anchor', sanitize_post($post['anchor']));
		update_post_meta( $post['db_id'], '_menu-item-design', sanitize_post($post['design']));
		update_post_meta( $post['db_id'], '_menu-item-design2', sanitize_post($post['design2']));
		update_post_meta( $post['db_id'], '_menu-item-column_width', $post['column_width']);
		update_post_meta( $post['db_id'], '_menu-item-column_height', $post['column_height']);

		update_post_meta( $post['db_id'], '_menu-item-sublist_width', $post['sublist_width']);

		update_post_meta( $post['db_id'], '_menu-item-columns', $post['columns']);
		update_post_meta( $post['db_id'], '_menu-item-icon_type', sanitize_post($post['icon_type']));
		update_post_meta( $post['db_id'], '_menu-item-icon', $post['icon']);
		update_post_meta( $post['db_id'], '_menu-item-label', sanitize_post($post['item_label']));
		update_post_meta( $post['db_id'], '_menu-item-background_repeat', sanitize_post($post['background_repeat']));
		update_post_meta( $post['db_id'], '_menu-item-background_position', $post['background_position']);
		update_post_meta( $post['db_id'], '_menu-item-use_img', sanitize_post($post['use_img']));
		update_post_meta( $post['db_id'], '_menu-item-widget_area', sanitize_post($post['widget_area']));
		update_post_meta( $post['db_id'], '_menu-item-static_block', sanitize_post($post['static_block']));

		echo json_encode($post);
		die();
	}
}

add_action( 'admin_footer', 'admin_template_js' );
function admin_template_js() {
	if ( !etheme_get_option('enable_variation_gallery') ) return;
	ob_start();
	// require_once $this->include_path( 'admin-template-js.php' );
	?>
		<script type="text/html" id="tmpl-et-variation-gallery-image">
		    <li class="image">
		        <input type="hidden" name="et_variation_gallery[{{data.product_variation_id}}][]" value="{{data.id}}">
		        <img src="{{data.url}}">
		        <a href="#" class="delete remove-et-variation-gallery-image"></a>
		    </li>
		</script>
	<?php 
	$data = ob_get_clean();
	echo apply_filters( 'et_variation_gallery_admin_template_js', $data );
}

add_action( 'woocommerce_save_product_variation', 'et_save_variation_gallery', 10, 2 );

add_action( 'woocommerce_product_after_variable_attributes', 'et_gallery_admin_html', 10, 3 );

if ( ! function_exists( 'et_gallery_admin_html' ) ):
		function et_gallery_admin_html( $loop, $variation_data, $variation ) {
			if ( !etheme_get_option('enable_variation_gallery') ) return;
			$variation_id   = absint( $variation->ID );
			$gallery_images = get_post_meta( $variation_id, 'et_variation_gallery_images', true );
			?>
            <div class="form-row form-row-full et-variation-gallery-wrapper">
                <h4><?php esc_html_e( 'Variation Image Gallery', 'xstore' ) ?></h4>
                <div class="et-variation-gallery-image-container">
                    <ul class="et-variation-gallery-images">
						<?php
							if ( is_array( $gallery_images ) && ! empty( $gallery_images ) ) {
								// include 'admin-template.php';

								// defined( 'ABSPATH' ) or die( 'Keep Quit' );

								foreach ( $gallery_images as $image_id ):
									
									$image = wp_get_attachment_image_src( $image_id );
									
									?>
							        <li class="image">
							            <input type="hidden" name="et_variation_gallery[<?php echo esc_attr( $variation_id ); ?>][]" value="<?php echo esc_attr( $image_id ); ?>">
							            <img src="<?php echo esc_url( $image[ 0 ] ) ?>">
							            <a href="#" class="delete remove-et-variation-gallery-image"></a>
							        </li>
								
								<?php endforeach;
							}
						?>
                    </ul>
                </div>
                <p class="add-et-variation-gallery-image-wrapper hide-if-no-js">
                    <a href="#" data-product_variation_id="<?php echo absint( $variation->ID ) ?>" class="button add-et-variation-gallery-image"><?php esc_html_e( 'Add Gallery Images', 'xstore' ) ?></a>
                </p>
            </div>
			<?php
		}
	endif;
	
	//-------------------------------------------------------------------------------
	// Save Gallery
	//-------------------------------------------------------------------------------
	if ( ! function_exists( 'et_save_variation_gallery' ) ):
		function et_save_variation_gallery( $variation_id, $i ) {
			if ( !etheme_get_option('enable_variation_gallery') ) return;
			if ( isset( $_POST[ 'et_variation_gallery' ] ) ) {
				if ( isset( $_POST[ 'et_variation_gallery' ][ $variation_id ] ) ) {
					$gallery_image_ids = (array) array_map( 'absint', $_POST[ 'et_variation_gallery' ][ $variation_id ] );
					update_post_meta( $variation_id, 'et_variation_gallery_images', $gallery_image_ids );
				} else {
					delete_post_meta( $variation_id, 'et_variation_gallery_images' );
				}
			} else {
				delete_post_meta( $variation_id, 'et_variation_gallery_images' );
			}
		}
	endif;

add_action( 'woocommerce_product_options_pricing', 'et_general_product_data_time_fields' );
function et_general_product_data_time_fields() { 
	
	?>
	</div> 
	<div class="options_group pricing show_if_simple show_if_external hidden">
	<?php

	woocommerce_wp_text_input( array( 'id' => '_sale_price_time_start', 'label' => esc_html('Sale price time start', 'xstore'), 'placeholder' => esc_html( 'From&hellip; 12:00', 'xstore'), 'desc_tip' => 'true', 'description' => __( 'Only when sale price schedule is enabled', 'xstore' ) ) );
	woocommerce_wp_text_input( array( 'id' => '_sale_price_time_end', 'label' => esc_html('Sale price time end', 'xstore'), 'placeholder' => esc_html( 'To&hellip; 12:00', 'xstore' ), 'desc_tip' => 'true', 'description' => __( 'Only when sale price schedule is enabled', 'xstore' ) ) );

}
// -----------------------------------------
// 1. Add custom field input @ Product Data > Variations > Single Variation
  
add_action( 'woocommerce_variation_options_pricing', 'et_add_custom_field_to_variations', 10, 3 ); 
 
function et_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
	?>

	<div class="form-field sale_price_time_fields">
	
		<?php
			woocommerce_wp_text_input( 
				array( 
					'id' => '_sale_price_time_start[' . $loop . ']', 
					'wrapper_class' => 'form-row form-row-first', 
					'label' => __( 'Sale price time start', 'xstore' ),
					'placeholder' => esc_html( 'From&hellip; 12:00', 'xstore'),
					'value' => get_post_meta( $variation->ID, '_sale_price_time_start', true )
				) 
			); 
			woocommerce_wp_text_input( 
				array( 
					'id' => '_sale_price_time_end[' . $loop . ']', 
					'wrapper_class' => 'form-row form-row-last', 
					'label' => __( 'Sale price time end', 'xstore' ),
					'placeholder' => esc_html( 'To&hellip; 12:00', 'xstore' ),
					'value' => get_post_meta( $variation->ID, '_sale_price_time_end', true )
				) 
			); 
		?> 

	</div>

<?php }
  
// -----------------------------------------
// 2. Save custom field on product variation save
 
add_action( 'woocommerce_save_product_variation', 'et_save_custom_field_variations', 10, 2 );
  
function et_save_custom_field_variations( $variation_id, $i ) {
    $_sale_price_time_start = $_POST['_sale_price_time_start'][$i];
    if ( ! empty( $_sale_price_time_start ) ) {
        update_post_meta( $variation_id, '_sale_price_time_start', esc_attr( $_sale_price_time_start ) );
    } else {
    	delete_post_meta( $variation_id, '_sale_price_time_start' );
    }

    $_sale_price_time_end = $_POST['_sale_price_time_end'][$i];
    if ( ! empty( $_sale_price_time_end ) ) {
        update_post_meta( $variation_id, '_sale_price_time_end', esc_attr( $_sale_price_time_end ) );
    } else {
    	delete_post_meta( $variation_id, '_sale_price_time_end' );
    }
}
  
// -----------------------------------------
// 3. Store custom field value into variation data
  
add_filter( 'woocommerce_available_variation', 'et_add_custom_field_variation_data' );
 
function et_add_custom_field_variation_data( $variations ) {
    $variations['_sale_price_time_start'] = '<p class="form-row form-row-first">Sale price time start: <span>' . get_post_meta( $variations[ 'variation_id' ], '_sale_price_time_start', true ) . '</span></p>';
    $variations['_sale_price_time_start'] = '<p class="form-row form-row-last">Sale price time end: <span>' . get_post_meta( $variations[ 'variation_id' ], '_sale_price_time_start', true ) . '</span></p>';
    return $variations;
}

// Hook to save the data value from the custom fields 
add_action( 'woocommerce_process_product_meta', 'et_save_general_product_data_time_fields' );
function et_save_general_product_data_time_fields( $post_id ) { 
	$_sale_price_time_start = $_POST['_sale_price_time_start']; 
	update_post_meta( $post_id, '_sale_price_time_start', esc_attr( $_sale_price_time_start ) ); 
	$_sale_price_time_end = $_POST['_sale_price_time_end']; 
	update_post_meta( $post_id, '_sale_price_time_end', esc_attr( $_sale_price_time_end ) ); 
}

// Instagram feed : remove user
add_action('wp_ajax_et_instagram_user_remove', 'et_instagram_user_remove');
if( ! function_exists( 'et_instagram_user_remove' ) ) {
	function et_instagram_user_remove() {
		if ( isset( $_POST['token'] ) && $_POST['token'] ) {
			$api_data = get_option( 'etheme_instagram_api_data' );
			$api_data = json_decode($api_data, true);

			if ( isset($api_data[$_POST['token']]) ) {
				unset($api_data[$_POST['token']]);
				update_option('etheme_instagram_api_data',json_encode($api_data));
				echo "success";
				die();
			}
			echo "this token is not exist";
			die();
		}
		echo "empty token";
		die();
	}
}

// Instagram feed : save settings
add_action('wp_ajax_et_instagram_save_settings', 'et_instagram_save_settings');
if( ! function_exists( 'et_instagram_save_settings' ) ) {
	function et_instagram_save_settings() {
		if ( isset( $_POST['time'] ) && isset( $_POST['time_type'] ) ) {
			$api_settings = get_option( 'etheme_instagram_api_settings' );
			$api_settings = json_decode($api_settings, true);

			$api_settings['time']      = ( $_POST['time'] && $_POST['time'] != 0 && $_POST['time'] !== '0' ) ? $_POST['time'] : 2;
			$api_settings['time_type'] = $_POST['time_type'];

			update_option('etheme_instagram_api_settings',json_encode($api_settings));
			echo "success";
			die();
		}
		echo "some data is not provided";
		die();
	}
}

// Instagram feed : add user
add_action('wp_ajax_et_instagram_user_add', 'et_instagram_user_add');
if( ! function_exists( 'et_instagram_user_add' ) ) {
	function et_instagram_user_add() {
		if ( isset( $_POST['token'] ) && $_POST['token'] ) {
			$user_url = 'https://api.instagram.com/v1/users/self/?access_token=' . $_POST['token'];
			$api_data = get_option( 'etheme_instagram_api_data' );
			$api_data = json_decode($api_data, true);

			if ( ! is_array( $api_data ) ) {
				$api_data = array();
			}

			$user_data = wp_remote_get($user_url);

			if ( ! $user_data ) {
				echo "Unable to communicate with Instagram";
				die();
			}

			if ( is_wp_error( $user_data ) ) {
				echo esc_html__( 'Unable to communicate with Instagram.', 'xstore' );
				die();
			}

			if ( 200 !== wp_remote_retrieve_response_code( $user_data ) ) {
				echo esc_html__( 'Instagram did not return a 200.', 'xstore' );
				die();
			}

			$user_data = wp_remote_retrieve_body( $user_data );

			if ( ! isset( $api_data[$_POST['token']] ) ) {
				$api_data[$_POST['token']] = $user_data;
			} else {
				echo "this token already exist";
				die();
			}

			update_option('etheme_instagram_api_data',json_encode($api_data));

			echo "success";
			die();
		}
		echo "empty token";
		die();
	}
}