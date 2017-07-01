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
function get_system_report_page( $force = false ) {
	$cache_key = 'ajh-system-report-page';

	$report_page_output = wp_cache_get( $cache_key );

	if ( false === $report_page_output || true === $force ) {

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

	echo get_server_report();

	echo get_php_report();

	echo get_wordpress_report();

	echo get_theme_report();

	echo get_plugins_report();

	echo get_database_report();

	$output = ob_get_clean();

	return $output;
}