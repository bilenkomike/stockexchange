<?php
session_start();


require_once '../app/init.php';
$dir = '../app/views/viewsfunctions/';
if(is_dir($dir)) {
	
	if($foulder = opendir($dir)) {
		while($file = readdir($foulder)) {
			if($file == '.' || $file == '..')
				continue;

			require_once $dir.$file;
		}
	}
}

$app = new App;