<?php

if ( $udinra_video_multisite == 1) {
	$udinra_xml_video .= "</urlset>"; 
	$udinra_sitemap_response = '<a href='.get_bloginfo('url'). '/sitemap-index-video.xml'.' target="_blank" title="Video Sitemap URL">View Video Sitemap</a> <br />Submit this sitemap to Google Search Console (Google Webmasters) and others Bing Webmasters.';
}
else {
	$udinra_index_xml .= "</sitemapindex>";	
	if (get_option('udinra_video_sitemap_key')) {
		if (UdinraVideoWritable(ABSPATH) || UdinraVideoWritable($udinra_video_sitemap_url)) {
			file_put_contents ($udinra_index_sitemap_url, $udinra_index_xml);
			$udinra_sitemap_response = '<a href='.get_bloginfo('url'). '/sitemap-index-video.xml'.' target="_blank" title="Video Sitemap URL">View Video Sitemap</a> <br />Submit this sitemap to Google Search Console (Google Webmasters) and others Bing Webmasters.';
		}
		else {
			$udinra_sitemap_response = "The file sitemap-index-video.xml is not writable please check permission of the file";
		}
	}
	if (is_wp_error(wp_remote_get( "http://www.google.com/webmasters/tools/ping?sitemap=" . urlencode($udinra_index_sitemap_url) ))) {
	}
	if (is_wp_error(wp_remote_get( "http://www.bing.com/webmaster/ping.aspx?sitemap=" . urlencode($udinra_index_sitemap_url) ))) {
	}
	return $udinra_sitemap_response;
}
?>