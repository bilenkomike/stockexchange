<?php
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);

// session_start();


$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'root', 
		'db' => 'sick'
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	)
);


spl_autoload_register(function($class) {
	require_once 'models/'.$class.'.php';
});



if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    
    $db = Db::getInstance();

	$hash = Cookie::get(Config::get('remember/cookie_name'));
	
	$hashCheck = DB::getInstance()->get('users_sessions', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}

require_once 'core/App.php';
require_once 'core/Controller.php';