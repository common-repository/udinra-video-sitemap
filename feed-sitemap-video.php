<?php

status_header( '200' ); 
header( 'Content-Type: text/xml; charset=' . get_bloginfo( 'charset' ), true );

echo '<?xml version="1.0" encoding="' . get_bloginfo( 'charset' ) . '"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . PHP_EOL;

include 'init/udinra_init_video.php';
include 'youtube/udinra_youtube.php';
include 'exit/udinra_ping_video.php';
echo $udinra_xml_video;


?>