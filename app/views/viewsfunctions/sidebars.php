<?php 
function get_sidebars($template_name, $names = array()) {
	$dir = '../app/views/' . $template_name . '/layout/incs/';
	foreach($names as $name) {
		include $dir.'_'. $name .'.php';
	}
}