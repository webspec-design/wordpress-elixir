<?php
/**
 * Plugin Name: CCPCore
 * Description: Core functionality for the replaceme site.
 */

class CCPCore {

	function __construct() {
		if(function_exists('acf_update_setting')) {
			acf_update_setting('save_json', plugin_dir_path(__FILE__) . 'acf-json');
			acf_append_setting('load_json', plugin_dir_path(__FILE__) . 'acf-json');
		}
	}
}

$CCPCore = new CCPCore();
?>