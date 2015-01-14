<?php
/**
 * @package    Trailing Spaces
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2014, Marty Helmick
 * @link       https://github.com/m-e-h/trailing-spaces
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'trailing_spaces_theme_setup' );

/**
 * Setup function.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function trailing_spaces_theme_setup() {

	/*
	 * Add a custom background to overwrite the defaults.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '073642',
			'default-image' => ''
		)
	);

	/*
	 * Add a custom header to overwrite the defaults.
	 *
	 * @link http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support(
		'custom-header',
		array(
			'default-text-color' => 'b58900',
			'default-image'      => '',
			'random-default'     => false,
		)
	);

	/* Add a custom default icon for the "header_icon" option. */
	add_filter( 'theme_mod_header_icon', 'trailing_spaces_theme_mod_header_icon' );

	/* Add a custom default color for the "menu" color option. */
	add_filter( 'theme_mod_color_menu', 'trailing_spaces_color_menu' );

	/* Add a custom default color for the "primary" color option. */
	add_filter( 'theme_mod_color_primary', 'trailing_spaces_color_primary' );
}


/**
 * Filters the header icon to set the default.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $icon
 * @return string
 */
function trailing_spaces_theme_mod_header_icon( $icon ) {
	return 'default' === $icon ? 'icon-terminal' : $icon;
}

/**
 * Add a default custom color for the theme's "menu" color option.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex
 * @return string
 */
function trailing_spaces_color_menu( $hex ) {
	return $hex ? $hex : '34495e';
}

/**
 * Add a default custom color for the theme's "primary" color option.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex
 * @return string
 */
function trailing_spaces_color_primary( $hex ) {
	return $hex ? $hex : '268BD2';
}

/**
 * Loads custom stylesheets for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */

/* Load stylesheets. */
add_action( 'wp_enqueue_scripts', 'trailing_spaces_enqueue_styles' );

function trailing_spaces_enqueue_styles() {

	/* Dequeue parent theme fonts. */
	wp_dequeue_style( 'saga-fonts' );

	/* Enqueue child themes fonts. */
	wp_enqueue_style( 'trailing_spaces-fonts', '//fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700|Source+Code+Pro:200,300,400,500,600' );
}
