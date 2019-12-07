<?php
$no = 1;
$page = getFrom('page');
$categorys = select("*", "category");

if (isset($_POST['insert'])) {
    $name = getPost('name');
    
    if(!empty(trim($name))) {
        $check_existing = select("*", "category", "name = '$name'");
        if(cekRow($check_existing) > 0 ) {
            setMessage('error', "The category name is exist in table!", "category");
        } else {
            $insert = insertArray("category", [
                'uid' => generateUid(),
                'name' => $name
            ]);
            if($insert) {
                setMessage('success', "New category was successfully inserted!", "category");
            } else {
                setMessage('error', "Error while insert new category!", "category");
            }
        }
    } else {
        setMessage('error', "Name of category can't empty!", "category");
    }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        <div class="btn-group-sm">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" title="Add New Data" id="add-category">
                <i class="fas fa-plus text-white-50"></i>
                <span class="text">Add New Data</span>
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of category</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <?php if(getSessionUser('user_type') == 1): ?>
                            <th>Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($category = result($categorys)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $category->name ?></td>
                            <td><?= $category->created_at ?></td>
                            <?php if(getSessionUser('user_type') == 1): ?>
                            <td>
                                <a href="#" class="btn btn-primary btn-circle btn-update" data-toggle="tooltip" title="Update" data-uid="<?= $category->uid; ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a onclick="confirmDelete('<?= $category->uid ?>')" href="#" class="btn btn-danger btn-circle" data-toggle="tooltip" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <?php endif ?>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <form action="" id="delete-form" method="POST">
                    <input type="hidden" name="_uid">
                    <input type="hidden" name="delete" value="TRUE">
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- Insert -->
<div class="modal fade" id="formAddCategory" tabindex="-1" role="dialog" aria-labelledby="formAddCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url("category") ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">Name of Category</label>
                    <input type="text" name="name" class="form-control" required autocomplete="off" autofocus="on">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" name="insert" type="submit">Save Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Insert -->
<div class="modal fade" id="formEditCategory" tabindex="-1" role="dialog" aria-labelledby="formEditCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">Name of Category</label>
                    <input type="text" name="name" class="form-control" required autocomplete="off" autofocus="on">
                    <input type="hidden" name="_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" name="update" type="submit">Save Now</button>
                </div>
            </form>
        </div>
    </div>
</div>