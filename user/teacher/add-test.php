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
    <title>Teacher - Manage Test</title>
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
                <h1>Manage Test</h1>
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
                                <label for="test-title">Test Title</label>
                                <input type="text" name="test_title" id="test-title" class="form-control" placeholder="HTML & CSS Test" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="test-desc">Test Description</label>
                                <textarea rows="4" name="test_desc" id="test-desc" class="form-control" placeholder="Description about the course." required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="test-file">Upload Test File</label>
                                <input type="file" class="form-control" name="test_file" id="test-file">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Add Test</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                            $statusMsg = '';
                            if (isset($_POST['test_title']) && isset($_POST['test_desc']) && !empty($_FILES['test_file'])):
                                $test_title = $_POST['test_title'];
                                $test_desc = $_POST['test_desc'];
                                $test_file = $_FILES['test_file'];

                                $targetDir = "../../user/images/";
                                $fileName = basename($test_file["name"]);
                                $targetFilePath = $targetDir . $fileName;
                                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                                if (in_array($fileType, $allowTypes)) {
                                    if (move_uploaded_file($test_file["tmp_name"], $targetFilePath)) {
                                        $add_test_Q = $con->query("INSERT INTO `tests` (test_title,test_desc,test_file,teacher_id,course_id) VALUES ('$test_title','$test_desc','$fileName','$userID','$c_id')");
                                        if ($add_test_Q) {
                                            echo '<h5 class="alert alert-success">' . $test_title . ' has been added.</h5>
                                                <script>
                                                    setTimeout(function(){
                                                        window.location.href = "' . SITE_URL . 'user/teacher/add-test.php"
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
            <!-- DISPLAY NONE JUST FOR NOW WORK IN-PROGRESS -->
            <div class="col-12 mx-auto d-none">
                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Course Title</th>
                            <th class="text-center font-weight-bold">Course Desc</th>
                            <th class="text-center font-weight-bold">Add Test / Assignment</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $course_Q = $con->query("CALL `get_courses_by_teacher_id`($userID)");
                        while ($course_list = mysqli_fetch_object($course_Q)):
                        ?>
                            <tr>
                                <th><?= $course_list->course_id ?></th>
                                <td><?= $course_list->course_title ?></td>
                                <td><?= $course_list->course_desc ?></td>
                                <td class="text-center">
                                    <a href="add-test.php?course_id=<?= $course_list->course_id ?>" class="btn btn-info btn-sm mb-2">Add Test</a>
                                    <a href="add-assignment.php" class="btn btn-secondary btn-sm">Add Assignment</a>
                                </td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $course_list->course_id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $course_list->course_id ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                        $course_Q->close();
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
                    width: "5%"
                }, {
                    width: "20%"
                }, {
                    width: "45%"
                }, {
                    width: "15%"
                }, null]
            });
        });
    </script>
</body>

</html>