<?php

namespace AJH\System_Report;

/**
 * Generates the output for the WordPress report
 *
 * @return string
 */
function get_wordpress_report() {

	ob_start();
	?>

	<h2 class="title">WordPress</h2>
	<p>Report of your WordPress installation.</p>

<pre>
	<?php echo esc_html( str_pad( 'Version:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'version' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Admin Email:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'admin_email' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Language:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'language' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Stylesheet Dir:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'stylesheet_directory' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Template Dir:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'template_directory' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Charset:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'charset' ) ); ?></code>
	<?php echo esc_html( str_pad( 'URL:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'url' ) ); ?></code>
	<?php echo esc_html( str_pad( 'WP URL:', 20 ) ); ?> <code><?php echo esc_html( get_bloginfo( 'wpurl' ) ); ?></code>
</pre>

	<?php
	$output = ob_get_clean();

	return $output;
}