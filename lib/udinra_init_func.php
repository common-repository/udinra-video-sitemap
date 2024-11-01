<?php

function udinra_video_admin_notice() {
	global $current_user ;
	$user_id = $current_user->ID;
	if ( ! get_user_meta($user_id, 'udinra_video_admin_notice') ) {
		echo '<div class="notice notice-info"><p>'; 
		printf(__('Are you using Videos then you must read it.<a href="https://udinra.com/downloads/udinra-video-sitemap-pro">Know More</a> | <a href="%1$s">Hide Notice</a>'), '?udinra_video_admin_ignore=0');
		echo "</p></div>";
	}
}

function udinra_video_admin_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( isset($_GET['udinra_video_admin_ignore']) && '0' == $_GET['udinra_video_admin_ignore'] ) {
		add_user_meta($user_id, 'udinra_video_admin_notice', 'true', true);
	}
}

function UdinraVideoWritable($udinra_filename) {
	if(!is_writable($udinra_filename)) {
		return false;
	}
	return true;
}

function Udinra_video_post_unpublished( $new_status, $old_status) {
	if(get_option('udinra-video-sitemap-freq') != 1) {
		if ( $old_status != 'publish'  &&  $new_status == 'publish') {
			udinra_video_sitemap_loop($udinra_sitemap_response);
		}
		if ( $old_status == 'publish'  &&  $new_status == 'publish') {
			udinra_video_sitemap_loop($udinra_sitemap_response);
		}
	}
}

function udinra_video_event() {
	initVideo();
	if(get_option('udinra-video-sitemap-freq') != 0) {
		udinra_video_sitemap_loop($udinra_sitemap_response);
	}
}

?>