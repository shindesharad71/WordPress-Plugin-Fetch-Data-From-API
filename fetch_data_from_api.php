<?php
/**
 * @package Fetch_Data_From_API
 * @version 1.0
 */
/*
Plugin Name: Fetch Data From API
Plugin URI: http://wordpress.org/plugins/fetch-data-from-api/
Description: This plugin is use to fetch data from given api and show in anywhere in post or page by using shortcode.
Author: Sharad Shinde
Version: 1.0
Author URI: http://sharadshinde.in/
*/

function get_data() {
	// Base url
	$base_url = 'https://jsonplaceholder.typicode.com';

	// Options
	$options = '/posts';

	// data call
	$output = wp_remote_get($base_url.$options);
	$output = $output['body'];
	$output = json_decode($output);
	$length = count($output);
	
	echo '<h3>Fetch Data Plugin Output Area</h3><br/>';
	for($i = 0; $i < $length; $i++) {
		echo "<div class='card'>
		<div class='container'>
		<h4>".$output[$i]->title."</h4>
		<p>".$output[$i]->body."</p>
		</div>
		</div>";
	}

	return false;
}

// Fetch Data Plugin Call for Data
function call_the_plugin() {
	$chosen = get_data();
	echo "<div class='card'>$chosen</div>";
}


// We need some CSS to show the output perfect!
function plugin_css() {
	echo '
	<style type="text/css">
	.container {
		padding: 2px 16px;
	}
	.card {
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
		border-radius: 5px;
	}
	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}	
	</style>
	';
}

// Short Code For Displaying Data
add_shortcode('fetch_api_plugin_shortcode', 'call_the_plugin');

// Add The Styling for plugin
add_action( 'admin_head', 'plugin_css' );

?>
