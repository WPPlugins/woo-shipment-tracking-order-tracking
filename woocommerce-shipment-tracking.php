<?php
/*
	Plugin Name: WooCommerce Shipment Tracking Basic
	Plugin URI: https://www.xadapter.com/product/woocommerce-shipment-tracking-pro/
	Description: Basic version of WooCommerce Tracking Plugin. Upgrade to Premium version for features like custom tracking message, multiple shipping services including 70+ predefined services, WPML Support and CSV bulk import of tracking data.
	Version: 1.0.4
	Author: XAdapter
	Author URI: www.xadapter.com/
	Copyright: WooForce.
*/

/**
 * Check if WooCommerce is active
 */
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
	/**
	 * WooCommerce_Shipment_Tracking class
	 */
	class WooCommerce_Shipment_Tracking {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'init' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'wf_plugin_action_links' ) );
		}

		public function init() {
			if ( ! class_exists( 'wf_order' ) ) {
				include_once 'includes/class-wf-legacy.php';
			}		

			include_once ( 'includes/class-wf-tracking-admin.php' );
			include_once ( 'includes/class-wf-tracking-settings.php' );
		}

		/**
		 * Plugin page links
		 */
		public function wf_plugin_action_links( $links ) {
			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=wf_tracking' ) . '">' . __( 'Settings', 'woocommerce-shipment-tracking' ) . '</a>',
				'<a href="https://wordpress.org/support/plugin/woo-shipment-tracking-order-tracking" target="_blank">' . __( 'Support', 'woocommerce-shipment-tracking' ) . '</a>',
				'<a href="https://www.xadapter.com/product/woocommerce-shipment-tracking-pro/"  target="_blank">' . __( 'Premium Upgrade', 'woocommerce-shipment-tracking' ) . '</a>',
			);
			return array_merge( $plugin_links, $links );
		}
	}

	new WooCommerce_Shipment_Tracking();
}
