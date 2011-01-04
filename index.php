<?php
# Check Headers
function check_headers(){
	$sent = headers_sent($file,$line);
	if ( $sent ) {
		echo '<pre>';
		echo "Headers have already been sent on [$file][$line].\n";
		var_dump(headers_list());
		debug_print_backtrace();
		echo '</pre>';
		die;
	}
}
# Run Application
require_once implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__),'scripts','bootstrap.php'));
