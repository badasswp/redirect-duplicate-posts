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

	/**
	 * Filter Excluded URLs.
	 * 
	 * Provide a way for users to exclude URLs
	 * that they want re-directed.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string[] $urls Excluded URLs.
	 * @return string[]
	 */
	$urls = apply_filters( 'redirect_duplicate_posts_exclude_urls', [] );

	// Bail out, if is excluded URL.
	if ( in_array( $current_url, $urls, true ) ) {
		return;
	}

	// Get Regex.
	$pattern = '/-(?:[2-9])\/?$/';

	/**
	 * Filter the Regex Pattern.
	 * 
	 * Provide a way for users to able to modify
	 * the regex applied to URLs.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string $pattern Regex Pattern.
	 * @return string
	 */
	$pattern = apply_filters( 'redirect_duplicate_posts_regex_pattern', $pattern );

	// Match, if URL ends with -2 to -9.
	if ( preg_match( $pattern, $current_url ) ) {
		// Remove the -2 … -9 suffix.
		$redirect_url = preg_replace( $pattern, '', $current_url );

		wp_redirect( $redirect_url, 301 );
		exit;
	}
}