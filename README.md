# Page Load Time Shortcode for WordPress

This shortcode will output the time it took to load the page in ms.

**Implementation**

1.  **Edit your `functions.php` file:** Add the code snippet to your theme's `functions.php` file or a custom plugin.
2.  **Display the load time:**  You have several options for displaying the time on your website:
    *   **Shortcode:** Simply use the `[page_load_time]` shortcode within the content of any page or post.
    *   **Theme Integration:**  Use `do_shortcode('[page_load_time]');` or `echo do_shortcode('[page_load_time]');` in your `header.php` or `footer.php` file, depending on your theme's structure.

**Code**
Add the code snippet to your theme's `functions.php` file or a custom plugin:

	function page_load_time_shortcode($atts, $content = null) {
	  $startTime = microtime(true);

	  // Sanitize the content to prevent XSS vulnerabilities
	  $sanitized_content = wp_kses_post($content); 

	  ob_start();
	  echo do_shortcode($sanitized_content); 
	  $output = ob_get_clean();
	  $endTime = microtime(true);
	  $pageLoadTime = round(($endTime - $startTime) * 1000, 2);
	  return $output . "<p>Page loaded in: " . $pageLoadTime . " ms</p>"; 
	}

	add_shortcode('page_load_time', 'page_load_time_shortcode');
