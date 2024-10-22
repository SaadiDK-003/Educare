<?php
require_once '../../core/database.php';
if (is_loggedin() === false || $userRole == 'student') {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - Check Test/Assignment</title>
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
                <h1>Check Test/Assignment</h1>
            </div>
            <div class="col-6 text-center">
                <a href="add-course.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <div class="row my-5">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Test Title</th>
                            <th class="text-center font-weight-bold">Test Desc</th>
                            <th class="text-center font-weight-bold">Student File</th>
                            <th class="text-center font-weight-bold">Status</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status_ = '';
                        $test_Q = $con->query("CALL `get_std_test_by_teacher_id`($userID)");
                        while ($test_list = mysqli_fetch_object($test_Q)):
                            $status_ = $test_list->status;
                        ?>
                            <tr>
                                <th><?= $test_list->upt_id ?></th>
                                <td><?= $test_list->test_title ?></td>
                                <td><?= $test_list->test_desc ?></td>
                                <td class="text-center"><a class="btn btn-primary btn-sm" href="<?= SITE_URL . 'user/pdf/' . $test_list->uploaded_file ?>">Student File</a></td>
                                <td class="text-center">
                                    <?php if ($status_ == 'in-review'): ?>
                                        <span class="btn btn-info btn-sm">In Review</span>
                                    <?php elseif ($status_ == 'correct'): ?>
                                        <span class="btn btn-success btn-sm">Correct</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-sm">Incorrect</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $test_list->upt_id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $test_list->upt_id ?>">
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

        <div class="row my-5">
            <div class="col-12">
                <table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Test Title</th>
                            <th class="text-center font-weight-bold">Test Desc</th>
                            <th class="text-center font-weight-bold">Student File</th>
                            <th class="text-center font-weight-bold">Status</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status_1 = '';
                        $asgmt_Q = $con->query("CALL `get_std_asgmt_by_teacher_id`($userID)");
                        while ($asgmt_list = mysqli_fetch_object($asgmt_Q)):
                            $status_1 = $asgmt_list->status;
                        ?>
                            <tr>
                                <th><?= $asgmt_list->ua_id ?></th>
                                <td><?= $asgmt_list->asgmt_title ?></td>
                                <td><?= $asgmt_list->asgmt_desc ?></td>
                                <td class="text-center"><a class="btn btn-primary btn-sm" href="<?= SITE_URL . 'user/pdf/' . $asgmt_list->uploaded_file ?>">Student File</a></td>
                                <td class="text-center">
                                    <?php if ($status_1 == 'in-review'): ?>
                                        <span class="btn btn-info btn-sm">In Review</span>
                                    <?php elseif ($status_1 == 'correct'): ?>
                                        <span class="btn btn-success btn-sm">Correct</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-sm">Incorrect</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-cat" data-id="<?= $asgmt_list->ua_id ?>">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-cat" data-id="<?= $asgmt_list->ua_id ?>">
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
            new DataTable('#example, #example1', {
                ordering: false,
                columns: [{
                    width: "5%"
                }, {
                    width: "10%"
                }, {
                    width: "45%"
                }, {
                    width: "10%"
                }, {
                    width: "10%"
                }, {
                    width: "10%"
                }]
            });
        });
    </script>
</body>

</html>