<?php
/*
 * Plugin Name: LaterPay-Boilerplate
 * Plugin URI: https://github.com/laterpay/laterpay-wordpress-plugin-extension-boilerplate
 * Description: Sell digital content with LaterPay. It allows super easy and fast payments from as little as 5 cent up to 149.99 Euro at a 15% fee and no fixed costs.
 * Author: LaterPay GmbH and Mihail Turalenka
 * Version: 0.0.1
 * Author URI: https://laterpay.net/
 * Textdomain: laterpay
 * Domain Path: /languages
 */

// Kick-off
// Specific LaterPay hook, this plugin will work only if main plugin is loaded
add_action( 'laterpay_ready', 'laterpay_boilerplate_init' );

register_activation_hook( __FILE__, 'laterpay_boilerplate_activate' );
register_deactivation_hook( __FILE__, 'laterpay_boilerplate_deactivate' );

/**
 * Callback for starting the plugin.
 *
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function laterpay_boilerplate_init() {
    laterpay_boilerplate_before_start();
    laterpay_event_dispatcher()->add_listener( 'laterpay_deactivate_after', 'laterpay_boilerplate_force_deactivate' );
    // Write init code here
}

/**
 * Callback for activating the plugin.
 *
 * @wp-hook register_activation_hook
 *
 * @return void
 */
function laterpay_boilerplate_activate() {
    /**
     * Detect plugin. For use in Admin area only.
     */
    if ( ! is_plugin_active( 'laterpay/laterpay.php' ) ) {
        unset( $_GET['activate'] );
        deactivate_plugins( 'laterpay-boilerplate/laterpay-boilerplate.php' );
        return;
    }
    laterpay_boilerplate_before_start();
    // Write activation code here.
}

/**
 * Callback for deactivating the plugin.
 *
 * @wp-hook register_deactivation_hook
 *
 * @return void
 */
function laterpay_boilerplate_deactivate() {
    laterpay_boilerplate_before_start();
    // Write deactivation code here
}

/**
 * Callback for deactivating the plugin.
 *
 * @wp-hook register_deactivation_hook
 *
 * @return void
 */
function laterpay_boilerplate_force_deactivate() {
    deactivate_plugins( 'laterpay-boilerplate/laterpay-boilerplate.php' );
}

/**
 * Run before init, activate and deactivate to register our autoload paths.
 *
 * @return void
 */
function laterpay_boilerplate_before_start() {
    $dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
    LaterPay_AutoLoader::register_namespace( $dir . 'application', 'LaterPay' );
}
