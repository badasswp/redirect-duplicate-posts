<?php
/**
 * Plugin Class.
 *
 * Register Plugin actions and filters within this
 * class for plugin use.
 *
 * @package RedirectDuplicatePosts
 */

namespace RedirectDuplicatePosts;

class Plugin {
	/**
	 * Plugin Instance.
	 *
	 * @since 1.0.0
	 *
	 * @var Plugin
	 */
	protected static $instance;

	/**
	 * Set up Instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Plugin
	 */
	public static function get_instance(): Plugin {
		if ( is_null( static::$instance ) ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	/**
	 * Run Plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'template_redirect', [ $this, 'redirect_duplicate_posts' ] );
	}

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
	public function redirect_duplicate_posts(): void {
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
		 * that they DON'T want re-directed.
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
		 * Provide a way for users to be able to
		 * modify the regex applied to URLs.
		 * 
		 * @since 1.0.0
		 * 
		 * @param string $pattern Regex Pattern.
		 * @return string
		 */
		$pattern = apply_filters( 'redirect_duplicate_posts_regex_pattern', $pattern );

		// Match, if URL ends with -2 to -9.
		if ( preg_match( $pattern, $current_url ) ) {
			/**
			 * Filter the Redirect URL.
			 * 
			 * Provide a way for users to able to filter
			 * the redirect URL. By default, remove the -2 … -9 suffix.
			 * 
			 * @since 1.0.0
			 * 
			 * @param string $redirect_url Redirect URL.
			 * @param string $current_url  Current URL.
			 * @param string $pattern      Regex Pattern.
			 * 
			 * @return string
			 */
			$redirect_url = apply_filters( 'redirect_duplicate_posts_redirect_url', preg_replace( $pattern, '', $current_url ), $current_url, $pattern );

			wp_safe_redirect( $redirect_url );
			exit;
		}
	}
}