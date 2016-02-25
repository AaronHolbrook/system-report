<?php

namespace AJH\System_Report;

/**
 * Retrieve the output for the system report page
 *
 * Uses a cached version if possible, otherwise regenerates
 *
 * @param bool $force
 *
 * @return bool|mixed|string
 */
function get_system_report_page( $force = true ) {
	$cache_key = 'ajh-system-report-page';

	$report_page_output = wp_cache_get( $cache_key );

	if ( true === $force ) {

		$report_page_output = generate_system_report_page();

		wp_cache_set( $cache_key, $report_page_output, MINUTE_IN_SECONDS * 5 );
	}

	return $report_page_output;
}

/**
 * Generates the system report page
 *
 * @return string
 */
function generate_system_report_page() {

	ob_start();
	?>
	<div class="wrap">
		<h1>System Report</h1>

		<p>This system report stands to assist you in quickly identifying all aspects of your WordPress, plugin, server and database information at a glance.</p>

		<?php echo get_server_report(); ?>

		<?php echo get_php_report(); ?>

		<?php echo get_wordpress_report(); ?>

		<?php echo get_theme_report(); ?>

		<?php echo get_plugins_report(); ?>

	</div>

	<?php
	$output = ob_get_clean();

	return $output;
}