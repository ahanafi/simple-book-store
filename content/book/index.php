<?php
$no = 1;
$page = getFrom('page');
$category_name = escape(getFrom('category'));

$books = query("SELECT book.uid, book.title, book.author, book.cover, book.stock, category.name as category FROM book JOIN category ON book.category_uid = category.uid");

if (!empty(trim($category_name))) {
    $category = select("uid", "category", "name = '$category_name'");
    $category = result($category);

    $books = query("SELECT book.uid, book.title, book.author, book.cover, book.stock, category.name as category FROM book JOIN category ON book.category_uid = category.uid WHERE category_uid = '$category->uid'");
}
?>
<style>
    td > img:hover{
        cursor: pointer;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Book List</h1>
        <div class="btn-group-sm">
            <a href="<?php echo base_url($page."/create") ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" title="Add New Data">
                <i class="fas fa-plus text-white-50"></i>
                <span class="text">Add New Data</span>
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Books</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Cover</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($book = result($books)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="text-center">
                                <img src="<?= getImage("book", $book->cover) ?>" alt="" class="img img-fluid img-thumbnail" style="width: 120px;" data-uid="<?= $book->uid; ?>">
                            </td>
                            <td class="align-middle"><?= $book->title ?></td>
                            <td class="align-middle"><?= $book->category ?></td>
                            <td class="align-middle"><?= $book->author ?></td>
                            <td class="align-middle">
                                <a href="<?php echo base_url("book/edit/".$book->uid) ?>" class="btn btn-primary btn-circle" data-toggle="tooltip" title="Update">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?= base_url("book/".$book->uid) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" title="Show detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if(getSessionUser('user_type') == 1): ?>
                                <a onclick="confirmDelete('<?= $book->uid; ?>')" href="#" class="btn btn-danger btn-circle btn-delete" data-toggle="tooltip" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="alert alert-info">
                    <p class="mb-0">
                        <strong>Information :</strong> Click image to show preview Cover of the book
                    </p>
                </div>
                <form action="" id="delete-form" method="POST">
                    <input type="hidden" name="_uid">
                    <input type="hidden" name="delete" value="TRUE">
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<div class="modal fade" id="previewCover" tabindex="-1" role="dialog" aria-labelledby="previewCoverLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Book Cover</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="#" alt="" class="img img-fluid img-thumbnail" style="max-height: 480px;">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>