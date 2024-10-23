<?php
require_once '../../core/database.php';

if (!isset($_POST['course_id']) && !isset($_POST['course_edit_id'])):
    $getAllCourses_Q = $con->query("CALL `get_all_courses`()");

    if (mysqli_num_rows($getAllCourses_Q) > 0) {
        $courses = $getAllCourses_Q->fetch_all(MYSQLI_ASSOC);
        $current_category = '';
        foreach ($courses as $index => $course) {

            if ($current_category != $course['category_name']) {
                $current_category = $course['category_name'];
                echo '<section id="' . str_replace(' ', '-', $current_category) . '">';
                echo '<h2>' . $current_category . '</h2>';
            }
            echo '<div class="course-card">';
            echo '<h3>' . $course['course_title'] . '</h3>';
            echo '<p>' . $course['course_desc'] . '</p>';
            echo '<a href="userassiandtest.php?course_id=' . $course['course_id'] . '" class="email-link">Enter</a>';
            echo '</div>';
            if (!isset($courses[$index + 1]) || $courses[$index + 1]['category_name'] != $current_category) {
                echo '</section>';
            }
        }
    } else {
        echo "<span>No courses found.</span>";
    }
    $getAllCourses_Q->close();
    $con->next_result();
endif;

if (isset($_POST['course_id']) && !isset($_POST['course_edit_id'])):
    $cat_id = $_POST['course_id'];
    $getCourses_Q = $con->query("CALL `get_course_by_cat_id`($cat_id)");

    if (mysqli_num_rows($getCourses_Q) > 0) {
        $courses_ = $getCourses_Q->fetch_all(MYSQLI_ASSOC);
        $current_category_ = '';
        foreach ($courses_ as $index => $course) {

            if ($current_category_ != $course['category_name']) {
                $current_category_ = $course['category_name'];
                echo '<section id="' . str_replace(' ', '-', $current_category_) . '">';
                echo '<h2>' . $current_category_ . '</h2>';
            }
            echo '<div class="course-card">';
            echo '<h3>' . $course['course_title'] . '</h3>';
            echo '<p>' . $course['course_desc'] . '</p>';
            echo '<a href="userassiandtest.php?course_id=' . $course['course_id'] . '" class="email-link">Enter</a>';
            echo '</div>';
            if (!isset($courses_[$index + 1]) || $courses_[$index + 1]['category_name'] != $current_category_) {
                echo '</section>';
            }
        }
    } else {
        echo "<span>No courses found.</span>";
    }
    $getCourses_Q->close();
    $con->next_result();
endif;


if (isset($_POST['course_edit_id']) && !isset($_POST['course_id'])):
    $get_course_id = $_POST['course_edit_id'];
    $get_course_q = $con->query("CALL `get_course_by_id`($get_course_id)");
    $get_course = mysqli_fetch_object($get_course_q);

    $res = ["course_id" => $get_course->course_id, "course_title" => $get_course->course_title, "course_desc" => $get_course->course_desc, "cat_id" => $get_course->cat_id, "category_name" =>
    $get_course->category_name];

    echo json_encode($res);

    $get_course_q->close();
    $con->next_result();
endif;
