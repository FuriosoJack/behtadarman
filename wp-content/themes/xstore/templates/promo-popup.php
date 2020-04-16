<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
/**
 * The template for displaying theme promo popup
 *
 * @since   6.4.5
 * @version 1.0.0
 */
if( get_query_var('etheme_header_builder', false) || !etheme_get_option('promo_popup')) return;

$bg = etheme_get_option('pp_bg');
if( !is_array($bg) ) {
	$bg = array();
}
$padding = etheme_get_option('pp_padding');
if( ! empty( $bg['background-color'] ) ){
	$bg['color-start'] = et_hex_to_rgba( $bg['background-color'], 0 );
	$bg['color-end'] = et_hex_to_rgba( $bg['background-color'], 1 );
} else {
	$bg['color-start'] = 'rgba(255,255,255,0)';
	$bg['color-end'] = 'rgba(255,255,255,1)';
}
$popup_content = etheme_get_option('pp_content');
?>	
<div id="etheme-popup-wrapper" class="white-popup-block mfp-hide mfp-with-anim zoom-anim-dialog  etheme-popup-wrapper">
    <div id="etheme-popup-holder" class="etheme-newsletter-popup" <?php if (etheme_get_option('promo_auto_open') && etheme_get_option('pp_delay')) { echo ' data-delay="'.etheme_get_option('pp_delay').'"';} ?>>
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
        <div id="etheme-popup">
            <?php if ( $popup_content != '' ) {
            	echo do_shortcode($popup_content);
        	}
            else { ?>
            	<p class="woocommerce-info" style="background-color: #fff;">
            		<?php echo sprintf( esc_html__('Add custom content to this popup via %1s -> %2s', 'xstore'), 
            			'<a href="'.admin_url( 'customize.php' ).'" target="_blank">'.esc_html__('Customizer', 'xstore').'</a>', 
            			'<a href="'.admin_url( '/customize.php?autofocus[section]=shop-promo-popup' ).'" target="_blank">'.esc_html__('Promo Popup', 'xstore') . '</a>' ); ?>	
    			</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php ob_start(); ?>
	#etheme-popup-holder:after {
		content: '';
		height: 60px;
		position: absolute;
		bottom: 0;
		left: 50%;
		transform: translateX(-50%);
		width: <?php echo (etheme_get_option('pp_width') != '') ? etheme_get_option('pp_width') - 90 : 700 - 90 ; ?>px;
		<?php if(!empty($bg['background-color']) && $bg['background-color'] != 'transparent' && $bg['background-color'] != 'rgba(255,255,255,0)' ): ?>
		background: -moz-linear-gradient(top, <?php echo esc_attr($bg['color-start']); ?> 0%, <?php echo esc_attr($bg['color-end']); ?> 80%);
	    background: -webkit-linear-gradient(top, <?php echo esc_attr($bg['color-start']); ?> 0%, <?php echo esc_attr($bg['color-end']); ?> 80%);
	    background: linear-gradient(to bottom, <?php echo esc_attr($bg['color-start']); ?> 0%, <?php echo esc_attr($bg['color-end']); ?> 80%);
	    <?php endif; ?>
	}
    #etheme-popup {
        width: <?php echo (etheme_get_option('pp_width') != '') ? etheme_get_option('pp_width') : 700 ; ?>px;
        height: <?php echo (etheme_get_option('pp_height') != '') ? etheme_get_option('pp_height') : 350 ; ?>px;
        <?php if(!empty($bg['background-color'])): ?>  background-color: <?php echo esc_attr($bg['background-color']); ?>;<?php endif; ?>
        <?php if(!empty($bg['background-image'])): ?>  background-image: url(<?php echo esc_url($bg['background-image']); ?>) ; <?php endif; ?>
        <?php if(!empty($bg['background-attachment'])): ?>  background-attachment: <?php echo esc_attr($bg['background-attachment']); ?>;<?php endif; ?>
        <?php if(!empty($bg['background-repeat'])): ?>  background-repeat: <?php echo esc_attr($bg['background-repeat']); ?>;<?php  endif; ?>
        <?php if(!empty($bg['background-position'])): ?>  background-position: <?php echo esc_attr($bg['background-position']); ?>;<?php endif; ?>
    }
<?php $style = ob_get_clean();

wp_add_inline_style( 'xstore-inline-css', $style ); 
