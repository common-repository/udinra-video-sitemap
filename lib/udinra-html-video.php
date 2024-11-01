<?php

?>
<div class="w3-card-4" style="width:100%;">
	<header class="w3-container w3-blue"><h1>Udinra Video Sitemap (Configuration)</h1></header>
    <form action="" method="post">
      <div class="w3-container">
        <select id="selfreq" name="selfreq" class="UdinraSelect" style="background-color: azure;">
			<option value="none" selected disabled ?> >How frequently Sitemap should be generated?</option>
            <option value="daily"   <?php if (get_option('udinra_video_sitemap_freq') == 1) echo "selected"; ?> >Daily (Best if you have large website)</option>
            <option value="always"  <?php if (get_option('udinra_video_sitemap_freq') == 2) echo "selected"; ?> >After page or post is changed / published</option>			
            <option value="both"    <?php if (get_option('udinra_video_sitemap_freq') == 3) echo "selected"; ?> >Both of above (default)</option>
        </select>
		<input type="submit" class="w3-button w3-ripple  w3-cyan" name="save_option" id="save_option" value="Save Configuration Options" />
		<input type="submit" class="w3-button w3-ripple w3-teal" name="create_sitemap" id="create_sitemap" value="Create Sitemap Manually" />
		<a href="https://wordpress.org/plugins/udinra-video-sitemap/" class="w3-button w3-ripple w3-sand">Please rate this plugin on WordPress.org</a>		
	</div>
	</form>
		<div class="w3-container">
		<div class="w3-row">
			<div class="w3-col s6 w3-pale-blue w3-center">
				<div class="UdinraFirstSlide w3-container w3-large w3-pale-blue w3-card-4">
					<h2>Image Sitemap Pro</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Only plugin with popular Gallery plugin support.</li>
						<li class="w3-hover-red">Only plugin with Meta Slider plugin support.</li>
						<li class="w3-hover-blue">Better eCommerce plugin support</li>
						<li class="w3-hover-green">Supports Visual Composer plugins</li>
					</ul>
					<a href="https://udinra.com/downloads/udinra-image-sitemap-pro" class="w3-button w3-ripple w3-teal">Click here to Know more about it</a>				
				</div>
				<div class="UdinraFirstSlide w3-container w3-large w3-pale-yellow w3-card-4">
					<h2>Mobile Sitemap Pro</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Only plugin with AMP plugin support.</li>
						<li class="w3-hover-red">Only plugin to create Mobile Sitemap from AMP pages.</li>
						<li class="w3-hover-blue">Increases AMP pages indexing</li>
						<li class="w3-hover-green">Better eCommerce plugin support</li>
					</ul>
					<a href="https://udinra.com/downloads/mobile-sitemap-pro-wordpress-plugin" class="w3-button w3-ripple w3-blue">Click here to Know more about it</a>
				</div>
				<div class="UdinraFirstSlide w3-container w3-large w3-pale-blue w3-card-4">
					<h2>Video Sitemap Pro</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Supports YouTube,Vimeo,Dailymotion.</li>
						<li class="w3-hover-red">Supports Twitch,Rutube,Funnyordie.</li>
						<li class="w3-hover-blue">Supports WooCommerce Videos</li>
						<li class="w3-hover-green">Supports popular Video and Visual Composer plugins</li>
					</ul>
					<a href="https://udinra.com/downloads/udinra-video-sitemap-pro" class="w3-button w3-ripple w3-blue">Click here to Know more about it</a>
				</div>				
			</div>
			<div class="w3-col s6 w3-pale-red w3-center">
				<div class="UdinraSecondSlide w3-container w3-large w3-pale-red w3-card-4">
					<h2>WooCommerce Shop Pro</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Turn WooCommerce Store into Pro eCommerce Store</li>
						<li class="w3-hover-red">Increases Sales by improving conversion rate.</li>
						<li class="w3-hover-blue">Fast and improved navigation</li>
						<li class="w3-hover-green">Filter products by Tags and Categories</li>
					</ul>
					<a href="https://udinra.com/downloads/woocommerce-shop-pro" class="w3-button w3-ripple w3-cyan">Click here to Know more about it</a>
				</div>		
				<div class="UdinraSecondSlide w3-container w3-large w3-sand w3-card-4">
					<h2>Easy Digital Downloads Shop Pro</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Turn EDD Store into Pro eCommerce Store</li>
						<li class="w3-hover-red">Increases Sales by improving conversion rate.</li>
						<li class="w3-hover-blue">Fast and improved navigation</li>
						<li class="w3-hover-green">Filter products by Tags and Categories</li>
					</ul>
					<a href="https://udinra.com/downloads/easy-digital-downloads-shop-pro" class="w3-button w3-ripple w3-yellow">Click here to Know more about it</a>					
				</div>	
				<div class="UdinraSecondSlide w3-container w3-large w3-sand w3-card-4">
					<h2>Social Content Locker</h2>
					<ul class="w3-ul w3-card-4">
						<li class="w3-hover-teal">Offer file download for social actions</li>
						<li class="w3-hover-red">Facebook,Twitter,Google Plus,YouTube support.</li>
						<li class="w3-hover-blue">Build your Brand on Social Sites</li>
						<li class="w3-hover-green">Google Analytics tracking of Social Actions</li>
					</ul>
					<a href="https://udinra.com/downloads/youtube-subscribe-to-download-pro" class="w3-button w3-ripple w3-yellow">Click here to Know more about it</a>					
				</div>				
			</div>
		</div>
	</div>
   <footer class="w3-container w3-blue">
		<p><?php echo "<h3>" . $udinra_sitemap_response . "</h3>" ; ?></p>	
	</footer>	
</div>
<?php
?>