# Odds Comparison WordPress Plugin

The Odds Comparison plugin allows you to display odds from various bookmakers for different markets in your WordPress site. It includes an admin dashboard where you can configure the bookmakers and markets to be displayed on the front end.

## Installation

1. Download the plugin ZIP file from the GitHub repository or release page.

2. Log in to your WordPress admin dashboard.

3. Navigate to "Plugins" > "Add New."

4. Click the "Upload Plugin" button at the top of the page.

5. Choose the plugin ZIP file and click "Install Now."

6. Once the plugin is installed, click "Activate" to activate the Odds Comparison plugin.

## Configuration

1. After activating the plugin, you'll see a new menu item called "Odds Comparison" in the WordPress admin dashboard. Click on it to access the plugin settings.

2. In the "Odds Comparison Settings" page, you can select the bookmakers and markets you want to display odds for. The bookmakers and markets are fetched from the database table, so make sure you have added them to the table before configuring.

3. Select the bookmakers and markets you want to display and click "Save Changes" to save your settings.

## Bookmakers Database

1. The plugin uses a MySQL database table to store bookmaker information. Make sure you have set up a database table named `bookmakers` with a column named `bookmaker` to store the bookmaker names.

2. You can manually add bookmakers to the table using a MySQL client or tool like phpMyAdmin.

## Scraping with Python and Cron Job

To optimize the odds scraping process and minimize the impact on your WordPress site's performance, the Odds Comparison plugin uses Python for scraping and scheduling the task as a cron job. By keeping the scraping separate from the WordPress plugin, the plugin can focus on efficiently fetching and displaying the odds data without the need for frequent scraping requests.

### Scraping with Python

The odds scraping is performed using Python, leveraging libraries like BeautifulSoup and requests to extract data from the odds comparison site. The Python script, `scraper.py`, fetches odds data from a specific URL and stores it in a MySQL database table named `odds_comparison`. The script can be executed manually or integrated into a cron job for automated hourly scraping.

### Cron Job for Hourly Scraping

To automate the odds scraping process, we set up a cron job on the system to run the `scraper.py` script hourly. The cron job ensures that the odds data is regularly updated in the database, providing the most recent odds for the selected bookmakers and markets. The scheduling of the cron job can be customized based on your specific needs.

By separating the scraping from the WordPress plugin, we achieve better optimization and performance for the Odds Comparison feature. The WordPress plugin can then focus on fetching the odds data from the database, providing a smooth and responsive user experience for visitors.

Please note that the Python script and cron job are essential components of the Odds Comparison solution and need to be configured properly for accurate and up-to-date odds data.

## Gutenberg Block

The plugin also includes a Gutenberg block named "Odds Comparison" that can be added to WordPress posts and pages.

To add the block, create a new post or edit an existing one.

Search for the "Odds Comparison" block in the Gutenberg block inserter and add it to your post.

The block will display odds data from the selected bookmakers and markets based on the settings configured in the admin dashboard.

## Support

If you encounter any issues or have questions about the plugin, you can reach out to the plugin's developer or open an issue on the GitHub repository.

## Contributions

Contributions to the Odds Comparison plugin are welcome! If you find a bug or have an improvement suggestion, feel free to create a pull request on the GitHub repository.

## License

This plugin is released under the MIT License. You can find the full license text in the `LICENSE` file.
