<?php
$no = 1;
$page = getFrom('page');
$uid = getFrom('uid');

$book_sql = query("SELECT book.*, category.name as category FROM book JOIN category ON book.category_uid = category.uid WHERE book.uid = '$uid'");
$book = result($book_sql);
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
        <h1 class="h3 mb-0 text-gray-800">Book</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail of Book</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    <img src="<?= getImage("book", $book->cover) ?>" alt="" class="img img-thumbnail img-fluid">
                    <a href="#" data-toggle="modal" data-target="#changeCover" class="btn btn-primary mt-3">Change Cover</a>
                </div>
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <td class="font-weight-bold">ISBN</td>
                                <td>:</td>
                                <td><?= $book->isbn; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Title</td>
                                <td>:</td>
                                <td><?= $book->title; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Category</td>
                                <td>:</td>
                                <td>
                                    <a href="<?= base_url("book/category/".slug($book->category)) ?>" class="btn-link"><?= $book->category; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Author</td>
                                <td>:</td>
                                <td><?= $book->author; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Publisher</td>
                                <td>:</td>
                                <td><?= $book->publisher; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Year</td>
                                <td>:</td>
                                <td><?= $book->year; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Publisher</td>
                                <td>:</td>
                                <td><?= $book->publisher; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Price</td>
                                <td>:</td>
                                <td class="font-italic"><?= toRupiah($book->price); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Stock</td>
                                <td>:</td>
                                <td><?= $book->stock; ?></td>
                            </tr>
                        </table>

                        <a href="<?= base_url("book/edit/".$book->uid) ?>" class="btn btn-success">
                            <i class="fa fa-pencil-alt"></i>
                            <span>Edit</span>
                        </a>
                        <a href="<?= base_url('book') ?>" class="btn btn-secondary">
                            <span>Return Back</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="changeCover" tabindex="-1" role="dialog" aria-labelledby="changeCoverLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Book Cover</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("book/".$book->uid) ?>" enctype="multipart/form-data">
                    <label for="file">Cover</label>
                    <input type="file" accept="image/*" name="cover" class="form-control" required>
                    <div class="float-right mt-3">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="update">Save Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>