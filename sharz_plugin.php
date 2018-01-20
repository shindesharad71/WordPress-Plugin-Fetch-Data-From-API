<?php
/**
 * @package Sharz_Plugin
 * @version 1.0
 */
/*
Plugin Name: Sharz Test
Plugin URI: http://wordpress.org/plugins/sharz-test/
Description: This is test description.
Author: Sharad Shinde
Version: 1.0
Author URI: http://sharadshinde.in/
*/

function sharz_data() {
	// Base url
	$base_url = 'https://jsonplaceholder.typicode.com';

	// Options
	$options = '/posts';

	// data call
	$output = wp_remote_get($base_url.$options);
	$output = $output['body'];
	$output = json_decode($output);
	$length = count($output);
	
	echo '<h3>Sharz Plugin Area</h3><br/>';
	for($i = 0; $i < $length; $i++) {
		//print_r($output[$i]);
		echo "<div class='card'>
		<div class='container'>
		<h4>".$output[$i]->title."</h4>
		<p>".$output[$i]->body."</p>
		</div>
		</div>";
	}

	return false;
}

function sharz_images() {
	// Base url
	$base_url = 'https://jsonplaceholder.typicode.com';

	// Options
	$options = '/photos';

	// data call
	$output = wp_remote_get($base_url.$options);
	$output = $output['body'];
	$output = json_decode($output);
	$length = count($output);
	
	echo '<h3>Sharz Plugin Area- PHOTOS</h3><br/>';
	for($i = 0; $i < $length; $i++) {
		// print_r($output[$i]);
		print '<b>ID: </b>'.$output[$i]->id.'<br/>'.
				'<b>Title: </b>'.$output[$i]->title.'<br/>'.
				'<img height="100" width="100" src="'.$output[$i]->url.'"><br/><br/>';
	}
	
	return false;
}

// Sharz Plugin Call for Data
function hello_sharz() {
	$chosen = sharz_data();
	echo "<div class='card'>$chosen</div>";
}

// Sharz Plugin Call for Images
function hello_sharz_images() {
	$chosen = sharz_images();
	echo $chosen;
}

// Now we set that function up to execute when the admin_notices action is called
//add_action( 'admin_notices', 'hello_sharz' );

// We need some CSS to position the paragraph
function sharz_css() {
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

add_shortcode('sharz_test_shortcode', 'hello_sharz');

add_shortcode('sharz_test_images_shortcode', 'hello_sharz_images');
add_action( 'admin_head', 'sharz_css' );

?>
