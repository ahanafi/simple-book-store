<?php
if (isset($_POST['insert'])) {
    $username = getPost('username');
    $fullname = getPost('fullname');
    $email = getPost('email');
    $user_type = getPost('user_type');
    $password = getPost('password');
    $confirm_password = getPost('confirm_password');

    if(!empty(trim($username)) && !empty(trim($fullname)) && !empty(trim($email)) && !empty(trim($user_type)) && !empty(trim($password)) && !empty(trim($confirm_password))) {

        $check_uname = select("*", "users", "username = '$username' OR email = '$email'");
        
        //Check username and password if exist 
        if(cekRow($check_uname) > 0) {
            setMessage('error', "Username or email already exist in table!", "back");
        } else {

            if(!in_array($user_type, [1,2])) {
                setMessage('error', "Please select type of user!", "back");
            } else {

                //Check the length of password
                if(strlen($password) >= 6) {

                    //Check password and confirm_password
                    if($password === $confirm_password) {

                        //Encrypt password
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        
                         $user_data = [
                            'uid'   => generateUid(),
                            'username' => $username,
                            'fullname' => $fullname,
                            'email' => $email,
                            'user_type' => $user_type,
                            'password' => $password,
                        ];

                        $insert = insertArray("users", $user_data);

                        if($insert) {
                            setMessage('success', "The new user was successfully inserted!", "user-management");
                        } else {
                            setMessage('error', "Error while insert new user!", "back");
                        }
                    } else {
                        setMessage('error', "Password and confirm password not match!", "back");
                    }
                } else {
                    setMessage('error', "Password length min 8 character!", "back");
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
            <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
        </div>
        <div class="card-body mb-4">
            <form action="<?php echo base_url("user-management/create") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="offset-1 col-md-5">
                        <label for="kode" class="form-control-label">Username</label>
                        <input type="text" name="username" class="form-control" required autocomplete="off">
                        <br>

                        <label for="fullname" class="form-control-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" required autocomplete="off">
                        <br>

                        <label for="email" class="form-control-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required autocomplete="off">
                        <br>
                       
                        <label for="user_type" class="form-control-label">User Type</label>
                        <select name="user_type" class="form-control" required>
                            <option>-- Select User Type --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Operator</option>
                        </select>
                        <br><br>
                    </div>
                    <div class="col-md-5">
                        <label for="password" class="form-control-label">Password</label>
                        <input type="password" name="password" class="form-control" required autocomplete="off">
                        <br>
                        
                        <label for="confirm_password" class="form-control-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required autocomplete="off">
                        <br>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block" type="submit" name="insert">
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