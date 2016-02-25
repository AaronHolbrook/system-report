<?php

namespace AJH\System_Report;

/**
 * Generates output for the database report
 *
 * @return string
 */
function get_database_report() {
	global $wpdb;

	$tables = get_table_count();
	$rows = get_row_count();
	$options = get_option_count();
	$posts = get_post_count();

	ob_start();
	?>

	<h2 class="title">Database</h2>
	<p>This shows some basic information about your database.</p>

<pre>
	<?php echo esc_html( str_pad( 'Version:', 20 ) ); ?> <code><?php echo esc_html( $wpdb->db_version() ); ?></code>
	<?php echo esc_html( str_pad( 'Base Prefix:', 20 ) ); ?> <code><?php echo esc_html( $wpdb->base_prefix ); ?></code>
	<?php echo esc_html( str_pad( 'Table Count:', 20 ) ); ?> <code><?php echo esc_html( $tables ); ?></code>
	<?php echo esc_html( str_pad( 'Row Count:', 20 ) ); ?> <code><?php echo esc_html( $rows ); ?>k</code>
	<?php echo esc_html( str_pad( 'Option Count:', 20 ) ); ?> <code><?php echo esc_html( $options ); ?></code>
	<?php echo esc_html( str_pad( 'Post Count:', 20 ) ); ?> <code><?php echo esc_html( $posts ); ?></code>
</pre>

	<?php
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