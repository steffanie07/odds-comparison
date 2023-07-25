<?php
add_action('rest_api_init', function () {
  register_rest_route('odds-comparison/v1', '/odds/', array(
    'methods' => 'GET',
    'callback' => 'get_odds',
  ));
});

function get_odds() {
  global $wpdb;
  
  $table_name = $wpdb->prefix . 'odds_comparison';

  // Change the SQL query as needed
  $results = $wpdb->get_results("SELECT * FROM $table_name");
  
  return $results;
}
