<?php 

function print_arr($arr) {
	echo '<pre>' . print_r($arr, true) . '</pre>';
}


require '../init.php';

spl_autoload_register(function($class) {
	$path = '../app/models/' . ucfirst($class) . '.php';
	if(file_exists($path)) {
		require $path;
	}
}); 


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$db = Db::getInstance();
$vars = $db->get('cv', array('hash', '=', $_GET['cv_hash']))->first();


echo json_encode(array("cv"=>$vars));

?>
