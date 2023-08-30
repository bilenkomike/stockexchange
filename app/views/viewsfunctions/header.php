<?php 


function get_header($template_name) {
	return require_once '../app/views/' . $template_name . '/layout/incs/_header.php';
}