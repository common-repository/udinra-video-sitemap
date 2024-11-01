<?php
/*
Plugin Name: Udinra Video Sitemap
Plugin URI: https://udinra.com/downloads/udinra-video-sitemap-pro
Description: Automatically generates Google Video Sitemap and submits it to Google,Bing and Ask.com.
Author: Udinra
Version: 1.2.0
Author URI: https://udinra.com
*/

function Udinra_Video() {
	$udinra_sitemap_response = '';
	if(isset($_POST['save_option'])){
		include 'lib/udinra_save_options.php';
		$udinra_sitemap_response = "Options saved successfully";
	}
	if(isset($_POST['create_sitemap'])) {
		udinra_video_sitemap_loop($udinra_sitemap_response);
	}
	include 'lib/udinra-html-video.php';
}

function udinra_video_sitemap_loop(&$udinra_sitemap_response) {
	include 'init/udinra_init_video.php';
	include 'youtube/udinra_youtube.php';
	include 'exit/udinra_ping_video.php';
}

function Udinra_Video_sitemap_admin() {
	if (function_exists('add_options_page')) {
		add_options_page('Udinra Video Sitemap', 'Udinra Video Sitemap', 'manage_options', basename(__FILE__), 'Udinra_Video');
	}
}

function udinra_video_admin_style($hook) {
	if($hook == 'settings_page_udinra-video-sitemap') {
		wp_enqueue_style( 'udinra_video_pure_style', plugins_url('css/udstyle.css', __FILE__) );	
		wp_enqueue_script( 'udinra_image_pure_js', plugins_url('js/udinra_slideshow.js', __FILE__),array(), '1.0.0', true );
    }
}

function udinra_video_settings_plugin_link( $links, $file ) 
{
    if ( $file == plugin_basename(dirname(__FILE__) . '/udinra-video-sitemap.php') ) 
    {
        $in = '<a href="options-general.php?page=udinra-video-sitemap">' . __('Settings','udvideo') . '</a>';
        array_unshift($links, $in);
   }
    return $links;
}

function load_sitemap_index_video() {
	load_template( dirname( __FILE__ ) . '/feed-sitemap-video.php' );
}

include 'lib/udinra_init_func.php';
include 'lib/udinra_multisite_func.php';
 
register_activation_hook(__FILE__, 'udinra_video_act');
register_deactivation_hook(__FILE__, 'udinra_video_deact');

add_action( 'transition_post_status', 'Udinra_video_post_unpublished', 20, 2 );
add_action('admin_menu','Udinra_Video_sitemap_admin');	

add_action('admin_notices', 'udinra_video_admin_notice');
add_action('admin_init', 'udinra_video_admin_ignore');
add_action( 'do_feed_sitemap-index-video','load_sitemap_index_video',10,1 );
add_action( 'wpmu_new_blog', 'udinra_video_new_blog', 10, 6);        
add_action( 'admin_enqueue_scripts', 'udinra_video_admin_style' );
add_filter( 'plugin_action_links', 'udinra_video_settings_plugin_link', 10, 2 );

?>
