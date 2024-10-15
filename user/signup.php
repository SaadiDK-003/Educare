<?php
require_once '../core/database.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <?php include_once './includes/style_links.php'; ?>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="backg">
    <div class="fcontainer">
      <form id="sign-up">
        <span></span>
        <h3>Sign Up</h3>

        <h4>First name</h4>
        <input
          type="text"
          name="fname"
          id="fname"
          required
          placeholder="Enter your first name" />

        <h4>Last name</h4>
        <input
          type="text"
          name="lname"
          id="lname"
          required
          placeholder="Enter your last name" />

        <h4>Email</h4>
        <input
          type="email"
          name="email"
          id="email"
          required
          placeholder="Enter your email" />

        <h4>Password</h4>
        <input
          type="password"
          name="pass"
          id="pass"
          required
          placeholder="Enter your password" />

        <h4>User Type</h4>
        <select name="userType" required>
          <option value="Student">Student</option>
          <option value="Teacher">Teacher</option>
        </select>

        <input type="submit" name="submit" value="Sign up" class="fbtn" />

        <p>Already have an account? <a href="login.php">Log in</a></p>
      </form>
    </div>
  </div>
  <?php include_once './includes/js_links.php'; ?>

  <script>
    $(document).ready(function() {
      $('#sign-up').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
          url: 'ajax/user.php',
          method: 'post',
          data: formData,
          success: function(response) {
            let res = JSON.parse(response);
            console.log(res);
            $("#sign-up > span").html(`<h5 class="${res.status}">${res.msg}</h5>`);
            if (res?.status == 'alert alert-success') {
              setTimeout(() => {
                window.location.href = './login.php';
              }, 1800);
            }
          }
        });

      });
    });
  </script>
</body>

</html>