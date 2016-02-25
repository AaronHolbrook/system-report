<?php

namespace AJH\System_Report;

/**
 * Generates output for the PHP report
 *
 * @return string
 */
function get_php_report() {

	ob_start();
	?>

	<h2 class="title">PHP</h2>
	<p>PHP Configuration and INI settings.</p>


<pre>
	<?php echo esc_html( str_pad( 'Version:', 20 ) ); ?> <code><?php echo esc_html( phpversion() ); ?></code>
	<?php echo esc_html( str_pad( 'Display Errors:', 20 ) ); ?> <code><?php echo esc_html( ini_get( 'display_errors' ) ? 'true' : 'false' ) ; ?></code>
	<?php echo esc_html( str_pad( 'POST Max Size:', 20 ) ); ?> <code><?php echo esc_html( ini_get( 'post_max_size' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Error Log:', 20 ) ); ?> <code><?php echo esc_html( ini_get( 'error_log' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Max Execution Time:', 20 ) ); ?> <code><?php echo esc_html( ini_get( 'max_execution_time' ) ); ?></code>
	<?php echo esc_html( str_pad( 'Memory Limit:', 20 ) ); ?> <code><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></code>
</pre>

	<?php
	$output = ob_get_clean();

	return $output;
}