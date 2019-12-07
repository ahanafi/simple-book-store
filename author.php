<?php
if(file_exists("core/init.php")) {
    require_once("core/init.php");
} else {
    die("Main configuration file is empty!");
}

$page = getFrom('page');
$action = getFrom('action');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Book Store - Who am I</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url("assets/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/vendor/select2/select2.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/vendor/select2/select2-bootstrap4.min.css") ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url("assets/vendor/sweetalert/sweetalert2.min.css") ?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css") ?>">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url("assets/css/custom-style.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <div id="author" class="container-fluid p-lg-3" style="margin-top: 10%;">
                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <p class="font-weight-bold" style="font-size: 28px;">
                            My Profile :
                        </p>
                        <div class="error mx-auto">
                            <img src="<?= base_url("assets/img/me.png") ?>" alt="" class="img-fluid rounded-circle" style="border:5px solid #fcfcfc">
                        </div>
                        <p class="lead text-white font-weight-bold mb-1 mt-3">Ahmad Hanafi</p>
                        <p class="text-white mb-0">2017102020</p>
                        <p class="text-white font-weight-bold mb-3">TI - SE 1/5</p>
                        <br>
                        <a href="<?= base_url(""); ?>" class="text-white">&larr; Back to Dashboard</a>
                    </div>

                </div>

            </div>
            <!-- End of Main Content -->

            <?php require_once("templates/footer.php"); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url("assets/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url("assets/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
</body>

</html>
