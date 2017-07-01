<?php

namespace AJH\System_Report;

/**
 * Generates output for the database report
 *
 * @return string
 */
function get_database_report() {
	global $wpdb;

	$tables  = get_table_count();
	$rows    = get_row_count();
	$options = get_option_count();
	$posts   = get_post_count();

	ob_start();
	?>

	<h2 class="title">Database</h2>
	<p>This shows some basic information about your database.</p>

	<?php
	$items = [
		'Version'       => $wpdb->db_version(),
		'Base Prefix'   => $wpdb->base_prefix,
		'Table Count'   => $tables,
		'Row Count'     => $rows . 'k',
		'Option Count'  => $options,
		'Post Count'    => $posts,
		'Database Host' => $wpdb->dbhost,
		'Database Name' => $wpdb->dbname,
		'Tables'        => implode( ', ', $wpdb->tables ),
	];

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}

/**
 * Get the count of tables in this DB
 *
 * @return bool
 */
function get_table_count() {
	global $wpdb;

	$tables = $wpdb->get_row(
		$wpdb->prepare(
			'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = %s',
			$wpdb->dbname
		),
		ARRAY_N
	);

	if ( empty( $tables[0] ) ) {
		return false;
	}

	return $tables[0];
}

/**
 * Get a rough row count
 *
 * @return bool|string
 */
function get_row_count() {
	global $wpdb;

	$rows = $wpdb->get_row(
		$wpdb->prepare(
			'
			SELECT SUM( TABLE_ROWS )
			FROM INFORMATION_SCHEMA.TABLES
			WHERE TABLE_SCHEMA = "%s"',
			$wpdb->dbname
		),
		ARRAY_N
	);

	if ( empty( $rows[0] ) ) {
		return false;
	}

	return number_format( round( floatval( $rows[0] ) / 1000, 1 ), 2 );
}

/**
 * Get the option count
 *
 * @return bool|string
 */
function get_option_count() {
	global $wpdb;

	$options = $wpdb->get_row(
		"
		SELECT COUNT( * )
		FROM $wpdb->options",
		ARRAY_N
	);

	if ( empty( $options[0] ) ) {
		return false;
	}

	return number_format( floatval( $options[0] ) );
}

/**
 * Get the post count
 *
 * @return bool|string
 */
function get_post_count() {
	global $wpdb;

	$posts = $wpdb->get_row(
		"
		SELECT COUNT( * )
		FROM $wpdb->posts",
		ARRAY_N
	);

	if ( empty( $posts[0] ) ) {
		return false;
	}

	return number_format( floatval( $posts[0] ) );
}