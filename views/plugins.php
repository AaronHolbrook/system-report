<?php

namespace AJH\System_Report;

/**
 * Generates output for the plugins report
 *
 * @return string
 */
function get_plugins_report() {

	$plugins = get_plugins();

	ob_start();
	?>

	<h2 class="title">Plugins</h2>
	<p>Report of your WordPress installation.</p>

	<?php
	$items = [];
	foreach ( $plugins as $plugin_file => $plugin ) {
		$value = sprintf( "[%s] - %s",
			is_plugin_active( $plugin_file ) ? 'Active' : 'Inactive',
			$plugin['Version']
		);
		$items[ $plugin['Title'] ] = $value;
	}

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}