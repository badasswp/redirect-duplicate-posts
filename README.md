# redirect-duplicate-posts
Redirect Duplicate Posts

## Download

Download from [WordPress plugin repository](https://wordpress.org/plugins/redirect-duplicate-posts/).

You can also get the latest version from any of our [release tags](https://github.com/badasswp/redirect-duplicate-posts/releases).

## Why Redirect Duplicate Posts?

Working with translations plugins can be sometimes stressful, especially if your post or article is erroneously translated into multiple copies which you never intended.

This plugin helps redirect users away from duplicate posts and articles to the original post URL, thereby improving Search Engine Optimization for your WP website.

### Hooks

#### `redirect_duplicate_posts_exclude_url`

This custom hook (filter) provides the ability to exclude a specific URL from redirection:

```php
add_filter( 'redirect_duplicate_posts_exclude_url', [ $this, 'filter_exclude_url' ], 10, 1 );

public function filter_exclude_url( $urls ): array {
    $urls[] = 'https://exmaple.com/hello-world-2';

    return $urls;
}
```

**Parameters**

- urls _`{string[]}`_ List of URLs to exclude.
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