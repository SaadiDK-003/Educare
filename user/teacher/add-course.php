<?php
require_once '../../core/database.php';

if ($userRole == 'student') {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - Manage Course</title>
    <?php include_once '../includes/style_links.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/custom.min.css">
</head>

<body id="add_course_page">

    <?php include '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-6 text-center">
                <h1>Manage Courses</h1>
            </div>
            <div class="col-6 text-center">
                <a href="../index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <form id="add-course" action="" method="post">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="course-name">Course Name</label>
                                <input type="text" name="course_name" id="course-name" class="form-control" placeholder="HTML & CSS Basics" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="course-desc">Course Description</label>
                                <textarea rows="4" name="course_desc" id="course-desc" class="form-control" placeholder="Description about the course." required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category">Select Category</label>
                                <select class="form-control" name="category" id="category" required>
                                    <option value="" selected hidden>Select Course Category</option>
                                    <?php
                                    $cat_list_Q = $con->query("SELECT * FROM `categories`");
                                    while ($cat_list = mysqli_fetch_object($cat_list_Q)):
                                    ?>
                                        <option value="<?= $cat_list->id ?>"><?= $cat_list->category_name ?></option>
                                    <?php endwhile;
                                    $cat_list_Q->close();
                                    $con->next_result(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                            if (isset($_POST['course_name']) && isset($_POST['course_desc'])):
                                $course_title = $_POST['course_name'];
                                $course_desc = $_POST['course_desc'];
                                $category = $_POST['category'];
                                $add_course_Q = $con->query("INSERT INTO `courses` (course_title,course_desc,cat_id,teacher_id) VALUES('$course_title','$course_desc','$category','$userID')");
                                if ($add_course_Q) {
                                    echo '<h5 class="alert alert-success">' . $course_title . ' has been added.</h5>
                                        <script>
                                            setTimeout(function(){
                                                window.location.href = "' . SITE_URL . 'user/teacher/add-course.php"
                                            },1800);
                                        </script>
                                    ';
                                }
                            endif;
                            $con->next_result();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row my-5">
            <div class="col-12 mx-auto">
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