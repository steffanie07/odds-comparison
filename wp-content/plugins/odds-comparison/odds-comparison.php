<?php
/**
 * Plugin Name:       Odds-comparison
 * Description:       Displays odds comparisons
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            Stephanie Boms
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       odds-comparison
 *
 * @package           odds-comparison
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
register_activation_hook(__FILE__, 'create_odds_table');
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';



function create_odds_table() {
    global $wpdb;
  
    $table_name = $wpdb->prefix . 'odds_comparison';

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            bookmaker tinytext NOT NULL,
			market tinytext NOT NULL,
		
            odds float NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function odds_comparison_odds_comparison_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'odds_comparison_odds_comparison_block_init' );

