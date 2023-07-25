<?php
// Add a new settings page
// Add a new settings page
function add_my_custom_menu() {
    add_menu_page(
        'Odds Comparison Settings',
        'Odds Comparison',
        'manage_options',
        'odds-comparison',
        'odds_comparison_page_content',
        'dashicons-tickets',
        20
    );
}
add_action( 'admin_menu', 'add_my_custom_menu' );

// Generate the content of the settings page
function odds_comparison_page_content() {
    ?>
    <div class="wrap">
   <?php var_dump($_POST); ?>
        <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('odds_comparison_settings');
            do_settings_sections('odds_comparison_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function odds_comparison_settings_init() {
    register_setting('odds_comparison_settings', 'odds_comparison_settings');

    add_settings_section(
        'odds_comparison_section',
        __('Odds Comparison Settings Section', 'textdomain'),
        '',
        'odds_comparison_settings'
    );

    // Add field for selecting bookmakers
    add_settings_field(
        'bookmakers',
        __('Select Bookmakers', 'textdomain'),
        'bookmakers_field_callback',
        'odds_comparison_settings',
        'odds_comparison_section'
    );

    // Add field for selecting markets
    add_settings_field(
        'markets',
        __('Select Markets', 'textdomain'),
        'markets_field_callback',
        'odds_comparison_settings',
        'odds_comparison_section'
    );

    // Add field for controlling links to bookmakers
    add_settings_field(
        'bookmaker_links',
        __('Control Links to Bookmakers', 'textdomain'),
        'bookmaker_links_field_callback',
        'odds_comparison_settings',
        'odds_comparison_section'
    );
}
add_action('admin_init', 'odds_comparison_settings_init');

// Define the callback for selecting bookmakers
function bookmakers_field_callback() {
    $options = get_option('odds_comparison_settings');

    global $wpdb;
    $bookmakers_table = $wpdb->prefix . 'odds_comparison';
    $bookmakers = $wpdb->get_results("SELECT bookmaker FROM $bookmakers_table");

    foreach ($bookmakers as $bookmaker) {
        $name = $bookmaker->bookmaker;
        $checked = (isset($options['bookmakers']) && in_array($name, $options['bookmakers'])) ? 'checked' : '';
        ?>

        <label>
            <input type="checkbox" name="odds_comparison_settings[bookmakers][]" value="<?php echo esc_attr($name); ?>" <?php echo esc_attr($checked); ?>>
            <?php echo esc_html($name); ?>
        </label>
        <br>
        <?php
    }
}
function markets_field_callback() {
    $options = get_option('odds_comparison_settings');
    
    global $wpdb;
    $bookmakers_table = $wpdb->prefix . 'odds_comparison';
    $markets = $wpdb->get_results("SELECT DISTINCT market FROM $bookmakers_table");

    foreach ($markets as $market) {
        $name = $market->market;
        $checked = (isset($options['market']) && in_array($name, $options['market'])) ? 'checked' : '';
        ?>
        <label>
            <input type="checkbox" name="odds_comparison_settings[market][]" value="<?php echo esc_attr($name); ?>" <?php echo esc_attr($checked); ?>>
            <?php echo esc_html($name); ?>
        </label>
        <br>
        <?php
    }
}


// Define the callback for controlling links to bookmakers
function bookmaker_links_field_callback() {
    $options = get_option('odds_comparison_settings');

    global $wpdb;
    $bookmakers_table = $wpdb->prefix . 'odds_comparison';
    $bookmakers = $wpdb->get_results("SELECT DISTINCT bookmaker FROM $bookmakers_table");

    foreach ($bookmakers as $bookmaker) {
        $name = $bookmaker->bookmaker;
        $checked = (isset($options['bookmaker_links']) && in_array($name, $options['bookmaker_links'])) ? 'checked' : '';
        ?>
        <label>
            <input type="checkbox" name="odds_comparison_settings[bookmaker_links][]" value="<?php echo esc_attr($name); ?>" <?php echo esc_attr($checked); ?>>
            <?php echo esc_html($name); ?>
        </label>
        <br>
        <?php
    }
}




// Define the callback for selecting markets

