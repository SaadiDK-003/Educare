<?php
require_once '../core/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Learning Platform</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/custom.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            flex: 1;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .content {
            flex: 3;
            padding: 20px;
        }

        .course-card {
            background: #e9ecef;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <div class="container">
        <div class="sidebar">
            <h2>Categories</h2>
            <ul class="list-unstyled">
                <?php
                $list_cat_Q = $con->query("SELECT * FROM `categories`");
                while ($list_cat = mysqli_fetch_object($list_cat_Q)):
                ?>
                    <li><a data-id="<?= $list_cat->id ?>" class="btn btn-outline-warning font-weight-bold w-75 my-2" href="#<?= $list_cat->category_name ?>"><?= $list_cat->category_name ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div id="fetch_courses" class="content">
            <span>Loading...</span>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>


    <?php include_once './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'ajax/courses.php',
                beforeSend: function() {

                },
                success: function(res) {
                    $("#fetch_courses").html(res);
                }
            });

            $(document).on('click', '.sidebar ul li a', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $(this).addClass('active').parent('li').siblings().find('a').removeClass('active');
                $.ajax({
                    url: 'ajax/courses.php',
                    method: 'post',
                    beforeSend: function() {
                        $("#fetch_courses").html('<span>Loading...</span>');
                    },
                    data: {
                        course_id: id
                    },
                    success: function(res) {
                        $("#fetch_courses").html(res);
                    }
                })
            });
        });
    </script>

</body>

</html>