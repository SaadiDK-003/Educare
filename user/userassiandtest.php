<?php
require_once '../core/database.php';

if (is_loggedin() === false) {
    header('Location: login.php');
}

if(!isset($_GET['course_id'])) {
    header('Location: ');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests and Assignments</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/custom.min.css">
</head>

<body id="test-list-page">
    <?php include './includes/header.php'; ?>

    <div class="container">
        <section id="tests">
            <h2>Tests</h2>
            <ul>
                <li><a href="#"> Test 1</a></li>
                <li><a href="#"> Test 2</a></li>
                <li><a href="#"> Test 3</a></li>
            </ul>
            <a href="testcontent.html">Explore all > </a>
        </section>

        <section id="assignments">
            <h2>Assignments</h2>
            <ul>
                <li><a href="#">Assignment 1</a></li>
                <li><a href="#">Assignment 2</a></li>
                <li><a href="#">Assignment 3</a></li>
            </ul>
            <a href="assicontent.html">Explore all > </a>
        </section>
        <section id="teachers">
            <h2>Teachers</h2>
            <ul>
                <li><a href="">Mohammed Saeed</a></li>
                <li><a href="#">Ali Alghamdi</a></li>
                <li><a href="#">Omar Alghamdi</a></li>
            </ul>
            <a href="Teachcontent.html">Explore all > </a>
        </section>
    </div>

    <?php include './includes/footer.php'; ?>
    <?php include_once './includes/js_links.php'; ?>
</body>

</html>