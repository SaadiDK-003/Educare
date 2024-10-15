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
            <ul>
                <?php
                $list_cat_Q = $con->query("SELECT * FROM `categories`");
                while ($list_cat = mysqli_fetch_object($list_cat_Q)):
                ?>
                    <li><a href="#<?= $list_cat->category_name ?>"><?= $list_cat->category_name ?></a></li>
                <?php endwhile; ?>

                <!-- <li><a href="#web-development">Web Development</a></li>
                <li><a href="#data-science">Data Science</a></li>
                <li><a href="#digital-marketing">Digital Marketing</a></li>
                <li><a href="#graphic-design">Graphic Design</a></li>
                <li><a href="#artifical-intellegence">Artifical Intelligence</a></li>
                <li><a href="#software-engineering">Software Engineering</a></li> -->
            </ul>
        </div>

        <div class="content">
            <section id="web-development">
                <h2>Web Development</h2>
                <div class="course-card">
                    <h3>HTML & CSS Basics</h3>
                    <p>Learn the fundamentals of HTML and CSS to build your first website.</p>
                    <a href="userassiandtest.html" style="color:rgb(230, 209, 115) ;">Enter</a>
                </div>
                <div class="course-card">
                    <h3>JavaScript for Beginners</h3>
                    <p>Understand the basics of JavaScript and how to add interactivity to your web pages.</p>
                    <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                </div>
            </section>

            <section id="data-science">
                <h2>Data Science</h2>
                <div class="course-card">
                    <h3>Python for Data Analysis</h3>
                    <p>Learn how to use Python for data analysis and visualization.</p>

                    <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                </div>
                <div class="course-card">
                    <h3>Machine Learning Essentials</h3>
                    <p>An introduction to machine learning concepts and techniques.</p>

                    <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                </div>
            </section>

            <section id="digital-marketing">
                <h2>Digital Marketing</h2>
                <div class="course-card">
                    <h3>SEO Strategies</h3>
                    <p>Learn how to optimize your website for search engines.</p>
                    <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                </div>
            </section>
            <div class="course-card">
                <h3>Social Media Marketing</h3>
                <p>Master the techniques of effective social media marketing.</p>

                <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
            </div>
            </section>

            <section id="graphic-design">
                <h2>Graphic Design</h2>
                <div class="course-card">
                    <h3>Design Basics with Photoshop</h3>
                    <p>Learn the essentials of graphic design using Adobe Photoshop.</p>

                    <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                </div>
                <section id="graphic-design">
                    <div class="course-card">
                        <h3>Illustration Techniques</h3>
                        <p>Evreything about illustration techniques and styles .</p>

                        <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                    </div>
                </section>
                <section id="artifical-intellegence">
                    <h2>Artifical Intellegence</h2>
                    <div class="course-card">
                        <h3>Artifical Intellegence</h3>
                        <p>Evreything about AI .</p>

                        <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                    </div>
                </section>
                <section id="software-engineering">
                    <h2>Software Engineering</h2>
                    <div class="course-card">
                        <h3>Software Engineering</h3>
                        <p>Evreything about Software Engineering .</p>

                        <a href="userassiandtest.html" style="color: rgb(230, 209, 115); ">Enter</a>
                    </div>
                </section>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Learning Platform. All rights reserved.</p>
    </footer>


    <?php include_once './includes/js_links.php'; ?>
</body>

</html>