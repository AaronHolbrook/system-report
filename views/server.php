<?php

namespace AJH\System_Report;

/**
 * Generates output for the server report
 *
 * @return string
 */
function get_server_report() {
	ob_start();
	?>

	<h2 class="title">Server</h2>
	<p>This shows a high level breakdown of what your server looks like.</p>

<pre>
	<?php echo esc_html( str_pad( 'Software:', 20 ) ); ?> <code><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></code>
	<?php echo esc_html( str_pad( 'Name:', 20 ) ); ?> <code><?php echo esc_html( $_SERVER['SERVER_NAME'] ); ?></code>
	<?php echo esc_html( str_pad( 'Address:', 20 ) ); ?> <code><?php echo esc_html( $_SERVER['SERVER_ADDR'] ); ?></code>
	<?php echo esc_html( str_pad( 'Port:', 20 ) ); ?> <code><?php echo esc_html( $_SERVER['SERVER_PORT'] ); ?></code>
</pre>

	<?php
	$output = ob_get_clean();

	return $output;
}