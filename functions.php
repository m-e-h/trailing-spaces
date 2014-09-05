<?php
/**
 * @package    Terminal
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2014, Marty Helmick
 * @link       http://themehybrid.com/themes/terminal
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'terminal_theme_setup' );

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function terminal_theme_setup() {

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
	add_filter( 'theme_mod_color_menu', 'terminal_color_menu' );

	/*
	 * Add a custom default color for the "primary" color option.
	 */
	add_filter( 'theme_mod_color_primary', 'terminal_color_primary' );

	/*
	 * Add child theme fonts to editor styles.
	 */
	add_editor_style( terminal_fonts_url() );

}

/**
 * Filters the header icon to set the default.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $icon
 * @return string
 */
function terminal_theme_mod_header_icon( $icon ) {
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
function terminal_color_menu( $hex ) {
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
function terminal_color_primary( $hex ) {
	return $hex ? $hex : '2980b9';
}

/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 * @return void
 */
function terminal_scripts() {

	/* Dequeue parent theme fonts. */
	wp_dequeue_style( 'saga-fonts' );

	/* Enqueue child themes fonts. */
	wp_enqueue_style( 'terminal-fonts', terminal_fonts_url(), array(), null );

}
add_action( 'wp_enqueue_scripts', 'terminal_scripts', 11 );

/**
 * Enqueue theme fonts in admin header page.
 *
 * @since  1.0.0
 * @return void
 */
function terminal_custom_header_fonts() {
	wp_enqueue_style( 'terminal-fonts', terminal_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'terminal_custom_header_fonts' );

/**
 * Return the Google font stylesheet URL.
 *
 * @since  1.0.0
 * @return string
 */
function terminal_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Fira Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$fira_sans = _x( 'on', 'Fira Sans font: on or off', 'terminal' );

	/* Translators: If there are characters in your language that are not
	 * supported by Source Code Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_code_pro = _x( 'on', 'Source Code Pro font: on or off', 'terminal' );

	if ( 'off' !== $fira_sans || 'off' !== $source_code_pro ) {
		$font_families = array();

		if ( 'off' !== $fira_sans )
			$font_families[] = 'Fira Sans:300,400,500,700';

		if ( 'off' !== $source_code_pro )
			$font_families[] = 'Source Code Pro:200,300,400,500,600';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

