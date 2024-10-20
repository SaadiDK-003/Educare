<?php
require_once '../../core/database.php';

if (isset($_POST['asgmt_id'])):
    $asgmtID = $_POST['asgmt_id'];
    $asgmtInfo_Q = $con->query("SELECT * FROM `assignments` WHERE `id`='$asgmtID'");
    $asgmtInfo = mysqli_fetch_object($asgmtInfo_Q);

    echo json_encode(["title" => $asgmtInfo->asgmt_title, "desc" => $asgmtInfo->asgmt_desc, "file" => $asgmtInfo->asgmt_file]);
endif;
