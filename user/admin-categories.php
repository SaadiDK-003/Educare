<?php
require_once '../core/database.php';

if ($userRole != 'admin') {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Categories</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="css/custom.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-6 text-center">
                <h1>Manage Categories</h1>
            </div>
            <div class="col-6 text-center">
                <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <form action="" method="post">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category_name">Add Category</label>
                                <input type="text" name="category_name" id="category_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                            if (isset($_POST['submit']) && isset($_POST['category_name'])):
                                $cat_name = $_POST['category_name'];
                                $add_cat_Q = $con->query("INSERT INTO `categories` (category_name) VALUES('$cat_name')");
                                if ($add_cat_Q) {
                                    echo '<h5 class="alert alert-success">Category has been added.</h5>
                                        <script>
                                            setTimeout(function(){
                                                window.location.href = "' . SITE_URL . 'user/admin-categories.php"
                                            },1800);
                                        </script>
                                    ';
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row my-5">
            <div class="col-6 mx-auto">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $catQ = $con->query("SELECT * FROM `categories`");
                        while ($cat = mysqli_fetch_object($catQ)):
                        ?>
                            <tr>
                                <td><?= $cat->id ?></td>
                                <td><?= $cat->category_name ?></td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $cat->id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $cat->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php include_once './includes/js_links.php'; ?>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#example', {
                ordering: false
            });
        });
    </script>
</body>

</html>