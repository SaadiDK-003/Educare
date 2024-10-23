<header>
    <nav>
        <img src="<?= SITE_URL ?>user/images/logoo.png" class="logo">
        <ul class="d-flex">
            <li><a href="<?= SITE_URL ?>user/index.php">Home</a></li>
            <li><a href="<?= SITE_URL ?>user/Teachcontent.php">Teachers</a></li>
            <li><a href="<?= SITE_URL ?>user/testcourses.php">Courses</a></li>
        </ul>
        <div class="contenthome">
            <div class="user-wrapper">
                <?php if ($userFullName != ''): ?>
                    <a id="toggle-user-menu" href="#!" class="d-flex align-items-center">
                        <img src="<?= SITE_URL ?>user/images/user.png" class="userpic">
                        <h1 class="mb-0"> EduCare</h1>
                    </a>
                <?php else: ?>
                    <a href="<?= SITE_URL ?>user/login.php" class="d-flex align-items-center">
                        <img src="<?= SITE_URL ?>user/images/user.png" class="userpic">
                        <h1 class="mb-0"> Login</h1>
                    </a>
                <?php endif; ?>
            </div>
            <?php if (is_loggedin()): ?>
                <div class="submenuw" id="submenu">
                    <div class="submenu">
                        <div class="userinfo">
                            <img src="<?= SITE_URL ?>user/images/user.png">
                            <h5 class="mb-0"><?= $userFullName ?></h5>
                        </div>
                        <hr>
                        <a href="<?= SITE_URL ?>user/profile.php" class="submenulink">
                            <img src="<?= SITE_URL ?>user/images/editprofile.png">
                            <p>Edit profile</p>
                        </a>
                        <a class="d-none" href="<?= SITE_URL ?>user/testsettings.php" class="submenulink">
                            <img src="<?= SITE_URL ?>user/images/settings.png">
                            <p>Settings</p>
                        </a>
                        <?php if ($userRole == 'teacher'): ?>
                            <a href="<?= SITE_URL ?>user/teacher/add-course.php" class="submenulink">
                                <img src="<?= SITE_URL ?>user/images/settings.png">
                                <p>Add Course</p>
                            </a>
                            <a href="<?= SITE_URL ?>user/teacher/check-test-and-assgmt.php" class="submenulink">
                                <img src="<?= SITE_URL ?>user/images/settings.png">
                                <p>Check Test/Assgmt</p>
                            </a>
                        <?php endif; ?>
                        <?php if ($userRole == 'admin'): ?>
                            <a href="admin-categories.php" class="submenulink">
                                <img src="<?= SITE_URL ?>user/images/settings.png">
                                <p>Manage Categories</p>
                            </a>
                        <?php endif; ?>
                        <a href="<?= SITE_URL ?>user/logout.php" class="submenulink">
                            <img src="<?= SITE_URL ?>user/images/logout.png">
                            <p>Log out</p>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>