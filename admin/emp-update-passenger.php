<!--Server side code to handle passenger sign up-->
<?php
session_start();
include('assets/inc/config.php');
if (isset($_POST['Create_Profile'])) {
  $pass_id = $_GET['pass_id'];
  $pass_fname = $_POST['pass_fname'];
  #$mname=$_POST['mname'];
  $pass_lname = $_POST['pass_lname'];
  $pass_phone = $_POST['pass_phone'];
  $pass_addr = $_POST['pass_addr'];
  $pass_uname = $_POST['pass_uname'];
  $pass_email = $_POST['pass_email'];
  //$pass_pwd=sha1(md5($_POST['pass_pwd']));
  //sql to insert captured values
  $query = "update user  set  user_fname=?, user_lname=?, user_phone=?, user_addr=?, user_uname=?, user_email=? where user_id = ?";
  $stmt = $mysqli->prepare($query);
  $rc = $stmt->bind_param('ssssssi', $pass_fname, $pass_lname, $pass_phone, $pass_addr, $pass_uname, $pass_email, $pass_id);
  $stmt->execute();
  /*
   *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
   *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
   */
  //declare a varible which will be passed to alert function
  if ($stmt) {
    $success = "Passenger Account Updated";
  } else {
    $err = "Please Try Again Or Try Later";
  }


}
?>
<!--End Server Side-->

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .button {
      display: inline-block;
      border-radius: 8px;
      background-color: green;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 10px;
      padding: 10px;
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
      margin: 8px 0;

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
      background-color: yellow;
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
      color: #0c3c53;
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
      border-top: 10px solid #0c3c53;
      /* 1px solid red line */
      width: 100%;
      margin-bottom: 10px;
    }
  </style>
</head>
<!--Head-->
<?php include('assets/inc/head.php'); ?>
<!--End Head-->

<body>
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div >
      <?php if (isset($success)) { ?>
        <!--This code for injecting an alert-->
        <script>
          setTimeout(function () {
            swal("Success!", "<?php echo $success; ?>!", "success");
          },
            100);
        </script>

      <?php } ?>
      <?php if (isset($err)) { ?>
        <!--This code for injecting an alert-->
        <script>
          setTimeout(function () {
            swal("Failed!", "<?php echo $err; ?>!", "Failed");
          },
            100);
        </script>

      <?php } ?>
      <div class="main-content container-fluid">

        <!--Train Details forms-->
        <?php
        $aid = $_GET['pass_id'];
        $ret = "select * from user where user_id=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $aid);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
          ?>
          <div  style="margin-top:4%;">
            <div class="col-md-12">
              <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Update User Profile<span class="card-subtitle">Fill All
                    Details</span></div>
                <div class="card-body">
                  <form method="POST">
                    <!-- <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> First Name</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_fname" value="<?php echo $row->user_fname; ?>"
                          id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Last Name</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_lname" value="<?php echo $row->user_lname; ?>"
                          id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Phone Number</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_phone" value="<?php echo $row->user_phone; ?>"
                          id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Address</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_addr" value="<?php echo $row->user_addr; ?>" id="inputText3"
                          type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Email</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_email" value="<?php echo $row->user_email; ?>"
                          id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Username</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="pass_uname" value="<?php echo $row->user_uname; ?>"
                          id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <p class="text-right">
                        <input class="btn btn-space btn-primary" value="Update Passenger " name="Create_Profile"
                          type="submit">
                        <button class="btn btn-space btn-secondary">Cancel</button>
                      </p>
                    </div>
                </div>
                </form> -->
                    <div class="horizontal-line"></div>
                    <div class="parentDiv" style="border-radius: 100px;">
                      <div class="childDiv leftChild"
                        style="border-top-left-radius: 100px;border-bottom-left-radius: 100px;">
                        <img src="update_profile.png" alt="Image" class="center" width="200" height="200"
                          style=" margin-top: 30px;">

                      </div>
                      <div class="childDiv">
                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                            style="margin-top: 15px;">My First Name</label>
                          <div class="col-12 col-sm-8 col-lg-6">
                            <input class="form-control" name="pass_fname" value="<?php echo $row->user_fname; ?>"
                              id="inputText3" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                            style="margin-top: 12px;">My Last Name</label>
                          <div class="col-12 col-sm-8 col-lg-6">
                            <input class="form-control" name="pass_lname" value="<?php echo $row->user_lname; ?>"
                              id="inputText3" type="text">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                            style="margin-top: 12px;">My Email</label>
                          <div class="col-12 col-sm-8 col-lg-6">
                            <input class="form-control" name="pass_email" value="<?php echo $row->user_email; ?>"
                              id="inputText3" type="email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                            style="margin-top: 12px;">My Username</label>
                          <div class="col-12 col-sm-8 col-lg-6">
                            <input class="form-control" name="pass_uname" value="<?php echo $row->user_uname; ?>"
                              id="inputText3" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                            style="margin-top: 10px;">Mobile</label>
                          <div class="col-12 col-sm-8 col-lg-6">
                            <input class="form-control" name="pass_phone" value="<?php echo $row->user_email; ?>"
                              id="inputText3" type="text">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <p class="text-right">
                            <input class="button" value="Update Profile" name="Create_Profile" type="submit"
                              style="margin-left:20px">
                            <button class="button" style="margin-right:-160px"><span>Cancel</span></button>
                          </p>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>

          <?php } ?>

        </div>
        <!--footer-->
        <?php include('assets/inc/footer.php'); ?>
        <!--EndFooter-->
      </div>

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
    <script src="assets/js/swal.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function () {
        //-initialize the javascript
        App.init();
        App.formElements();
      });
    </script>
</body>

</html>