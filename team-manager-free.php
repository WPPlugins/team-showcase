<?php
/*
Plugin Name: Team Showcase
Plugin URI: http://themepoints/team-showcase
Description: Lightweight & Responsive Team Showcase Plugin For WordPress.
Version: 1.0
Author: Themepoints
Author URI: http://themepoints.com
License: GPLv2
Text Domain: team-manager-free
Domain Path: /languages
*/




/**********************************************************
 * Exit if accessed directly
 **********************************************************/

if ( ! defined( 'ABSPATH' ) )

	die("Can't load this file directly");



define('TEAM_MANAGER_FREE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('team_manager_free_plugin_dir', plugin_dir_path( __FILE__ ) );


require_once( plugin_dir_path(__FILE__) . 'admin/team-manager-free-post-type.php');
require_once( plugin_dir_path(__FILE__) . 'admin/team-manager-free-meta-boxes.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/team-manager-free-themes.php');

/**********************************************************
 * load plugin textdomain 
 **********************************************************/

function team_manager_free_load_textdomain(){

	load_plugin_textdomain('team-manager-free', false, dirname(plugin_basename( __FILE__ )) . '/languages/');

}
add_action('plugins_loaded', 'team_manager_free_load_textdomain');




/**********************************************************
 * load plugin style & scripts
 **********************************************************/


function team_manager_free_initial_script()
 {
 wp_enqueue_script('team_manager-modernizer', plugins_url( '/js/modernizr.custom.js', __FILE__ ), array('jquery'), '1.0', false);
 wp_enqueue_script('team_manager-classie', plugins_url( '/js/classie.js', __FILE__ ), array('jquery'), '1.0', false);  
 wp_enqueue_script('team_manager-main', plugins_url( '/js/main.js', __FILE__ ), array('jquery'), '1.0', false); 

 wp_enqueue_style('team_manager-normalize-css', TEAM_MANAGER_FREE_PLUGIN_PATH.'css/normalize.css');
 wp_enqueue_style('team_manager-awesome-css', TEAM_MANAGER_FREE_PLUGIN_PATH.'css/font-awesome.css');
 wp_enqueue_style('team_manager-style1-css', TEAM_MANAGER_FREE_PLUGIN_PATH.'css/style1.css');
 }
add_action('wp_enqueue_scripts', 'team_manager_free_initial_script');



/**********************************************************
 * load plugin admin style & scripts
 **********************************************************/

function team_manager_free_admin_scripts(){
	global $typenow;

	if(($typenow == 'team_mf')){
	wp_enqueue_style('team-manager-free-admin-style', TEAM_MANAGER_FREE_PLUGIN_PATH.'admin/css/team-manager-free-admin.css');
	wp_enqueue_style('team-manager-free-admin-font-awesome', TEAM_MANAGER_FREE_PLUGIN_PATH.'css/font-awesome.css');
	wp_enqueue_script('team-manager-free-admin-scripts', TEAM_MANAGER_FREE_PLUGIN_PATH.'admin/js/team-manager-free-admin.js', array('jquery'), '1.3.3', true );

	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script( 'team-manager-color-picker', plugins_url('/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
	}
}
add_action('admin_enqueue_scripts', 'team_manager_free_admin_scripts');


/**********************************************************
 * Custom enter title
 **********************************************************/
 
function team_manager_free_admin_enter_title( $input ) {
    global $post_type;

    if ( 'team_mf' == $post_type )
        return __( 'Enter Team Group Name', 'team-manager-free' );

    return $input;
}
add_filter( 'enter_title_here', 'team_manager_free_admin_enter_title' );


/**********************************************************
 * plugin activation/deactivation
 **********************************************************/

function active_team_manager_free(){

	require_once plugin_dir_path( __FILE__ ) . 'includes/team-manager-free-activator.php';
	Team_Manager_Free_Activator::activate();

}

function deactive_team_manager_free(){

	require_once plugin_dir_path(__FILE__) . 'includes/team-manager-free-deactivator.php';
	Team_Manager_Free_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'active_team_manager_free');
register_deactivation_hook(__FILE__, 'deactive_team_manager_free');



/**********************************************************
 * Register Team Manager Free Shortcode
 **********************************************************/



function team_manager_free_register_shortcode($atts, $content = null){
	$atts = shortcode_atts(
		array(
			'id' => "",
		), $atts);
		global $post;
		$post_id = $atts['id'];

		
		$content = '';
        $content.= Team_manager_free_table_body($post_id);
		return $content;
	
}
add_shortcode('tmfshortcode', 'team_manager_free_register_shortcode');





?>