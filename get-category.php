<?php
if(file_exists("core/init.php")) {
    require_once("core/init.php");
} else {
    die("Main configuration file is empty!");
}

if(isAjax()){
	$category_uid = getFrom('uid');
	if(empty(trim($category_uid))) {
		$response = [
			'status' => 'error',
			'message' => 'Uid category is empty!'
		];
	} else {
		$category_data = select("*", "category", "uid = '$category_uid'");
		if(cekRow($category_data) > 0) {
			$category_data = result($category_data);
			$response = [
				'status' => 'success',
				'data' => $category_data
			];
		} else {
			$response = [
				'status' => 'error',
				'message' => 'Category not found!'
			];
		}
	}

	echo json_encode($response);
}