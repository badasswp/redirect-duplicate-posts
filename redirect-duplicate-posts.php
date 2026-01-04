<?php
/**
 * Plugin Name: Redirect Duplicate Posts
 * Plugin URI:  https://github.com/badasswp/redirect-duplicate-posts
 * Description: Redirect duplicate post URLs to original URL.
 * Version:     1.0.0
 * Author:      badasswp
 * Author URI:  https://github.com/badasswp
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: redirect-duplicate-posts
 * Domain Path: /languages
 *
 * @package RedirectDuplicatePosts
 */

namespace badasswp\RedirectDuplicatePosts;

if ( ! defined( 'WPINC' ) ) {
	exit;
}

define( 'RDP_AUTOLOAD', __DIR__ . '/vendor/autoload.php' );

// Composer Check.
if ( ! file_exists( RDP_AUTOLOAD ) ) {
	add_action(
		'admin_notices',
		function () {
			vprintf(
				/* translators: Plugin directory path. */
				esc_html__( 'Fatal Error: Composer not setup in %s', 'redirect-duplicate-posts' ),
				[ __DIR__ ]
			);
		}
	);

	return;
}

// Run Plugin.
require_once RDP_AUTOLOAD;
( \RedirectDuplicatePosts\Plugin::get_instance() )->run();