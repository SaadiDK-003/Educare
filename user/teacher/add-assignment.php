<?php
require_once '../../core/database.php';

if ($userRole == 'student' || (!isset($_GET['course_id']) || empty($_GET['course_id']))) {
    header('Location: ../index.php');
}
if (isset($_GET['course_id'])) {
    $c_id = $_GET['course_id'];
    $checkCourse_Q = $con->query("SELECT * FROM `courses` WHERE `id`='$c_id'");
    $checkCourseData = mysqli_num_rows($checkCourse_Q);

    if ($checkCourseData <= 0) {
        header('Location: add-course.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - Manage Assignment</title>
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
                <h1>Manage Assignment</h1>
            </div>
            <div class="col-6 text-center">
                <a href="add-course.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <form id="add-test" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="asgmt-title">Assignment Title</label>
                                <input type="text" name="asgmt_title" id="asgmt-title" class="form-control" placeholder="HTML & CSS Test" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="asgmt-desc">Assignment Description</label>
                                <textarea rows="4" name="asgmt_desc" id="asgmt-desc" class="form-control" placeholder="Description about the course." required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="asgmt-file">Upload Assignment File</label>
                                <input type="file" class="form-control" name="asgmt_file" id="asgmt-file">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Add Assignment</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                            $statusMsg = '';
                            define('PDF_MAGIC', "\\x25\\x50\\x44\\x46\\x2D");
                            if (isset($_POST['asgmt_title']) && isset($_POST['asgmt_desc']) && !empty($_FILES['asgmt_file'])):
                                $asgmt_title = $_POST['asgmt_title'];
                                $asgmt_desc = $_POST['asgmt_desc'];
                                $asgmt_file = $_FILES['asgmt_file'];

                                if (file_exists($asgmt_file['tmp_name']) && filesize($asgmt_file['tmp_name']) > 0) {
                                    echo "The PDF file has content.";
                                } else {
                                    echo "The PDF file is empty.";
                                }
                                die();
                                $targetDir = "../../user/pdf/";
                                $fileName = 'asgmt_' . basename($asgmt_file["name"]);
                                $targetFilePath = $targetDir . $fileName;
                                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

                                if (in_array($fileType, $allowTypes)) {
                                    if (move_uploaded_file($asgmt_file["tmp_name"], $targetFilePath)) {
                                        $add_asgmt_Q = $con->query("INSERT INTO `assignments` (asgmt_title,asgmt_desc,asgmt_file,teacher_id,course_id) VALUES ('$asgmt_title','$asgmt_desc','$fileName','$userID','$c_id')");
                                        if ($add_asgmt_Q) {
                                            echo '<h5 class="alert alert-success">' . $asgmt_title . ' has been added.</h5>
                                                <script>
                                                    setTimeout(function(){
                                                        window.location.href = "' . SITE_URL . 'user/teacher/add-course.php"
                                                    },1800);
                                                </script>
                                            ';
                                        }
                                    }
                                } else {
                                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
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
                            <th class="text-center font-weight-bold">Assignment Title</th>
                            <th class="text-center font-weight-bold">Assignment Desc</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $asgmt_Q = $con->query("CALL `get_asgmt_by_teacher_id`($userID)");
                        while ($asgmt_list = mysqli_fetch_object($asgmt_Q)):
                        ?>
                            <tr>
                                <th><?= $asgmt_list->asgmt_id ?></th>
                                <td><?= $asgmt_list->asgmt_title ?></td>
                                <td><?= $asgmt_list->asgmt_desc ?></td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $asgmt_list->asgmt_id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $asgmt_list->asgmt_id ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                        $asgmt_Q->close();
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