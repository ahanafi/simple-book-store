<?php
function env($key, $default_value) {
	return (getenv($key) ? getenv($key) : $default_value);
}

function base_url($file = NULL) {
	$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/book-store/";
	$path .= $file;
	return $path;
}

function redirect($loc = "back")
{
	if($loc != "back") {
		echo "<script type='text/javascript'>window.location='".$loc."';</script>";
	} else {
		echo "<script type='text/javascript'>window.history.back();</script>";
	}
}

function alert($text, $location = NULL){
	$alert = "<script type='text/javascript'>alert('$text');";
	if($location != NULL) {
		if($location == "back") {
			$alert .= "window.history.back();";
		} else {
			$alert .= "window.location='$location';";
		}
	}
	$alert .= "</script>";
	echo $alert;
}

function getLevel($index = NULL) {
	$levels = [
		'Administrator', 'Operator', 'Warga / Masyarakat'
	];

	if($index != NULL) {
		return $levels[$index-1];
	} else {
		return $levels;
	}
}

function call_content($menu = "admin", $nama_file) {
	$path_file = "content/".$menu."/".$nama_file.".php";
	if (file_exists($path_file)) {
		$file = require_once($path_file);
		return $file;
	} else {
		die("Template tidak ditemukan!");
	}
}

function getTemplate($file_name, $directory = "content") {
	$file = require_once($directory . "/" . $file_name . ".php");
	return $file;
}

function generateUid() {
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 
    $randomString = '';
    $randomString2 = '';
    $randomString3 = '';
    $randomString4 = '';
  
    for ($i = 0; $i < 4; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $index2 = rand(2, strlen($characters) - 2); 
        $index3 = rand(3, strlen($characters) - 3); 
        $index4 = rand(4, strlen($characters) - 4); 
        $randomString .= $characters[$index]; 
        $randomString2 .= $characters[$index2]; 
        $randomString3 .= $characters[$index3]; 
        $randomString4 .= $characters[$index4]; 
    } 
  
    $result = $randomString . "-" . $randomString2 . "-" . $randomString3 . "-" . $randomString4; 
    return ($result);
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function singkatanProdi($string) {
	$prodi_text = "";
	$exp1 = explode(" - ", $string);
	if(count($exp1) > 1) {
		$exp_1 = explode(" ", $exp1[0]);
		$total_word_1 = count($exp_1);

		$exp_2 = explode(" ", $exp1[1]);
		$total_word_2 = count($exp_2);

		$prodi_text_1 = $prodi_text_2 = "";
		
		for ($i = 0; $i < $total_word_1; $i++) {
			$prodi_text_1 .= $exp_1[$i][0]."";
		}

		for ($i = 0; $i < $total_word_2; $i++) {
			$prodi_text_2 .= $exp_2[$i][0]."";
		}

		$prodi_text = $prodi_text_1."".$prodi_text_2;
	} else {
		$exp2 = explode(" ", $exp1[0]);
		$total_word = count($exp2);
		for ($i = 0; $i < $total_word; $i++) {
			$prodi_text .= $exp2[$i][0]."";
		}
	}

	return $prodi_text;
}

function toRupiah($number) {
	$format = "Rp. " . str_replace(",", ".", number_format($number)) . ",-";
	return $format;
}

function slug($string) {
	$result = str_replace("'", "", str_replace(" ", "-", $string));
	return $result;
}

?>