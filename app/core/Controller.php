<?php

class Controller {
	public $_layuot = 'index.php';
	public $_db;


	public function __construct() {
		
		define('URLROOT', 'http://localhost:8888/stockexchange/public/');
		$this->_db = Db::getInstance();
	}

	public function model($model) {
		
		require_once '../app/models/'. $model .'.php';
		return new $model();
	}

	public function form($template_name,$form) {
		return '../app/views/' . $template_name .'/layout/incs/forms/'. $form .'form.php';
	}


	public function view($view, $data = [], $template_name = 'stockexchange') {
		extract($data);

		$lang = Session::get('lang');
		$translations = $this->_db->results($this->_db->get('translations')); 
		ob_start();
		require_once  '../app/views/' . $view . '.php';
		$content = ob_get_clean();
		
		require_once '../app/views/' . $template_name . '/layout/'.$this->_layuot;
	}

	public function message($status, $message) {
		exit(json_encode(['status'=> $status, 'message'=> $message]));
	}

	public function tranlate($lang, $translations) {
		Session::put('lang', $lang);
		exit(json_encode(['lang' => Session::get('lang'), 'translations' => $translations]));
	}
}