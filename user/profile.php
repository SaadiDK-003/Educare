<?php
require_once '../core/database.php';

if (!is_loggedin()) {
  header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile settings</title>
  <?php include_once './includes/style_links.php'; ?>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="css/custom.min.css">
</head>

<body id="profile-page">
  <?php include_once './includes/header.php'; ?>
  <div class="container mt-3 mb-5">
    <h4 class="font-weight-bold py-3 mb-4">Account settings</h4>
    <div class="card overflow-hidden">
      <?php if (isset($_POST['submit'])):
        update_profile($_POST, $userID);
      endif; ?>
      <div class="row no-gutters row-bordered row-border-light">
        <div class="d-none col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a
              class="list-group-item list-group-item-action active"
              data-toggle="list"
              href="#account-general">General</a>
            <a
              class="list-group-item list-group-item-action"
              data-toggle="list"
              href="#account-change-password">Change password</a>
            <a
              class="list-group-item list-group-item-action"
              data-toggle="list"
              href="#account-info">Info</a>
            <a
              class="list-group-item list-group-item-action"
              data-toggle="list"
              href="#account-social-links">Social links</a>
            <a
              class="list-group-item list-group-item-action"
              data-toggle="list"
              href="#account-connections">Connections</a>
            <a
              class="list-group-item list-group-item-action"
              data-toggle="list"
              href="#account-notifications">Notifications</a>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
              <form action="" method="post">
                <div class="card-body media align-items-center d-none">
                  <img
                    src="https://bootdey.com/img/Content/avatar/avatar1.png"
                    alt
                    class="d-block ui-w-80" />
                  <div class="media-body ml-4">
                    <label class="btn btn-outline-primary">
                      Upload new photo
                      <input type="file" class="account-settings-fileinput" />
                    </label>
                    &nbsp;
                    <button type="button" class="btn btn-default md-btn-flat">
                      Reset
                    </button>
                    <div class="text-light small mt-1">
                      Allowed JPG, GIF or PNG. Max size of 800K
                    </div>
                  </div>
                </div>
                <hr class="border-light m-0" />
                <div class="row card-body">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">First name <span class="text-danger">*</span></label>
                      <input type="text" name="fname" class="form-control mb-1" value="<?= $userFirstName ?>" required />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">Last name <span class="text-danger">*</span></label>
                      <input type="text" name="lname" class="form-control" value="<?= $userLastName ?>" required />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">E-mail <span class="text-danger">*</span></label>
                      <input type="email" name="email" class="form-control mb-1" value="<?= $userEmail ?>" required />
                      <div class="d-none alert alert-warning mt-3">
                        Your email is not confirmed. Please check your inbox.<br />
                        <a href="javascript:void(0)">Resend confirmation</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" value="" />
                      <input type="hidden" name="currentPwd" value="<?= $userPwd ?>">
                    </div>
                  </div>
                  <div class="col-12 text-right mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>&nbsp;
                    <button type="button" class="btn btn-default">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- <div class="tab-pane fade" id="account-change-password">
              <div class="card-body pb-2">
                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control" />
                </div>
                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control" />
                </div>
                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control" />
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="account-info">
              <div class="card-body pb-2">
                <div class="form-group">
                  <label class="form-label">Bio</label>
                  <textarea class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">Birthday</label>
                  <input
                    type="text"
                    class="form-control"
                    value="May 3, 1995" />
                </div>
                <div class="form-group">
                  <label class="form-label">Country</label>
                  <select class="custom-select">
                    <option>KSA</option>
                    <option selected>Canada</option>
                    <option>UK</option>
                    <option>Germany</option>
                    <option>France</option>
                  </select>
                </div>
              </div>
              <hr class="border-light m-0" />
              <div class="card-body pb-2">
                <h6 class="mb-4">Contacts</h6>
                <div class="form-group">
                  <label class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    value="+0 (123) 456 7891" />
                </div>
                <div class="form-group">
                  <label class="form-label">Website</label>
                  <input type="text" class="form-control" value />
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="account-social-links">
              <div class="card-body pb-2">
                <div class="form-group">
                  <label class="form-label">Twitter</label>
                  <input
                    type="text"
                    class="form-control"
                    value="https://twitter.com/user" />
                </div>
                <div class="form-group">
                  <label class="form-label">Facebook</label>
                  <input
                    type="text"
                    class="form-control"
                    value="https://www.facebook.com/user" />
                </div>
                <div class="form-group">
                  <label class="form-label">Google+</label>
                  <input type="text" class="form-control" value />
                </div>
                <div class="form-group">
                  <label class="form-label">LinkedIn</label>
                  <input type="text" class="form-control" value />
                </div>
                <div class="form-group">
                  <label class="form-label">Instagram</label>
                  <input
                    type="text"
                    class="form-control"
                    value="https://www.instagram.com/user" />
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="account-connections">
              <div class="card-body">
                <button type="button" class="btn btn-twitter">
                  Connect to <strong>Twitter</strong>
                </button>
              </div>
              <hr class="border-light m-0" />
              <div class="card-body">
                <h5 class="mb-2">
                  <a
                    href="javascript:void(0)"
                    class="float-right text-muted text-tiny"><i class="ion ion-md-close"></i> Remove</a>
                  <i class="ion ion-logo-google text-google"></i>
                  You are connected to Google:
                </h5>
                <a
                  href="/cdn-cgi/l/email-protection"
                  class="__cf_email__"
                  data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
              </div>
              <hr class="border-light m-0" />
              <div class="card-body">
                <button type="button" class="btn btn-facebook">
                  Connect to <strong>Facebook</strong>
                </button>
              </div>
              <hr class="border-light m-0" />
              <div class="card-body">
                <button type="button" class="btn btn-instagram">
                  Connect to <strong>Instagram</strong>
                </button>
              </div>
            </div>
            <div class="tab-pane fade" id="account-notifications">
              <div class="card-body pb-2">
                <h6 class="mb-4">Activity</h6>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Email me when someone comments on my article</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Email me when someone answers on my forum thread</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Email me when someone follows me</span>
                  </label>
                </div>
              </div>
              <hr class="border-light m-0" />
              <div class="card-body pb-2">
                <h6 class="mb-4">Application</h6>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">News and announcements</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Weekly product updates</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked />
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Weekly blog digest</span>
                  </label>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <div class="d-none text-right mt-3">
      <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
      <button type="button" class="btn btn-default">Cancel</button>
    </div>
  </div>
  <?php include_once './includes/footer.php'; ?>
  <?php include_once './includes/js_links.php'; ?>
</body>

</html>