<?php

namespace AJH\System_Report;

/**
 * Generates output for the plugins report
 *
 * @return string
 */
function get_plugins_report() {

	$plugins = get_plugins();

	ob_start();
	?>

	<h2 class="title">Plugins</h2>
	<p>Report of your WordPress installation.</p>

<pre>
	<?php
	foreach ( $plugins as $plugin_file => $plugin ) {
		printf( "%s <code>%s</code> <code>%s</code>\r\n\t",
			str_pad( esc_html( $plugin['Title'] ), 35 ),
			str_pad( is_plugin_active( $plugin_file ) ? 'Active' : 'Inactive', 8 ),
			esc_html( $plugin['Version'] )
		);
	} ?>
</pre>

	<?php
	$output = ob_get_clean();

	return $output;
}