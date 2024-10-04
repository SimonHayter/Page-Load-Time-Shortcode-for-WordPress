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
