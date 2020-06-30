<?php
/*
 * Plugin Name: Evolution Assistance
 * Plugin URI: https://pedropixel.com/plugins/
 * Description: Gestiona asistencia agendada desde tu sitio web
 * Version: 1.0
 * Author: Pedro Pixel
 * Author URI: https://pedropixel.com
 * License: GPL2
 *
 */

/*
 * Assign global variables
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include("db-checking-assistance.php");
require_once('vista.php');
DB_checking_asistance_create();

add_shortcode( 'assistance', 'assistanceForm' );
add_action('wp_head', 'wpb_hook_javascript');

function add_theme_scripts() {
wp_enqueue_script( 'custom-script', plugins_url( '/js/assistance.js', __FILE__ ) );
wp_enqueue_style( 'custom-script', plugins_url( '/css/assistance.css', __FILE__ ) );
wp_enqueue_script( 'custom-script', plugins_url( '/js/bootstrap.min.js', __FILE__ ) );
wp_enqueue_style( 'custom-script', plugins_url( '/css/bootstrap.min.css', __FILE__ ) );
}
add_action( 'wp_head', 'add_theme_scripts' );
