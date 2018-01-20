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
		print '<b>ID: </b>'.$output[$i]->id.'<br/>'.
				'<b>Title: </b>'.$output[$i]->title.'<br/>'.
				'<b>Description: </b>'.$output[$i]->body.'<br/><br/>';
	}
	return false;
}

// Sharz Plugin Call
function hello_sharz() {
	$chosen = sharz_data();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
//add_action( 'admin_notices', 'hello_sharz' );

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_shortcode('sharz_test_shortcode', 'hello_sharz'); 
add_action( 'admin_head', 'dolly_css' );

?>
