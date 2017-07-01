<?php

namespace AJH\System_Report;

// Load the WP_List_Table class if it doesn't yet exist
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . '/wp-admin/includes/class-wp-list-table.php';
}

/**
 * Display the rewrite rules in an easy to digest list table
 */
class System_Report_List_Table extends \WP_List_Table {

	/**
	 * Construct the list table
	 */
	function __construct( $items ) {
		parent::__construct( [
			'plural' => 'Items',
		] );

		$this->prepare_items();

		$this->items( $items );
	}

	function items( $raw_items ) {

		$items = [];
		foreach ( $raw_items as $raw_key => $raw_setting ) {
			$items[] = [
				'setting' => $raw_key,
				'value'   => $raw_setting,
			];
		}

		$this->items = $items;
	}

	/**
	 * Load all of the items our list table
	 */
	function prepare_items() {
		$columns  = $this->get_columns();
		$hidden   = [];
		$sortable = [];

		$this->_column_headers = [
			$columns,
			$hidden,
			$sortable
		];
	}

	/**
	 * What to print when no items were found
	 */
	function no_items() {
		echo 'No items found.';
	}

	/**
	 * Display the navigation for the list table
	 */
	function display_tablenav( $which ) {
	}

	/**
	 * Define the columns for our list table
	 */
	function get_columns() {

		$columns = array(
			'setting' => 'Setting',
			'value'   => 'Value',
		);

		return $columns;

	}

	/**
	 * Display each row of rewrite rule data
	 */
	function display_rows() {
		foreach ( $this->items as $rewrite_rule => $rewrite_data ) {
			$rewrite_data['rule'] = $rewrite_rule;
			$this->single_row( $rewrite_data );
		}
	}

	/**
	 * Display a single row of rewrite rule data
	 */
	function single_row( $row ) {

		$setting = $row['setting'];
		$value   = $row['value'];

		$class = 'source-' . $value;

		echo "<tr class='$class'>";

		list( $columns, $hidden ) = $this->get_column_info();

		foreach ( $columns as $column_name => $column_display_name ) {

			switch ( $column_name ) {
				case 'setting':
					echo "<td class='column-setting'>" . esc_html( $setting ) . "</td>";
					break;
				case 'value':
					echo "<td class='column-value'><code>" . esc_html( $value ) . "</code></td>";
					break;
			}
		}

		echo "</tr>";
	}
}