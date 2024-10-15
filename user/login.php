<?php
require_once '../core/database.php';

if (is_loggedin()) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <?php include_once './includes/style_links.php'; ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="fcontainer">
        <form id="log-in">
            <span></span>
            <h3>Log in</h3>
            <h4> Email</h4>
            <input type="email" name="login_email" required placeholder="Enter your email">
            <h4>Password</h4>
            <input type="password" name="login_pass" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Log in" class="fbtn">
            <p>Create an account<a href="signup.php"> Sign in </a></p>
        </form>
    </div>

    <?php include_once './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
            $("#log-in").on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: 'ajax/user.php',
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        let res = JSON.parse(response);
                        $("#log-in > span").html(`<h6 class="font-weight-bold ${res?.status}">${res?.msg}</h6>`);
                        if (res?.status == 'alert alert-success') {
                            setTimeout(() => {
                                window.location.href = './index.php';
                            }, 1800);
                        }
                    }
                })
            })
        });
    </script>
</body>

</html>