<header>
    <nav>
        <img src="images/logoo.png" class="logo">
        <ul class="d-flex">
            <li><a href="index.php">Home</a></li>
            <li><a href="Teachcontent.php">Teachers</a></li>
            <li><a href="testcourses.php">Courses</a></li>
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
                    <a href="index.php" class="submenulink">
                        <img src="images/editprofile.png">
                        <p>Edit profile</p>
                    </a>
                    <a href="testsettings.php" class="submenulink">
                        <img src="images/settings.png">
                        <p>Settings</p>
                    </a>
                    <?php if ($userRole == 'admin'): ?>
                        <a href="admin-categories.php" class="submenulink">
                            <img src="images/settings.png">
                            <p>Manage Categories</p>
                        </a>
                    <?php endif; ?>
                    <a href="logout.php" class="submenulink">
                        <img src="images/logout.png">
                        <p>Log out</p>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>