<?php
$action = getFrom('action');
$uid = getFrom('uid');

if (isset($_POST['delete'], $_POST['_uid']) && $uid == $_POST['_uid']) {
	$category = select("*", "category", "uid = '$uid'");
	if(cekRow($category) > 0) {
		$category = result($category);
		$delete = delete('category', $category->id);

		if($delete) {
			setMessage('success', "The category was successfully deleted!", "category");
		} else {
			setMessage('error', "Error while delete the category!", "category");
		}
	} else {
		setMessage('error', "The category not found!", "category");
	}
} else {
	redirect(base_url('error'));
}
?>