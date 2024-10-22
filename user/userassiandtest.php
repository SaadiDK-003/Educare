<?php
require_once '../core/database.php';

if (is_loggedin() === false) {
    header('Location: login.php');
}
$course_id = 0;
if (!isset($_GET['course_id'])) {
    header('Location: testcourses.php');
}

$course_id = $_GET['course_id'];
$getCourseTitle_Q = $con->query("SELECT `course_title` FROM `courses` WHERE `id`='$course_id'");
$getCourseTitle = mysqli_fetch_object($getCourseTitle_Q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests and Assignments</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/custom.min.css">
</head>

<body id="test-list-page">
    <?php include './includes/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="text-center text-black-50"><?= $getCourseTitle->course_title ?></h1>
            </div>
        </div>
        <section id="tests">
            <h2>Tests</h2>
            <ul>
                <?php
                $getCourseTitle_Q->close();
                $con->next_result();
                $testAvailable = 0;
                $get_test_Q = $con->query("CALL `get_test_by_course_id`($course_id)");
                if (mysqli_num_rows($get_test_Q) > 0):
                    $testAvailable = 1;
                    while ($test_list = mysqli_fetch_object($get_test_Q)):
                ?>
                        <li><a href="#!" class="test_id" data-toggle="modal" data-target="#testInfo" data-id="<?= $test_list->test_id ?>"><?= $test_list->test_title ?></a></li>
                <?php endwhile;
                else:
                    echo '<li>No Test Available.</li>';
                endif;
                $get_test_Q->close();
                $con->next_result(); ?>
            </ul>
            <?php if ($testAvailable == 1): ?>
                <a class="d-flex align-items-center" href="testcontent.html">Explore all&nbsp;<i class="fas fa-arrow-right"></i></a>
            <?php endif; ?>
        </section>

        <section id="assignments">
            <h2>Assignments</h2>
            <ul>
                <?php
                $asgmtAvailable = 0;
                $get_asgmt_Q = $con->query("CALL `get_asgmt_by_course_id`($course_id)");
                if (mysqli_num_rows($get_asgmt_Q) > 0):
                    $asgmtAvailable = 1;
                    while ($asgmt_list = mysqli_fetch_object($get_asgmt_Q)):
                ?>
                        <li><a href="#!" class="asgmt_id" data-toggle="modal" data-target="#testInfo" data-id="<?= $asgmt_list->asgmt_id ?>"><?= $asgmt_list->asgmt_title ?></a></li>
                <?php endwhile;
                else:
                    echo '<li>No Assignment Available.</li>';
                endif;
                $get_asgmt_Q->close();
                $con->next_result(); ?>
            </ul>
            <?php if ($asgmtAvailable == 1): ?>
                <a class="d-flex align-items-center" href="assicontent.html">Explore all&nbsp;<i class="fas fa-arrow-right"></i></a>
            <?php endif; ?>
        </section>
        <section id="teachers">
            <h2>Teacher</h2>
            <ul>
                <?php
                $teacherAvailable = 0;
                $get_teacher_Q = $con->query("CALL `get_teachers_by_course_id`($course_id)");
                if (mysqli_num_rows($get_teacher_Q) > 0):
                    $teacherAvailable = 1;
                    while ($teacher_list = mysqli_fetch_object($get_teacher_Q)):
                ?>
                        <li><a href="#!" class="teacher_id" data-id="<?= $teacher_list->teacher_id ?>"><?= $teacher_list->fname . ' ' . $teacher_list->lname ?></a></li>
                <?php endwhile;
                else:
                    echo '<li>No Test Available.</li>';
                endif;
                $get_teacher_Q->close();
                $con->next_result(); ?>
            </ul>
            <?php if ($teacherAvailable == 1): ?>
                <a class="d-flex align-items-center" href="Teachcontent.php">Explore all&nbsp;<i class="fas fa-arrow-right"></i></a>
            <?php endif; ?>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="testInfo" tabindex="-1" aria-labelledby="testInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testInfoLabel">Test Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p id="title_desc"></p>
                        </div>
                        <div class="col-8">
                            <a id="test_file" href="#!" class="btn btn-primary" download>Download <span id="file-info"></span> PDF</a>
                        </div>
                        <?php if ($userRole == 'student'): ?>
                            <div class="col-4 text-right">
                                <a id="test_std_file" href="#!" class="btn btn-secondary">Upload <span id="file-info"></span> PDF</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php include './includes/footer.php'; ?>
    <?php include_once './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
            $(".test_id").on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/test.php',
                    method: 'post',
                    data: {
                        test_id: id
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $("#file-info").html("Test");
                        $(".modal-title").html(res.title);
                        $("#title_desc").html(res.desc);
                        $("#test_file").attr('href', 'pdf/' + res.file);
                        $("#test_std_file").attr("href", `student/upload-test.php?test_id=${res.test_id}&teacher_id=${res.teacher_id}`);
                    }
                });
            });

            $(".asgmt_id").on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/assignment.php',
                    method: 'post',
                    data: {
                        asgmt_id: id
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $("#file-info").html("Assignment");
                        $(".modal-title").html(res.title);
                        $("#title_desc").html(res.desc);
                        $("#test_file").attr('href', 'pdf/' + res.file);
                        $("#test_std_file").attr("href", `student/upload-assignment.php?asgmt_id=${res.asgmt_id}&teacher_id=${res.teacher_id}`);
                    }
                });
            });
        });
    </script>
</body>

</html>