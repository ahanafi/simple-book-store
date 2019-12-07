<?php
$action = getFrom('action');
$uid = getFrom('uid');

if (isset($_POST['delete'], $_POST['_uid']) && $uid == $_POST['_uid']) {
	$user = select("*", "users", "uid = '$uid'");
	if(cekRow($user) > 0) {
		$user = result($user);
		$delete = delete('users', $user->id);

		if($delete) {
			setMessage('success', "The user was successfully deleted!", "user-management");
		} else {
			setMessage('error', "Error while delete the user!", "user-management");
		}
	} else {
		setMessage('error', "The user not found!", "user-management");
	}
} else {
	redirect(base_url('error'));
}
?>