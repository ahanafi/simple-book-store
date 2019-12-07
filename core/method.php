<?php

function getPost($key) {
	if(is_array($_POST[$key])) {
		return $_POST[$key];
	} else {
		return escape($_POST[$key]);
	}
}

function getFrom($index) {
	$get = isset($_GET[$index]) ? $_GET[$index] : "";
	return $get;
}

function getFile($main, $index) {
	return $_FILES[$main][$index];
}

function isAjax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function getImage($type, $filename) {
	if(file_exists("uploads/".$type."/".$filename)) {
		$path = base_url("uploads/".$type."/".$filename);
	} else {
		$path = base_url("assets/img/no_image.jpg");
	}
	return $path;
}