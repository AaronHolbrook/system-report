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

	<?php
	$items = [
		'Version'            => phpversion(),
		'Display Errors'     => ini_get( 'display_errors' ) ? 'true' : 'false',
		'POST Max Size'      => ini_get( 'post_max_size' ),
		'Error Log'          => ini_get( 'error_log' ),
		'Max Execution Time' => ini_get( 'max_execution_time' ),
		'Memory Limit'       => ini_get( 'memory_limit' ),
	];

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}