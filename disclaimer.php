<?php
/*
 * Plugin Name:       Disclaimer Plugin
 * Description:       Handle the basics.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            shiwangi khanduja
 * Text Domain:       disclaimer-plugin
 * Domain Path:       /languages
 */

 class Disclaimer {

    public function __construct() {
        $plugin_path = plugin_dir_path( __FILE__ ) . 'settings.php';
        require_once( $plugin_path );

        add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_script'));
        add_action('wp', array($this, 'add_disclaimer_popup'));
    }

    public function enqueue_custom_script() {
        $options = get_option('disclaimer_settings');
        $keys = array_keys($options['post_types']);
        $current_post_type = get_post_type(get_the_ID());
        if(in_array($current_post_type, $keys)){
            wp_enqueue_script('custom-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0', true);
        }
        wp_enqueue_style('custom-style', plugins_url('assets/css/style.css', __FILE__));
    }

    public function add_disclaimer_popup() {
        $options = get_option('disclaimer_settings');
        $keys = array_keys($options['post_types']);
        $current_post_type = get_post_type(get_the_ID());
        if(in_array($current_post_type, $keys) && !is_admin()){ 
            $plugin_path = plugin_dir_path( __FILE__ ) . 'disclaimer-popup.php';
            require_once( $plugin_path );
        }
    }
}

$custom_plugin = new Disclaimer();








