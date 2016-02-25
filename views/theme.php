<?php

namespace AJH\System_Report;

/**
 * Generates output for the theme report
 *
 * @return string
 */
function get_theme_report() {

	$theme = wp_get_theme();
	ob_start();
	?>
	<h2 class="title">Theme</h2>
	<p>Information on the current active theme.</p>

<pre>
	<?php echo esc_html( str_pad( 'Name:', 20 ) ); ?> <code><?php echo esc_html( $theme->get( 'Name' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Author:', 20 ) ); ?> <code><?php echo esc_html( $theme->get( 'Author' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Author URI:', 20 ) ); ?> <code><?php echo esc_html( $theme->get( 'AuthorURI' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Version:', 20 ) ); ?> <code><?php echo esc_html( $theme->get( 'Version' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Theme Root:', 20 ) ); ?> <code><?php echo esc_html( $theme->theme_root ); ?></code>
	<?php echo esc_html( str_pad( 'Template:', 20 ) ); ?> <code><?php echo esc_html( $theme->get( 'Template' ) ); ?></code>
</pre>
	<?php
	$output = ob_get_clean();

	return $output;
}