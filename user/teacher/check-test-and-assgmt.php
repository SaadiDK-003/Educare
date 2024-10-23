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
        <!-- Test Table -->
        <div class="row my-5">
            <div class="col-12">
                <h2>Test Table</h2>
            </div>
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
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-test" data-id="<?= $test_list->upt_id ?>" data-toggle="modal" data-target="#testUpdate">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-test" data-id="<?= $test_list->upt_id ?>">
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
        <!-- Assignment Table -->
        <div class="row my-5">
            <div class="col-12">
                <h2>Assignment Table</h2>
            </div>
            <div class="col-12">
                <table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Asgmt Title</th>
                            <th class="text-center font-weight-bold">Asgmt Desc</th>
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
                                    <a href="#!" class="btn btn-primary btn-sm btn-edit-asgmt" data-id="<?= $asgmt_list->ua_id ?>" data-toggle="modal" data-target="#testUpdate">
                                        <i class="fas fa-pencil"></i>
                                    </a> | <a href="#!" class="btn btn-danger btn-sm btn-del-asgmt" data-id="<?= $asgmt_list->ua_id ?>">
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


    <!-- Modal For Test Update -->
    <div class="modal fade" id="testUpdate" tabindex="-1" aria-labelledby="testUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form id="upd-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="testUpdateLabel">Test Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="update-status">Select Status</label>
                                    <select name="update_status" id="update-status" class="form-control" required>
                                        <option value="" selected hidden>Select Status</option>
                                        <option value="in-review">in-review</option>
                                        <option value="correct">correct</option>
                                        <option value="incorrect">incorrect</option>
                                        <option value="reject">reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-2 text-center">
                                <span class="show-res"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="upd_id" value="">
                        <input type="hidden" name="upd_action" value="">
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                        <a href="#!" class="btn btn-secondary" data-dismiss="modal">Close</a href="#!">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-body bg-danger text-white">
                Hello, world! This is a toast message.
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

            // Update Test / Assignment

            $(document).on("click", '.btn-edit-test', function(e) {
                e.preventDefault();
                let test_id = $(this).data('id');
                $("input[name='upd_id']").val(test_id);
                $("input[name='upd_action']").val("test_update");
            });

            $(document).on("click", '.btn-edit-asgmt', function(e) {
                e.preventDefault();
                let asgmt_id = $(this).data('id');
                $("input[name='upd_id']").val(asgmt_id);
                $("input[name='upd_action']").val("asgmt_update");
            });


            // DELETE Test or Assignment
            $(document).on("click", '.btn-del-test', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: '../ajax/delete.php',
                    method: 'post',
                    data: {
                        test_del_id: id
                    },
                    success: function(response) {
                        $('.toast').toast('show');
                        $(".toast-body").html(response);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1800);
                    }
                })
            });

            $(document).on("click", '.btn-del-asgmt', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: '../ajax/delete.php',
                    method: 'post',
                    data: {
                        asgmt_del_id: id
                    },
                    success: function(response) {
                        $('.toast').toast('show');
                        $(".toast-body").html(response);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1800);
                    }
                })
            });


            $("#upd-form").on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: '../ajax/upd_status.php',
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        let res = JSON.parse(response);
                        $(".show-res").addClass(res.status).html(res.msg);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1200);
                    }
                });
            });



        });
    </script>
</body>

</html>