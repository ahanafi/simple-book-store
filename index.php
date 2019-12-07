<?php
if(file_exists("core/init.php")) {
    require_once("core/init.php");
} else {
    die("Main configuration file is empty!");
}

if(!cekSessionUser()) {
    redirect(base_url('sign-in'));
}


$page = getFrom('page');
$action = getFrom('action');

$sql_category = select("uid, name", "category");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Book Store - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url("assets/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/vendor/select2/select2.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/vendor/select2/select2-bootstrap4.min.css") ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url("assets/vendor/sweetalert/sweetalert2.min.css") ?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css") ?>">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/custom-style.css") ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once("templates/sidebar.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="margin-left: 14rem;">

            <!-- Main Content -->
            <div id="content">

                <?php require_once("templates/navbar.php") ?>

                <?php
                    if($page == ""):
                        //DATA FOR PIE CHART
                        require_once("content/main-page.php");

                    # Agent
                    elseif ($page == "book"):
                        if($action == "" || $action == "filter"):
                            call_content($page, "index");
                        elseif($action == "create"):
                            call_content($page, "form-create");
                        elseif($action == "edit"):
                            call_content($page, "form-edit");
                        elseif($action == "delete"):
                            call_content($page, "delete");
                        elseif($action == "show" || $action == "detail"):
                            call_content($page, "detail");
                        endif;

                    elseif ($page == "category"):
                        if($action == "" || $action == "insert"):
                            call_content($page, "index");
                        elseif($action == "update"):
                            call_content($page, "update");
                        elseif($action == "delete"):
                            call_content($page, "delete");
                        endif;

                    elseif ($page == "user" || $user == "user-management"):
                        if($action == ""):
                            call_content($page, "index");
                        elseif($action == "create"):
                            call_content($page, "form-create");
                        elseif($action == "edit"):
                            call_content($page, "form-edit");
                        elseif($action == "delete"):
                            call_content($page, "delete");
                        elseif($action == "show" || $action == "detail"):
                            call_content($page, "detail");
                        endif;

                    else:
                        require_once("content/404.php");
                    endif;

                ?>

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

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url("assets/js/sb-admin-2.js") ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url("assets/vendor/chart.js/Chart.min.js") ?>"></script>

    <script src="<?php echo base_url("assets/vendor/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/vendor/select2/select2.min.js") ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url("assets/vendor/chart.js/chartjs-plugin-labels.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/demo/datatables-demo.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/vendor/sweetalert/sweetalert2.all.min.js") ?>"></script>
    <script>
        $(document).ready(function() {
            $("a[data-toggle=tooltip]").tooltip();
            $("#list-category").select2({
                theme: 'bootstrap4'
            });
            $('#data').DataTable({
                "ordering": false,
                "info":     false,
                "pageLength": 5
            });
            $("#data2").DataTable();
            $("#data_wrapper > .row:first-child").remove();
            $(".paging_simple_numbers").addClass('float-right');

            $("a#add-category").on('click', function() {
                $("#formAddCategory").modal('show');
            });
        });
        var askForLogout = () => {
            Swal.fire({
                title: 'Confirm logout',
                text: "Are you sure want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout now!'
            }).then((result) => {
                if (result.value) {
                    $("#logout-form").submit();
                }
            });
        }
    </script>
    <?php if(checkMessage()): ?>
        <script type="text/javascript">
            Swal.fire({
                title: '<?= ucfirst(getMessage('type')); ?>',
                text: '<?= getMessage('text') ?>',
                icon: '<?= getMessage('type'); ?>',
                timer: 2000
            }).then(() => {
                <?php if(getMessage('path_redirect') == 'back'): ?>
                    window.history.back();
                <?php else: ?>
                    window.location='<?= base_url(getMessage('path_redirect')); ?>';
                <?php endif; ?>
            });
        </script>
    <?php setMessage('', '', ''); ?>
    <?php endif; ?>
    <?php if (($page == "category" || $page == "book" || $page == "user") && $action == ""): ?>
        <script type="text/javascript">
            var confirmDelete = (uid) => {
                if(uid != '' && uid.length != 0) {
                    Swal.fire({
                        title: 'Confirm delete',
                        text: "Are you sure want to delete this?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            <?php if($page == "user"): ?>
                                var actionURL = "<?= base_url('user-management/delete') ?>/" + uid;
                            <?php else: ?>
                                var actionURL = "<?= base_url($page.'/delete') ?>/" + uid;
                            <?php endif; ?>
                            $("#delete-form").attr('action', actionURL);
                            $("#delete-form input[name=_uid]").val(uid);
                            $("#delete-form").submit();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Please select one of the category to update the data!',
                        icon: 'error',
                        timer: 2000
                    });
                }
            };
            <?php if($page == "book" && $action == ""): ?>
                $(document).ready(function() {
                    $("#dataTable").on('click', '.img', function() {
                        let uid = $(this).attr('data-uid');
                        let imgSource = $(this).attr('src');
                        if(uid != '' && uid.length != 0 && imgSource != '') {
                            $("#previewCover img").attr('src', imgSource);
                            $("#previewCover").modal('show');
                        }
                    });
                    $("#dataTable_wrapper > .row:first-child > .col-sm-12:last-child").removeClass('col-md-6');
                    $("#dataTable_wrapper > .row:first-child > .col-sm-12:last-child").addClass('col-md-3');

                    var selectCategory = "<div class='col-sm-12 col-md-3'><label>Category<select class='custom-select custom-select-sm form-control form-control-sm' id='custom-filter' onchange='customFilter()'>";
                    selectCategory += "<option>All</option>";
                    <?php while($category = result($sql_category)): ?>
                        selectCategory += "<option value='<?= strtolower($category->name); ?>'><?= $category->name; ?></option>";
                    <?php endwhile; ?>
                    selectCategory += "</select></label></div>";

                    $("#dataTable_wrapper > .row:first-child").append(selectCategory);
                });
                var customFilter = () => {
                    var category_name = $("#custom-filter > option:selected").val();
                    if(category_name != 'all') {
                        window.location='<?= base_url("book") ?>?category='+category_name;
                    }
                };
            <?php endif ?>
        </script>
    <?php endif ?>
    <?php if ($page == "category" && $action == ""): ?>
        <script type="text/javascript">
            $("#dataTable").on('click', '.btn-update', function() {
                var uid = $(this).attr('data-uid');
                if(uid != '' && uid.length != 0) {
                    var URL = "<?= base_url('') ?>/get-category.php?uid=" + uid;
                    $.ajax({
                        method: 'GET',
                        url: URL,
                        dataType: 'json',
                        success: function(res) {
                            if(res.status == 'success') {
                                var actionURL = "<?= base_url('category') ?>/update/" + res.data.uid;

                                $("#formEditCategory form").attr('action', actionURL);
                                $("#formEditCategory input[name=name]").val(res.data.name);
                                $("#formEditCategory input[name=_id]").val(res.data.id);
                                $("#formEditCategory").modal('show');
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: res.message,
                                    icon: 'error',
                                    timer: 2000
                                });
                            }
                        } 
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Please select one of the category to update the data!',
                        icon: 'error',
                        timer: 2000
                    });
                }
            });
        </script>
    <?php endif ?>
    <?php if($page == "book" && ($action == "create" || $action == "edit")): ?>
        <script type="text/javascript">
            function tambahTitik(element) {
                var nominal = $(element).val();
                var numberString = nominal.replace(/[^,\d]/g, '').toString();
                var split = numberString.split(',');
                var sisa  = split[0].length % 3;
                var rupiah= split[0].substr(0, sisa);
                var ribuan= split[0].substr(sisa).match(/\d{1,3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                ribuan = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                $(element).val(ribuan);
            }
        </script>
    <?php endif; ?>
</body>

</html>