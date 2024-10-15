<?php
session_start();
$config_path = $_SERVER['DOCUMENT_ROOT'] . '/educare/';
require_once $config_path . 'config.php';
$con = mysqli_connect(HOST, USER, PWD, DB);

$userID = 0;
$userFullName = '';
$userEmail = '';

require_once 'functions.php';

if (isset($_SESSION['user'])):
    $userID = $_SESSION['user'];
    $currentUserQ = $con->query("SELECT * FROM `users` WHERE `id`='$userID'");
    $currentUser = mysqli_fetch_object($currentUserQ);
    $userFullName = $currentUser->fname . '-' . $currentUser->lname;
    $userEmail = $currentUser->email;
endif;
