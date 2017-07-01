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

	<?php
	$items = [
		'Software' => $_SERVER['SERVER_SOFTWARE'],
		'Name'     => $_SERVER['SERVER_NAME'],
		'Address'  => $_SERVER['SERVER_ADDR'],
		'Port'     => $_SERVER['SERVER_PORT'],
	];

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}