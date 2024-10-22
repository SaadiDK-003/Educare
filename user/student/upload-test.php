<?php
require_once '../../core/database.php';

if ($userRole == 'teacher' || (!isset($_GET['test_id']) || empty($_GET['test_id'])) || (!isset($_GET['teacher_id']) || empty($_GET['teacher_id']))) {
    header('Location: ../index.php');
}
if (isset($_GET['test_id']) && isset($_GET['teacher_id'])) {
    $t_id = $_GET['test_id'];
    $teacher_id = $_GET['teacher_id'];

    $checkTest_Q = $con->query("SELECT * FROM `tests` WHERE `id`='$t_id'");
    $checkTestData = mysqli_num_rows($checkTest_Q);

    if ($checkTestData <= 0) {
        header('Location: ../userassiandtest.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Upload Test</title>
    <?php include_once '../includes/style_links.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/custom.min.css">
</head>

<body id="add_test_page">

    <?php include '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-6 text-center">
                <h1>Upload Test</h1>
            </div>
            <div class="col-6 text-center">
                <a href="../userassiandtest.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <form id="add-test" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="test-file">Select Test File</label>
                                <input type="file" class="form-control" name="test_file" id="test-file">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Upload File</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                            $statusMsg = '';
                            if (!empty($_FILES['test_file'])):
                                $test_file = $_FILES['test_file'];

                                if (file_exists($test_file['tmp_name']) && filesize($test_file['tmp_name']) > 0) {
                                    $targetDir = "../../user/pdf/";
                                    $fileName = 'std_test_' . $userID . '_' . basename($test_file["name"]);
                                    $targetFilePath = $targetDir . $fileName;
                                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

                                    if (in_array($fileType, $allowTypes)) {
                                        if (move_uploaded_file($test_file["tmp_name"], $targetFilePath)) {
                                            $add_test_Q = $con->query("INSERT INTO `upload_tests` (student_id,teacher_id,test_id,uploaded_file) VALUES ('$userID','$teacher_id','$t_id','$fileName')");
                                            if ($add_test_Q) {
                                                echo '<h5 class="alert alert-success">File has been uploaded.</h5>
                                                <script>
                                                    setTimeout(function(){
                                                        window.location.href = "' . SITE_URL . 'user/testcourses.php"
                                                    },1800);
                                                </script>
                                            ';
                                            }
                                        }
                                    } else {
                                        $statusMsg = "<h5 class='text-center alert alert-danger'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.</h5>";
                                    }
                                } else {
                                    $statusMsg = "<h5 class='text-center alert alert-danger'>The file is empty.</h5>";
                                }
                                echo $statusMsg;
                            endif;
                            $con->next_result();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row my-5">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Test Title</th>
                            <th class="text-center font-weight-bold">Test Desc</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $test_Q = $con->query("CALL `get_test_by_teacher_id`($userID)");
                        while ($test_list = mysqli_fetch_object($test_Q)):
                        ?>
                            <tr>
                                <th><?= $test_list->test_id ?></th>
                                <td><?= $test_list->test_title ?></td>
                                <td><?= $test_list->test_desc ?></td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $test_list->test_id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $test_list->test_id ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                        $test_Q->close();
                        $con->next_result(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php include_once '../includes/js_links.php'; ?>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#example', {
                ordering: false,
                columns: [{
                    width: "10%"
                }, {
                    width: "20%"
                }, {
                    width: "60%"
                }, {
                    width: "10%"
                }]
            });
        });
    </script>
</body>

</html>