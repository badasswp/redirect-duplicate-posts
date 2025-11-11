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

add_action( 'template_redirect', __NAMESPACE__  . '\redirect_duplicate_posts' )

/**
 * Redirect Duplicate Posts.
 *
 * Redirect duplicate post URLs with trailing
 * -2 to -9 (but not -10+) to the canonical URL.
 *
 * @since 1.0.0
 *
 * @return void
 */
function redirect_duplicate_posts() : void {
	// Bail out, if not post or page.
	if ( ! is_singular() ) {
		return;
	}

	// The permalink for this post/page.
	$current_url = urldecode( get_permalink() );

	// Get Regex.
	$pattern = '/-(?:[2-9])\/?$/';

	// Match, if URL ends with -2 to -9.
	if ( preg_match( $pattern, $current_url ) ) {
		// Remove the -2 … -9 suffix.
		$redirect_url = preg_replace( $pattern, '', $current_url );

		wp_redirect( $redirect_url, 301 );
		exit;
	}
}