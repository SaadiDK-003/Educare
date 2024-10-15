<?php
require_once '../core/database.php';

if (is_loggedin() === false) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin page</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/custom.min.css">
    <!-- <style>
        header {
            background: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            margin: 20px 0;
        }

        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        .course-card {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .testimonial {
            background: #e9ecef;
            padding: 15px;
            margin: 20px 0;
            border-left: 5px solid chocolate;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .sidebar {
            flex: 1;
            padding: 20px;
            border-right: 1px solid #ddd;
            text-align: center;
        }

        .sidebar a {
            text-decoration: none;
            color: chocolate;
            padding: 1%;
            background-color: rgb(245, 243, 243);
        }
    </style> -->
</head>

<body>
    <header>
        <nav>
            <img src="images/logoo.png" class="logo">
            <ul class="d-flex">
                <li><a href="index.php">Home</a></li>
                <li><a href="Teachcontent.html">Teachers</a></li>
                <li><a href="testcourses.html">Courses</a></li>
            </ul>
            <div class="contenthome">
                <div class="user-wrapper">
                    <a id="toggle-user-menu" href="#!" class="d-flex align-items-center">
                        <img src="images/user.png" class="userpic">
                        <h1 class="mb-0"> EduCare</h1>
                    </a>
                </div>
                <div class="submenuw" id="submenu">
                    <div class="submenu">
                        <div class="userinfo">
                            <img src="images/user.png">
                            <h5 class="mb-0"><?= $userFullName ?></h5>
                        </div>
                        <hr>
                        <a href="index.html" class="submenulink">
                            <img src="images/editprofile.png">
                            <p>Edit profile</p>
                        </a>
                        <a href="testsettings.html" class="submenulink">
                            <img src="images/settings.png">
                            <p>Settings</p>
                        </a>
                        <a href="logout.php" class="submenulink">
                            <img src="images/logout.png">
                            <p>Log out</p>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="main" id="home-page">
        <div class="container mt-4">
            <h2 class="text-center">Categories</h2>
            <ul class="tabs-link d-flex justify-content-center">
                <a class="btn btn-primary active" href="#courses">Courses</a>
                <a class="btn btn-primary" href="#about">About Us</a>
                <a class="btn btn-primary" href="#testimonials">Testimonials</a>
                <a class="btn btn-primary" href="#contact">Contact</a>
            </ul>
        </div>
        <div class="container tabs-content">
            <section id="courses">
                <h2>Featured Courses</h2>
                <div class="course-card">
                    <h4>Web Development Bootcamp</h4>
                    <p>Learn HTML, CSS, and JavaScript to build stunning websites.</p>
                </div>
                <div class="course-card">
                    <h4>Data Science with Python</h4>
                    <p>Analyze data and build machine learning models using Python.</p>
                </div>
                <div class="course-card">
                    <h4>Digital Marketing Essentials</h4>
                    <p>Master the strategies of online marketing and SEO.</p>
                </div>
            </section>

            <section style="display: none;" id="about">
                <h2>About Us</h2>
                <p>We are dedicated to providing high-quality online education to learners around the world. Our platform offers a variety of courses designed to help you achieve your personal and professional goals.</p>
            </section>

            <section style="display: none;" id="testimonials">
                <h2>What Our Students Say</h2>
                <div class="testimonial">
                    <p>"The web development bootcamp was fantastic! I learned so much in such a short time." - Jane Doe</p>
                </div>
                <div class="testimonial">
                    <p>"Thanks to the data science course, I landed my dream job in tech!" - John Smith</p>
                </div>
            </section>

            <section style="display: none;" id="contact">
                <h2>Contact Us</h2>
                <p>If you have any questions, feel free to reach out to us at <a href="mailto:Admin@EduCare.com">Admin@EduCare.com</a>.</p>
            </section>
        </div>
    </div>
    <footer>
        <p class="mb-0">&copy; 2024 Learning Platform. All rights reserved.</p>
    </footer>




    <?php include_once './includes/js_links.php'; ?>
    <script>
        $(document).ready(function() {
            $('.tabs-link').on('click', 'a', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                let index = $(this).index() + 1;
                $(`.tabs-content section:nth-child(${index})`).show('300').siblings().hide('200');
            });
            // Toggle User DropDown
            $(".user-wrapper").on('click', '#toggle-user-menu', function(e) {
                e.preventDefault();
                $('.submenuw').toggleClass('submenuwopen');
            });
        });
    </script>
</body>

</html>