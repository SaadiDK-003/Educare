<?php
session_start();
$config_path = $_SERVER['DOCUMENT_ROOT'] . '/educare/';
require_once $config_path . 'config.php';
$con = mysqli_connect(HOST, USER, PWD, DB);

$userID = 0;
$userFullName = '';
$userEmail = '';
$userRole = '';

require_once 'functions.php';

if (isset($_SESSION['user'])):
    $userID = $_SESSION['user'];
    $currentUserQ = $con->query("SELECT * FROM `users` WHERE `id`='$userID'");
    $currentUser = mysqli_fetch_object($currentUserQ);
    $userFirstName = $currentUser->fname;
    $userLastName = $currentUser->lname;
    $userFullName = $currentUser->fname . '-' . $currentUser->lname;
    $userEmail = $currentUser->email;
    $userRole = $currentUser->user_type;
    $userPwd = $currentUser->password;
endif;
