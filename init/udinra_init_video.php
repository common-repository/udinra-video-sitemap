<?php

$udinra_vid_pluginurl = plugins_url();

if ( preg_match( '/^https/', $udinra_vid_pluginurl ) && !preg_match( '/^https/', get_bloginfo('url') ) )
	$udinra_vid_pluginurl = preg_replace( '/^https/', 'http', $udinra_vid_pluginurl );

define( 'UDINRA_VID_FRONT_URL', $udinra_vid_pluginurl . '/udinra-video-sitemap/' );
global $wpdb;

$udinra_index_xml   = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$udinra_index_xml  .= '<?xml-stylesheet type="text/xsl" href='.'"'. UDINRA_VID_FRONT_URL . 'xsl/xml-index-sitemap.xsl'. '"'.'?>' .PHP_EOL;
$udinra_index_xml  .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

$udinra_index_sitemap_url = ABSPATH . '/sitemap-index-video.xml'; 
$udinra_date = Date(DATE_W3C);
$udinra_sitemap_response = '';
$udinra_sitemap_length = 1000;
$udinra_sitemap_count = 0;
$udinra_video_multisite = get_option('udinra_video_sitemap_multisite');

?>