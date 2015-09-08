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

		add_action('after_setup_theme', array($this, 'editor_roles'));
		add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'), 10, 4);
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

	public static function editor_roles() {
		$caps_set = get_option('ws_caps_set');
		if(!$caps_set) {
			$role = get_role('editor');
			$caps = ['edit_theme_options', 'edit_users', 'list_users', 'remove_users', 'add_users', 'delete_users', 'create_users', 'gform_full_access'];
			foreach($caps as $cap) {
				$role->add_cap($cap);
			}
			update_option('ws_caps_set', true);
		}
	}

	function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

	public static function wp_enqueue_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('replaceme_scripts', SCRIPTS . '/main.js', array(), filemtime(get_template_directory().'/build/js/main.js'));
		wp_enqueue_style('replaceme_styles', STYLES . '/main.css', array(), filemtime(get_template_directory().'/build/css/main.css'));
	}

	public static function menus_image_sizes() {
		register_nav_menus(array(
			'navigation-menu' => 'Navigation Menu'
		));
	}

	public static function image($id, $size='', $icon='', $attr=array()) {
		$img = wp_get_attachment_image($id, $size, $icon, $attr);
		$img = preg_replace( '/(width|height)="\d*"\s/', "", $img );
		return $img;
	}
}

ReplaceMeTheme::getInstance();
