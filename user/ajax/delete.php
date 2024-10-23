<?php

require_once '../../core/database.php';


if (isset($_POST['test_del_id'])):
    $t_id = $_POST['test_del_id'];
    $tq = $con->query("DELETE FROM `upload_tests` WHERE `id`='$t_id'");
    if ($tq) {
        echo 'Student Test has been deleted.';
    }
endif;

if (isset($_POST['asgmt_del_id'])):
    $a_id = $_POST['asgmt_del_id'];
    $aq = $con->query("DELETE FROM `upload_assignments` WHERE `id`='$a_id'");
    if ($aq) {
        echo 'Student Assignment has been deleted.';
    }
endif;
