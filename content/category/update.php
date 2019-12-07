<?php
$action = getFrom('action');
$uid = getFrom('uid');

if (isset($_POST['update'], $_POST['name']) && $uid != '') {
    $name = getPost('name');
    $_id = getPost('_id');

    if(!empty(trim($name)) && !empty(trim($_id))) {
        $data = [
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $update= updateArray("category", $data, $_id);

        if($update) {
            setMessage('success', "The category was successfully updated!", "category");
        } else {
            setMessage('error', "Error while updating the category!", "category");
        }
    } else {
        setMessage('error', "Name of category can't empty!", "category");
    }
} else {
    redirect(base_url('error'));
}


?>