<?php
require_once '../core/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Teachers</title>
    <?php include './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/custom.min.css">
</head>

<body>
    <?php include_once './includes/header.php'; ?>
    <div id="teachers-list" class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="chocolate">Meet Our Teachers</h1>
            </div>
            <?php
            $getAllT_Q = $con->query("CALL `get_all_teachers`()");
            if (mysqli_num_rows($getAllT_Q) > 0) {
                while ($teach_list = mysqli_fetch_object($getAllT_Q)):
            ?>
                    <div class="col-12 col-md-6">
                        <div class="teacher">
                            <h2><?= $teach_list->fname . '-' . $teach_list->lname ?></h2>
                            <p><strong>Subject:</strong> <?= $teach_list->category_names ?></p>
                            <p><?= $teach_list->bio ?? "&nbsp;" ?></p>
                            <a href="mailto:example@example.com?subject=Hello%20there&body=I%20would%20like%20to%20inquire%20about..." class="email-link">
                                Contact me
                            </a>
                        </div>
                    </div>
                <?php endwhile;
            } else {
                ?>
                <div class="col-12">
                    <h2 class="text-center mt-3">No Teacher Available Right Now.</h2>
                </div>
            <?php
            }
            $getAllT_Q->close();
            $con->next_result(); ?>
        </div>
    </div>

    <?php include './includes/js_links.php'; ?>

</body>

</html>