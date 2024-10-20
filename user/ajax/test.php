<?php
require_once '../../core/database.php';

if (isset($_POST['test_id'])):
    $testID = $_POST['test_id'];
    $testInfo_Q = $con->query("SELECT * FROM `tests` WHERE `id`='$testID'");
    $testInfo = mysqli_fetch_object($testInfo_Q);

    echo json_encode(["title" => $testInfo->test_title, "desc" => $testInfo->test_desc, "file" => $testInfo->test_file]);
endif;
