<?php

namespace AJH\System_Report;

// This portion of the plugin is only usable via WP_CLI
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

\WP_CLI::add_command( 'sr', __NAMESPACE__ . '\WP_CLI_Command' );

class WP_CLI_Command extends \WP_CLI_Command {

	/**
	 * Output report to the command line
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	function report( $args, $assoc_args ) {
		\WP_CLI::success( wp_strip_all_tags( get_system_report_page() ) );
	}
}