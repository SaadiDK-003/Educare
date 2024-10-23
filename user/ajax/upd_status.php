<?php
require_once '../../core/database.php';

if (isset($_POST['upd_action']) && $_POST['upd_action'] == "test_update"):
    $update_status = $_POST['update_status'];
    $upd_id = $_POST['upd_id'];

    $tq = $con->query("UPDATE `upload_tests` SET `status`='$update_status' WHERE `id`='$upd_id'");
    if ($tq) {
        echo json_encode(["status" => "alert alert-success", "msg" => "Status Updated."]);
    }

endif;

if (isset($_POST['upd_action']) && $_POST['upd_action'] == "asgmt_update"):
    $update_status = $_POST['update_status'];
    $upd_id = $_POST['upd_id'];
    $aq = $con->query("UPDATE `upload_assignments` SET `status`='$update_status' WHERE `id`='$upd_id'");
    if ($aq) {
        echo json_encode(["status" => "alert alert-success", "msg" => "Status Updated."]);
    }
endif;
