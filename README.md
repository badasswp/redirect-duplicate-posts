# redirect-duplicate-posts
Redirect Duplicate Posts

For e.g. `https://example.com/hello-world-2` -> `https://example.com/hello-world`

## Download

Download from [WordPress plugin repository](https://wordpress.org/plugins/redirect-duplicate-posts/).

You can also get the latest version from any of our [release tags](https://github.com/badasswp/redirect-duplicate-posts/releases).

## Why Redirect Duplicate Posts?

Working with translation plugins can be sometimes stressful, especially if your post or article is erroneously translated into multiple copies which you never intended.

This plugin helps redirect users away from duplicate posts and articles to the original post URL, thereby improving Search Engine Optimization for your WP website.

### Hooks

#### `redirect_duplicate_posts_exclude_urls`

This custom hook (filter) provides the ability to exclude a specific URL from redirection:

```php
add_filter( 'redirect_duplicate_posts_exclude_urls', [ $this, 'filter_exclude_urls' ], 10, 1 );

public function filter_exclude_urls( $urls ): array {
    $urls[] = 'https://exmaple.com/hello-world-2';

    return $urls;
}
```

**Parameters**

- urls _`{string[]}`_ List of URLs to exclude.
<br/>

#### `redirect_duplicate_posts_redirect_url`

This custom hook (filter) provides the ability to filter the redirect URL. For e.g you can do:

```php
add_filter( 'redirect_duplicate_posts_redirect_url', [ $this, 'filter_redirect_url' ], 10, 3 );

public function filter_redirect_url( $redirect_url, $current_url, pattern ): string {
    if ( 'https://example.com/hello-world-2' === $redirect_url ) {
        error_log( 'Error: Redirect URL not working as expected' );
    }
}
```

**Parameters**

- redirect_url _`{string}`_ Redirect URL. By default, this would be the Redirect URL.
- current_url _`{string}`_ Current URL. By default, this would be the Current URL of the duplicate post.
- pattern _`{string}`_ Regex Pattern. By default, this would be a regex pattern to help with matching duplicate posts.
<br/>

#### `redirect_duplicate_posts_regex_pattern`

This custom hook (filter) provides the ability to filter the regex pattern. For e.g you can do:

```php
add_filter( 'redirect_duplicate_posts_regex_pattern', [ $this, 'filter_regex_pattern' ], 10, 1 );

public function filter_regex_pattern( $pattern ): string {
    return '/-(?:[2-9])\/?$/';
}
```

**Parameters**

- pattern _`{string}`_ Regex Pattern. By default this would be a regex pattern to help with matching duplicate posts.
<br/>

---

## Contribute

Contributions are __welcome__ and will be fully __credited__. To contribute, please fork this repo and raise a PR (Pull Request) against the `master` branch.