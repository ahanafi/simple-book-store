<?php
$uid = getFrom('uid');
$user_sql = select("*", "users", "uid = '$uid'");
$user = result($user_sql);

if (isset($_POST['update'])) {
    $username = getPost('username');
    $fullname = getPost('fullname');
    $email = getPost('email');
    $user_type = getPost('user_type');

    if(!empty(trim($username)) && !empty(trim($fullname)) && !empty(trim($email)) && !empty(trim($user_type))) {

        $check_uname = select("*", "users", "(username = '$username' OR email = '$email') AND uid != '$uid'");
        
        //Check username and password if exist 
        if(cekRow($check_uname) > 0) {
            setMessage('error', "Username or email already exist in table!", "back");
        } else {

            if(!in_array($user_type, [1,2])) {
                setMessage('error', "Please select type of user!", "back");
            } else {                        
                 $user_data = [
                    'username' => $username,
                    'fullname' => $fullname,
                    'email' => $email,
                    'user_type' => $user_type,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $update = updateArray("users", $user_data, $user->id);

                if($update) {
                    setMessage('success', "The user was successfully updated!", "user-management");
                } else {
                    setMessage('error', "Error while update new user!", "back");
                }
            }
        }
    } else {
        setMessage('error', "All forms must be filled!", "back");
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Management</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update User</h6>
        </div>
        <div class="card-body mb-4">
            <form action="<?php echo base_url("user-management/edit/".$user->uid) ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="offset-1 col-md-5">
                        <label for="kode" class="form-control-label">Username</label>
                        <input type="text" name="username" value="<?= $user->username; ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="fullname" class="form-control-label">Fullname</label>
                        <input type="text" name="fullname" value="<?= $user->fullname; ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="email" class="form-control-label">Email Address</label>
                        <input type="email" name="email" value="<?= $user->email; ?>" class="form-control" required autocomplete="off">
                        <br>
                       
                    </div>
                    <div class="col-md-5">
                        <label for="user_type" class="form-control-label">User Type</label>
                        <select name="user_type" class="form-control" required>
                            <option>-- Select User Type --</option>
                            <option value="1" <?= ($user->user_type == 1) ? "selected" : ""; ?>>Administrator</option>
                            <option value="2" <?= ($user->user_type == 2) ? "selected" : ""; ?>>Operator</option>
                        </select>
                        <br><br>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block" type="submit" name="update">
                                    <span>Save Now</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url("user-management") ?>" class="btn btn-secondary btn-block">
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->