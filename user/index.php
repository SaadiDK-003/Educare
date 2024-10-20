<?php
require_once '../core/database.php';

// if (is_loggedin() === false) {
//     header('Location: login.php');
// }
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCare</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/custom.min.css">
</head>

<body>
    <?php include './includes/header.php'; ?>
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
    <?php include './includes/footer.php'; ?>




    <?php include_once './includes/js_links.php'; ?>
    <script>
        $(document).ready(function() {
            $('.tabs-link').on('click', 'a', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                let index = $(this).index() + 1;
                $(`.tabs-content section:nth-child(${index})`).show('300').siblings().hide('200');
            });
        });
    </script>
</body>

</html>