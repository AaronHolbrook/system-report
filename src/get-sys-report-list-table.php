<?php

namespace AJH\System_Report;

function get_sys_report_list_table( $items ) {
	ob_start();

	$sys_report_list_table = new System_Report_List_Table( $items );
	$sys_report_list_table->display();

	return ob_get_clean();
}