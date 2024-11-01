<?php

switch ($_POST['selfreq']) {
	case "daily":
		update_option('udinra_video_sitemap_freq',1);
		break;
	case "always":
		update_option('udinra_video_sitemap_freq',2);
		break;
	default:
		update_option('udinra_video_sitemap_freq',3);
		break;
}
?>