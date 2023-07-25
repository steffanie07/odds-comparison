<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


add_action( 'rest_api_init', function () {
    register_rest_route( 'odds/v1', '/odds', array(
        'methods' => 'GET',
        'callback' => 'get_odds_data',
    ));

    register_rest_route( 'odds/v1', '/bookmakers', array(
        'methods' => 'GET',
        'callback' => 'get_bookmakers_data',
    ));
});

function get_odds_data() {
    global $wpdb;
    $odds_table = $wpdb->prefix . 'odds_comparison';
    $odds = $wpdb->get_results("SELECT * FROM $odds_table");

    return new WP_REST_Response($odds, 200);
}

function get_bookmakers_data() {
    global $wpdb;
    $bookmakers_table = $wpdb->prefix . 'odds_comparison';
    $bookmakers = $wpdb->get_results("SELECT DISTINCT bookmaker FROM $bookmakers_table");

    return new WP_REST_Response($bookmakers, 200);
}


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
