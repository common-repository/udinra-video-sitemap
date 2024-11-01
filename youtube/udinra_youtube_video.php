<?php

$udinra_first_time = 0;
$post_id = get_post($udinra_post->ID);
$udinra_post->post_content = apply_filters( 'the_content_export', $post_id->post_content);

if (preg_match_all ("#(?:https?:)?//www\.youtube(?:\-nocookie)?\.com/(?:v|e|embed)/([A-Za-z0-9\-_]+)#",$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			$udinra_video_details = json_decode($udinra_video_details['body']);
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>"."https://www.youtube.com/watch?v=".htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}	
	}		
}

if (preg_match_all ("#(?:https?(?:a|vh?)?://)?(?:www\.)?youtube(?:\-nocookie)?\.com/watch\?.*v=([A-Za-z0-9\-_]+)#",$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			$udinra_video_details = json_decode($udinra_video_details['body']);
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>".'https://www.youtube.com/watch?v='.htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}	
	}		
}

if (preg_match_all ("#(?:https?(?:a|vh?)?://)?youtu\.be/([A-Za-z0-9\-_]+)#",$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_video_details = json_decode($udinra_video_details['body']);
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>".'https://www.youtube.com/watch?v='.htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}
	}		
}
if (preg_match_all ('#\[video_lightbox_youtube video_id="([A-Za-z0-9\-_]+)"[^>*]#',$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_video_details = json_decode($udinra_video_details['body']);
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>".'https://www.youtube.com/watch?v='.htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}
	}		
}
if (preg_match_all ('#<div class="lyte" id="([A-Za-z0-9\-_]+)"#',$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_video_details = json_decode($udinra_video_details['body']);
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>".'https://www.youtube.com/watch?v='.htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}
	}		
}
if (preg_match_all ('#data-youtube-id="([A-Za-z0-9\-_]+)"#',$udinra_post->post_content, $udinra_matches_vid, PREG_SET_ORDER)) {
	foreach ($udinra_matches_vid as $udinra_match) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
		$udinra_video_details = wp_remote_get($api_url, array('timeout' => 20, 'sslverify' => false));
		if(is_wp_error($udinra_video_details)) {
		}
		else {
			if($udinra_video_details->pageInfo->totalResults > 0) {
				if ($udinra_first_time == 0) {
					$udinra_xml_video .= "\t"."<url>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."<loc>".htmlspecialchars(get_permalink($udinra_post->ID))."</loc>".PHP_EOL;
					$udinra_first_time = 1;
				}
				$udinra_video_details = json_decode($udinra_video_details['body']);
				$udinra_interval = new DateInterval($udinra_video_details->items[0]->contentDetails->duration);
				$udinra_video_duration = $udinra_interval->h * 3600 + $udinra_interval->i * 60 + $udinra_interval->s;
				$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$udinra_match[1]."&key=AIzaSyC7m39SADVlXVhCcTUOQPzGPDUD_CNvLt4";
				$udinra_video_details = wp_remote_get($api_url);
				if(is_wp_error($udinra_video_details)) {
				}
				else {
					$udinra_video_details = json_decode($udinra_video_details['body']);
					$udinra_xml_video .= "\t\t"."<video:video>".PHP_EOL;	
					$udinra_xml_video .= "\t\t\t"."<video:content_loc>".'https://www.youtube.com/watch?v='.htmlspecialchars($udinra_match[1])."</video:content_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:title>".htmlspecialchars($udinra_video_details->items[0]->snippet->title)."</video:title>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:description>".htmlspecialchars($udinra_video_details->items[0]->snippet->description)."</video:description>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:thumbnail_loc>".htmlspecialchars($udinra_video_details->items[0]->snippet->thumbnails->high->url)."</video:thumbnail_loc>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:duration>".$udinra_video_duration."</video:duration>".PHP_EOL;
					$udinra_xml_video .= "\t\t\t"."<video:publication_date>".$udinra_video_details->items[0]->snippet->publishedAt."</video:publication_date>".PHP_EOL;
					$udinra_xml_video .= "\t\t"."</video:video>".PHP_EOL;	
				}
			}
		}
	}		
}
if ($udinra_first_time == 1) {
	$udinra_xml_video .= "\t"."</url>".PHP_EOL;
	$udinra_url_count = $udinra_url_count + 1;
}
?>
