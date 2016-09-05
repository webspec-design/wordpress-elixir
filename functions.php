<?php

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'THEMEPATH', get_stylesheet_directory() );
define( 'IMAGES', THEMEROOT . '/build/img' );
define( 'SCRIPTS', THEMEROOT . '/build/js' );
define( 'STYLES', THEMEROOT . '/build/css' );
define( 'IMAGES_PATH', THEMEPATH . '/build/img' );

require_once('includes/WP_Bootstrap_Navwalker.php');

class ReplaceMeTheme {
	private static $self = false;
	private static $isInitialized = false;

	function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
		add_action('init', array($this, 'menus_image_sizes'));
		add_action('after_setup_theme', array($this, 'theme_support'));
	}

	public static function getInstance() {
		if(!self::$isInitialized) {
			self::$self = new self();
			self::$isInitialized = true;
		}
		return self::$self;
	}

	/*
	* Opt the theme into WordPress controlled title tags
	* By opting into this feature the <title> element should be left out of <head>
	* @since 4.1
	*/
	public static function theme_support() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	}

	public static function wp_enqueue_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('replaceme_scripts', SCRIPTS . '/main.js', array(), filemtime(get_stylesheet_directory().'/build/js/main.js'));
		wp_enqueue_style('replaceme_styles', STYLES . '/main.css', array(), filemtime(get_stylesheet_directory().'/build/css/main.css'));
	}

	public static function menus_image_sizes() {
		register_nav_menus(array(
			'navigation-menu' => 'Navigation Menu'
		));

		//Fullscreen image
		add_image_size('fullscreen', 1920, 1080);
	}

	public static function image($id, $size='', $icon='', $attr=array()) {
		$img = wp_get_attachment_image($id, $size, $icon, $attr);
		$img = preg_replace( '/(width|height)="\d*"\s/', "", $img );
		return $img;
	}
}

ReplaceMeTheme::getInstance();
