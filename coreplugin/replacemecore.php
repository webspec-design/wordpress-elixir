<?php
/**
 * Plugin Name: ReplaceMeCore
 * Description: Core functionality for the ReplaceMe site.
 */

class ReplaceMeCore {

	function __construct() {
		if(function_exists('acf_update_setting')) {
			acf_update_setting('save_json', plugin_dir_path(__FILE__) . 'acf-json');
			acf_append_setting('load_json', plugin_dir_path(__FILE__) . 'acf-json');
		}
	}
}

$ReplaceMeCore = new ReplaceMeCore();

class WebspecHelpers {
	function ws_get_attachment_image_url($id, $size) {
		$img = wp_get_attachment_image_src($id, $size);
		return $img[0];
	}
}

$WebspecHelpers = new WebspecHelpers();
?>