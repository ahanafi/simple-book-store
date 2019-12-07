<?php
$action = getFrom('action');
$uid = getFrom('uid');

if (isset($_POST['delete'], $_POST['_uid']) && $uid == $_POST['_uid']) {
	$book = select("*", "book", "uid = '$uid'");
	if(cekRow($book) > 0) {
		$book = result($book);
		$delete = delete('book', $book->id);

		if($delete) {
			setMessage('success', "The book was successfully deleted!", "book");
		} else {
			setMessage('error', "Error while delete the book!", "book");
		}
	} else {
		setMessage('error', "The book not found!", "book");
	}
} else {
	redirect(base_url('error'));
}
?>