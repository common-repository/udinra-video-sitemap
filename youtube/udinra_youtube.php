<?php

$udinra_sql = "SELECT max(out1.id) as maxid	FROM $wpdb->posts out1
	 			WHERE out1.post_status = 'publish'
				AND (out1.post_content like '%youtube.com%'
				OR out1.post_content like '%youtu.be%'
				OR out1.post_content like '%[video_lightbox_youtube%')
				ORDER BY out1.id,out1.post_date asc";
				
$udinra_max_limit = $wpdb->get_var($udinra_sql);

$udinra_sql = "SELECT min(out1.id) as minid FROM $wpdb->posts out1
	 			WHERE out1.post_status = 'publish'
				AND (out1.post_content like '%youtube.com%'
				OR out1.post_content like '%youtu.be%'
				OR out1.post_content like '%[video_lightbox_youtube%')
				ORDER BY out1.id,out1.post_date asc";

$udinra_max_id = $wpdb->get_var($udinra_sql);
$result_length = 0;
$udinra_min_id = 0;
$udinra_max_id = $udinra_max_id - 1;
$udinra_limit_flag = 0;
$udinra_url_count = 0;
$udinra_first_time = 0;
if ($udinra_video_multisite == 0) {
	$udinra_xml_video = '';
}

do {
	if ($result_length == 0) {
		$udinra_min_id = $udinra_max_id + 1;
		$udinra_max_id = $udinra_max_id + 100;
		if ($udinra_max_id > $udinra_max_limit && $udinra_limit_flag == 0) {
			$udinra_max_id = $udinra_max_limit;
			$udinra_limit_flag = 1;
		}
	}
	else {
		foreach ($udinra_posts as $udinra_post) { 
			if ($udinra_url_count == 0 && $udinra_video_multisite == 0) {
				$udinra_xml_video   = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
				$udinra_xml_video  .= '<?xml-stylesheet type="text/xsl" href='.'"'. UDINRA_VID_FRONT_URL . 'xsl/xml-video-sitemap.xsl'. '"'.'?>' . PHP_EOL;
				$udinra_xml_video  .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . PHP_EOL;
			}
			include 'udinra_youtube_video.php';
		}
		if ($udinra_url_count >= $udinra_sitemap_length) {
			include 'udinra_youtube_write.php';
		}
		$udinra_min_id = $udinra_max_id + 1;
		$udinra_max_id = $udinra_max_id + 100;
		if ($udinra_max_id > $udinra_max_limit && $udinra_limit_flag == 0) {
			$udinra_max_id = $udinra_max_limit;
			$udinra_limit_flag = 1;
		}
	}
	if ( $udinra_max_id <= $udinra_max_limit) {
		$udinra_sql = "SELECT out1.ID,out1.post_content	FROM $wpdb->posts out1
				 			WHERE out1.post_status = 'publish'
							AND out1.id BETWEEN $udinra_min_id AND $udinra_max_id
							AND (out1.post_content like '%youtube.com%'
							OR out1.post_content like '%youtu.be%'
							OR out1.post_content like '%[video_lightbox_youtube%')
							ORDER BY out1.id,out1.post_date asc";
		$udinra_posts = $wpdb->get_results($udinra_sql);
		$result_length = count($udinra_posts);
	}
}While($udinra_max_id <= $udinra_max_limit);
if ($udinra_url_count > 0) {
	include 'udinra_youtube_write.php';
}
?>