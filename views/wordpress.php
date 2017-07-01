<?php

namespace AJH\System_Report;

/**
 * Generates the output for the WordPress report
 *
 * @return string
 */
function get_wordpress_report() {

	ob_start();
	?>

	<h2 class="title">WordPress</h2>
	<p>Report of your WordPress installation.</p>

	<?php
	$items = [
		'Version'        => get_bloginfo( 'version' ),
		'ABSPATH'        => ABSPATH,
		'Admin Email'    => get_bloginfo( 'admin_email' ),
		'Language'       => get_bloginfo( 'language' ),
		'Stylesheet Dir' => get_bloginfo( 'stylesheet_directory' ),
		'Template Dir'   => get_bloginfo( 'template_directory' ),
		'Charset'        => get_bloginfo( 'charset' ),
		'URL'            => get_bloginfo( 'url' ),
		'WP URL'         => get_bloginfo( 'wpurl' ),
	];

	echo get_sys_report_list_table( $items );

	$output = ob_get_clean();

	return $output;
}