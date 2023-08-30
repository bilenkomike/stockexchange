<?php 
// 
function stck_load_reset_style() {
	echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
}


function stck_load_style($template_name,$foulder_file = array()) {
	$links = [];
	
	if(empty($foulder_file)) {
		$dir = '../app/views/' . $template_name . '/layout/css/style.css';
		$links[] = $dir;
	}
	else {
		foreach( $foulder_file as $foulder => $file) {
			if(empty($foulder)) {
				
				$dir = '../app/views/' . $template_name . '/layout/css/style.css';
				$links[] = $dir;
			}
			else {
				if(!empty($file))
				foreach($file as $filename) {
					$dir = '../app/views/' . $template_name . '/layout/' . $foulder . '/' . $filename .'.css';
					$links[] = $dir;
				}
				
			}
			
		}

	}
	foreach($links as $link) {
		echo '<link rel="stylesheet" type="text/css" href="'. $link.'?css='.time().'" />';
	}
	
}



function stck_load_scripts($template_name) {

	$public_dir = 'js/';
	$j_files = array_diff(scandir($public_dir), array('.', '..'));

	$links_js_def = array();
	$links_jq_def = array();
	$private_template_dir = '../app/views/' . $template_name . '/layout/js/';
	$links_js = array();
	$links_jq = [];
	
	foreach($j_files as $j_file) {
		if(startsWith($j_file, 'js') == 1) {
			$links_js_def[] = $j_file;
		}
		else if(startsWith($j_file, 'jq') == 1) {
			$links_jq_def[] = $j_file;
		}
		else {
			continue;
		}
	}
	
	if($handle = opendir($private_template_dir)) {
		
		while(false !== ($entry = readdir($handle))) {

			if($entry != "." && $entry != "..") {
				if(startsWith($entry, 'js') == 1) {
					$links_js[] = $entry;

				}
				else if(startsWith($entry, 'jq') == 1) {
					$links_jq[] = $entry;
				}
				else {
					continue;
				}
			}
		}
		closedir($handle);
	}


	if(!empty($links_js)) {
		foreach($links_js as $js) {
			echo '<script type="text/javascript" src="'.$private_template_dir. $js .'"></script>';
		}
	}
	if(!empty($links_js_def)) {
		foreach($links_js_def as $link_js_def) {
			echo '<script type="text/javascript" src="'.$public_dir. $link_js_def .'"></script>';
		}
	}

	echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

	if(!empty($links_jq_def)) {
		foreach($links_jq_def as $link_jq_def) {
			echo '<script type="text/javascript" src="'.$public_dir. $link_jq_def .'"></script>';
		}
	}

	if(!empty($links_jq)) {
		foreach($links_jq as $jq) {
			echo '<script type="text/javascript" src="'.$private_template_dir. $jq .'"></script>';
		}
	}
	
	
}