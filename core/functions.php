<?php

function is_loggedin()
{
    return (isset($_SESSION['user']) ? true : false);
}


function update_profile($POST, $id)
{
    global $con;
    $newPwd = '';
    $fname = $POST['fname'];
    $lname = $POST['lname'];
    $email = $POST['email'];
    $pwd = $POST['password'];
    $currentPwd = $POST['currentPwd'];
    if ($pwd == '') {
        $newPwd = $currentPwd;
    } else {
        $newPwd = md5($pwd);
    }

    $u_Q = $con->query("UPDATE `users` SET `fname`='$fname', `lname`='$lname', `email`='$email', `password`='$newPwd' WHERE `id`='$id'");
    if ($u_Q) {
        echo '<h4 class="alert alert-success text-center mt-3 mx-auto w-50">Profile has been updated.</h4>
        <script>setTimeout(function(){ window.location.href = "profile.php"; },1800);</script>
        ';
    }
}
