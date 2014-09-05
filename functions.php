<?php
/**
 * @package    CMD
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2014, Marty Helmick
 * @link       https://github.com/m-e-h/cmd
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'cmd_theme_setup' );

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function cmd_theme_setup() {

	/*
	 * Add a custom background to overwrite the defaults.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '2c3e50',
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
			'default-text-color' => 'ecf0f1',
			'default-image'      => ''
		)
	);

	/*
	 * Add a custom default color for the "menu" color option.
	 */
	add_filter( 'theme_mod_color_menu', 'cmd_color_menu' );

	/*
	 * Add a custom default color for the "primary" color option.
	 */
	add_filter( 'theme_mod_color_primary', 'cmd_color_primary' );

	/*
	 * Add child theme fonts to editor styles.
	 */


/**
 * Filters the header icon to set the default.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $icon
 * @return string
 */
function cmd_theme_mod_header_icon( $icon ) {
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
function cmd_color_menu( $hex ) {
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
function cmd_color_primary( $hex ) {
	return $hex ? $hex : '2980b9';
}

/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 * @return void
 */
 add_action( 'wp_enqueue_scripts', 'cmd_enqueue_styles' );
 
function cmd_enqueue_styles() {

	/* Dequeue parent theme fonts. */
	wp_dequeue_style( 'saga-fonts' );

	/* Enqueue child themes fonts. */
	wp_enqueue_style( 'cmd-fonts', '//fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700|Source+Code+Pro:200,300,400,500,600' );

}

}