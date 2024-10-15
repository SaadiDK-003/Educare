<?php
require_once '../../core/database.php';

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['userType'])):

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = $_POST['pass'];
    $userType = $_POST['userType'];
    $msg = '';

    $checkEmail = $con->query("SELECT email FROM `users` WHERE `email`='$email'");

    if (mysqli_num_rows($checkEmail) == 0) {

        if (strlen($pwd) < 6) {
            $msg = array("status" => "alert alert-danger", "msg" => "Password must be greater than 6 characters.");
        } else {
            $pwd = md5($pwd);
            $add_user_Q = $con->query("INSERT INTO `users` (fname,lname,email,password,user_type) VALUES('$fname','$lname','$email','$pwd','$userType')");
            if ($add_user_Q) {
                $msg = array("status" => "alert alert-success", "msg" => $userType . ' has been created successfully.');
            }
        }
    } else {
        $msg = array("status" => "alert alert-danger", "msg" => "This user already exists!");
    }
    echo json_encode($msg);
endif;


if (isset($_POST['login_email']) && isset($_POST['login_pass'])):
    $e = $_POST['login_email'];
    $p = $_POST['login_pass'];
    $p = md5($p);
    $msg = '';
    $loginQ = $con->query("SELECT id FROM `users` WHERE `email`='$e' AND `password`='$p'");

    if (mysqli_num_rows($loginQ) > 0) {
        $getID = mysqli_fetch_object($loginQ);
        $_SESSION['user'] = $getID->id;
        $msg = array("status" => "alert alert-success", "msg" => "Successfully Loggedin, Redirecting...");
    } else {
        $msg = array("status" => "alert alert-danger", "msg" => "No User Found Check Your Credentials.");
    }
    echo json_encode($msg);
endif;
