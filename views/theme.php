<?php

namespace AJH\System_Report;

/**
 * Generates output for the theme report
 *
 * @return string
 */
function get_theme_report() {

	$theme = wp_get_theme();
	ob_start();
	?>
	<h2 class="title">Theme</h2>
	<p>Information on the current active theme.</p>

	<?php
	$items = [
		'Name'       => $theme->get( 'Name' ),
		'Author'     => $theme->get( 'Author' ),
		'Author URI' => $theme->get( 'AuthorURI' ),
		'Version'    => $theme->get( 'Version' ),
		'Theme Root' => $theme->theme_root,
		'Template'   => $theme->get( 'Template' ),
	];

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}