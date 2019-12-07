<?php
$uid = getFrom('uid');

if (isset($_POST['update'])) {
    $isbn = getPost('isbn');
    $category = getPost('category');
    $title = getPost('title');
    $publisher = getPost('publisher');
    $author = getPost('author');
    $year = getPost('year');
    $stock = getPost('stock');
    $synopsis = getPost('synopsis');
    $price = str_replace(".", "", getPost('price'));

    if(!empty(trim($isbn)) && !empty(trim($category)) && !empty(trim($title)) && !empty(trim($publisher)) && !empty(trim($author)) && !empty(trim($year)) && !empty(trim($stock)) && !empty(trim($price))) {

        $check_isbn = select("*", "book", "isbn = '$isbn'");
        if(cekRow($check_isbn) > 0) {
            setMessage('error', "ISBN already exist in table!", "back");
        } else {
            $book = result($check_isbn);

            $book_data = [
                'uid'   => generateUid(),
                'isbn'  => $isbn,
                'category_uid' => $category,
                'title' => $title,
                'publisher' => $publisher,
                'author' => $author,
                'year' => $year,
                'stock' => $stock,
                'synopsis' => $synopsis,
                'price' => $price,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if(isset($_FILES['cover']) && $_FILES['cover']['name'] != '') {
                $upload_path = './uploads/book/';
                $temporary_file = getFile('cover', 'tmp_name');
                $file_type = getFile('cover', 'type');
                
                $file_type = explode("/", $file_type);
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    
                if(in_array(end($file_type), $allowed_types)) {
                    $new_file_name = md5(date('Y-m-d H:i:s')) . '.' . end($file_type);

                    if(move_uploaded_file($temporary_file, $upload_path.$new_file_name)) {
                        $book_data['cover'] = $new_file_name;
                        unlink("./uploads/book/".$book->cover);
                    } else {
                        setMessage('error', "Error while uploading an image!", "back");
                    }
                } else {
                    setMessage('error', "The image you uploaded is not supported!", "back");
                }
            }

            $update = updateArray("book", $book_data, $book->id);
            
            if($update) {
                setMessage('success', "The new book was successfully updated!", "book");
            } else {
                setMessage('error', "Error while update the book!", "back");
            }

        }
    } else {
        setMessage('error', "All forms must be filled!", "back");
    }
}

$book = select("*", "book", "uid = '$uid'");
if(cekRow($book) > 0) {

$book = result($book);
$categories = select("uid, name", "category");

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Book</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Book</h6>
        </div>
        <div class="card-body mb-4">
            <form action="<?php echo base_url("book/create") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="offset-1 col-md-5">
                        <label for="kode" class="form-control-label">ISBN</label>
                        <input type="text" name="isbn" value="<?= $book->isbn ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="category" class="form-control-label">Category of book</label>
                        <select name="category" id="list-category" class="form-control" required>
                            <option>-- Select Category --</option>
                            <?php while ($category = result($categories)): ?>
                                <?php if ($book->category_uid == $category->uid): ?>
                                    <option selected value="<?= $category->uid ?>"><?= $category->name; ?></option>
                                <?php else: ?>
                                    <option value="<?= $category->uid ?>"><?= $category->name; ?></option>
                                <?php endif ?>
                            <?php endwhile; ?>
                        </select>
                        <br><br>

                        <label for="title" class="form-control-label">Title</label>
                        <input type="text" name="title" value="<?= $book->title ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="publisher" class="form-control-label">Publisher</label>
                        <input type="text" name="publisher" value="<?= $book->publisher ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="author" class="form-control-label">Author</label>
                        <input type="text" name="author" value="<?= $book->author ?>" class="form-control" required autocomplete="off">
                        <br>
                        
                        <label for="year" class="form-control-label">Year</label>
                        <input type="number" name="year" value="<?= $book->year ?>" minlength="4" maxlength="4" min="2000" max="2020" class="form-control" required autocomplete="off">
                        <br>
                    </div>
                    <div class="col-md-5">
                        <label for="price" class="form-control-label">Price</label>
                        <input type="text" onkeyup="tambahTitik(this)" name="price" value="<?= $book->price ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="stock" class="form-control-label">Stock of book</label>
                        <input type="number" name="stock" value="<?= $book->stock ?>" class="form-control" required autocomplete="off">
                        <br>

                        <label for="cover" class="form-control-label">Cover</label>
                        <input type="file" accept="image/*" name="cover" value="<?= $book->cover ?>" class="form-control" autocomplete="off">
                        <br>

                        <label for="synopsis" class="form-control-label">Synopsis</label>
                        <textarea name="synopsis" row="5" class="form-control" required style="resize: none;height: 155px;"><?= $book->synopsis; ?></textarea>
                        <input type="hidden" name="_id" value="<?= $book->id ?>">
                        <br>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block" type="submit" name="update">
                                    <span>Save Now</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url("book") ?>" class="btn btn-secondary btn-block">
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
<?php
} else {
    redirect(base_url('error'));
}
?>