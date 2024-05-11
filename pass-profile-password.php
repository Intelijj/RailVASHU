<?php
session_start();
include('assets/inc/config.php');
//date_default_timezone_set('Africa /Nairobi');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];

if (isset($_POST['Update_Password'])) {
  $query = "SELECT `user_pwd` from `user` where `user_id` = $aid";
  $result = $mysqli->query($query);
  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pass_pwd = $row['user_pwd'];
  }

  $old_pwd = sha1(md5($_POST['old_pwd']));
  if ($pass_pwd == $old_pwd) {
    $new_pwd = sha1(md5($_POST['new_pwd']));
    $query = "update user set user_pwd = ? where user_id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('si', $new_pwd, $aid);
    $stmt->execute();
    if ($stmt) {
      $succ1 = "Password  Updated";
    }
  } else {
    $err = "Please Try Again Later";
  }
}
#echo"<script>alert('Your Profile Has Been Updated Successfully');</script>";

?>


<!DOCTYPE html>
<html lang="en">
<!--Head-->

<head>
  <style>
    .button {
      display: inline-block;
      border-radius: 8px;
      background-color:#bf56e8;
      border: none;
      color: black;
      text-align: center;
      font-size: 10px;
      padding: 5px;
      width: 100px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
    }

    .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .button span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }

    .button:hover span {
      padding-right: 25px;
    }

    .button:hover span:after {
      opacity: 1;
      right: 0;
    }

    input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;

    }

    input[type=text]:focus {
      background-color: lightblue;
    }

    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;
      outline: none;
    }

    input[type=password]:focus {
      background-color: lightblue;
    }

    input[type=email] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;
      outline: none;
    }

    input[type=email]:focus {
      background-color: lightblue;
    }

    input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 6px 0;

      border-radius: 10px;
    }

    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border-radius: 10px;
    }

    input[type=email] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border-radius: 10px;
    }

    * {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* styles.css */
    .label-custom {
      font-size: 10px;
      color: black;
      font-weight: bold;
    }

    .parentDiv {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 10px;
      /* Rounded corners for the parent only */
    }

    .childDiv {
      flex: 1;
      padding: 10px;
    }

    .leftChild {
      background-color: #ed77b2;
      /* Yellow background color */
    }

    .childDiv img {
      max-width: 100%;
      height: auto;
    }

    .childDiv form {
      display: flex;
      flex-direction: column;
    }

    .childDiv form label,
    .childDiv form input {
      margin-bottom: 10px;
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }

    .card-header {
      font-size: 24px;
      font-weight: bold;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      color:#e84362;
      /* Text color */
      text-transform: uppercase;
      /* Uppercase text */
      letter-spacing: 2px;
      /* Adjust letter spacing */
      text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.5);
      /* Increased shadow effect */
    }

    /* .love{
  background-color:pink;
} */
    .horizontal-line {
      border-top: 10px solid #690191;
      /* 1px solid red line */
      width: 100%;
      margin-bottom: 10px;
    }
  </style>
</head>

<?php include('assets/inc/head.php'); ?>
<!--End Head-->

<body style="  background-color: #f8ebfc;">
  <div class="be-wrapper be-fixed-sidebar ">
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div style="margin-left: 8%;">
      <?php if (isset($succ1)) { ?>
        <!--This code for injecting an alert-->
        <script>
          setTimeout(function() {
              swal("Success!", "<?php echo $succ1; ?>!", "success");
            },
            100);
        </script>

      <?php } ?>
      <?php if (isset($err)) { ?>
        <!--This code for injecting an alert-->
        <script>
          setTimeout(function() {
              swal("Failed!", "<?php echo $err; ?>!", "Failed");
            },
            100);
        </script>

      <?php } ?>
      <div class="main-content container-fluid">
        <?php
        $aid = $_SESSION['pass_id'];
        $ret = "select * from user where user_id=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $aid);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
        ?>

          <div class="main-content container-fluid">
            <div class="row">
              <div class="col-md-11">
                <div class="card card-border-color card-border-color-primary" style="border-color:#690191;">
                  <div class="card-header card-header-divider" style="font-size: 40px; font-weight: bold;">Change Password <span class="card-subtitle" style="  color:#e84362;">Please Fill All Details</span></div>
                  <div class="card-body">

                    <form method="POST">
                      <div class="horizontal-line"></div>
                      <div class="parentDiv" style="border-radius: 100px;">
                        <div class="childDiv leftChild" style="border-top-left-radius: 80px;border-bottom-left-radius: 80px;">
                          <img src="./assets/images/lock.png" alt="Image" class="center" width="150" height="150" style=" margin-top: 40px;">
                        </div>
                        <div class="childDiv">

                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"> Old Password</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="old_pwd" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"> New Password</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="new_pwd" id="inputText3" type="password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Confirm Password</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="route" id="inputText3" type="password">
                            </div>
                          </div>


                          <div class="col-sm-6">
                            <p class="text-right">
                              <input class="button" value="Update Password" name="Update_Password" type="submit" style="margin-left:20px">
                              <button class="button" style="margin-right:-160px"><span>Cancel</span></button>
                            </p>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        <?php } ?>

      </div>
      <!--footer-->
      <?php include('assets/inc/footer.php'); ?>
      <!--EndFooter-->

    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
    <script src="assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
    <script src="assets/lib/bs-custom-file-input/bs-custom-file-input.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.formElements();
      });
    </script>
</body>

</html>