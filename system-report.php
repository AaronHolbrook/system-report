<?php
/**
 * Plugin Name: System Report
 * Description: Quickly identify important aspects of your server, PHP, WordPress installation, theme, plugins and database.
 * Version:     2.1.0
 * Author:      Aaron Holbrook
 * Author URI:  http://aaronjholbrook.com
 */

/**
 * Copyright (c) 2017 Aaron Holbrook (email : tyrun@fastmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace AJH\System_Report;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cannot access page directly' );
}

/**
 * This plugin is restricted to only the highest echelons
 */
if ( ! is_admin() && ( defined( 'WP_CLI' ) && ! WP_CLI ) ) {
	return;
}

/**
 * File includes
 */
require_once __DIR__ . '/src/class-system-report-table.php';
require_once __DIR__ . '/src/get-sys-report-list-table.php';
require_once __DIR__ . '/src/system-load.php';
require_once __DIR__ . '/views/system-report.php';
require_once __DIR__ . '/views/server.php';
require_once __DIR__ . '/views/php.php';
require_once __DIR__ . '/views/wordpress.php';
require_once __DIR__ . '/views/theme.php';
require_once __DIR__ . '/views/plugins.php';
require_once __DIR__ . '/views/database.php';

// This plugin is only usable via WP_CLI
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once __DIR__ . '/wp-cli/wp-cli.php';
}

/**
 * Adds our System Report page to the Tools Menu
 */
add_action( 'admin_menu', function () {

	add_submenu_page(
		'tools.php',
		'System Report',
		'System Report',
		'manage_options',
		'system-report',
		__NAMESPACE__ . '\system_report_page'
	);
} );

/**
 * Main calling function that ties into the submenu request.
 *
 * Outputs the system report page
 */
function system_report_page() {

	?>
	<div class="wrap">
		<style>
			table.wp-list-table #setting {
				width: 30%;
			}
		</style>
		<h1>System Report</h1>

		<p>
			This system report stands to assist you in quickly identifying all aspects of your WordPress, plugin, server and database information at a glance.
		</p>
		<?php
		echo get_system_report_page();
		?>
	</div>
	<?php
}
