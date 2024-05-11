<!-- Server side code for log in-->
<?php
session_start();
include('assets/inc/config.php'); //get configuration file
if (isset($_POST['pass_login'])) {
  $pass_email = $_POST['pass_email'];
  $pass_pwd = sha1(md5($_POST['pass_pwd'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT user_email ,user_pwd , user_id FROM user WHERE user_email=? and user_pwd=? "); //sql to log in user
  $stmt->bind_param('ss', $pass_email, $pass_pwd); //bind fetched parameters
  $stmt->execute(); //execute bind
  $stmt->bind_result($pass_email, $pass_pwd, $pass_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['pass_id'] = $pass_id; //assaign session to passenger id
  //$uip=$_SERVER['REMOTE_ADDR'];
  //$ldate=date('d/m/Y h:i:s', time());
  if ($rs) { //if its sucessfull
    header("location:pass-dashboard.php");
  } else {
    #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
    $error = "Access Denied Please Check Your Credentials";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/img/favicon.ico">
  <title>Orion Railway Reservation System</title>
  <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />
  <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />

  <style>
    .register {
      width: 480px;
      height: 620px;
      background-color: #fff;
      margin-top: 3%;
      margin-left: 33%;
      bottom: 30px;
      box-sizing: border-box;
      border-top: 5px solid #4285f4;
      padding: 10px 35px;
      margin-bottom: 30px;
    }

    h1 {
      text-align: center;
      font-size: 24px;
      font-weight: 800;
    }

    input {
      margin-bottom: 20px;
    }

    input[type="password"],
    input[type="email"] {
      border: 1px solid grey;
      height: 40px;
      font-size: 16px;
      padding-left: 25px;
      width: 100%;
    }

    input[type="submit"] {
      border: none;
      height: 40px;
      color: white;
      background: #4285f4;
      font-size: 18px;
      width: 100%;
    }

    input[type="submit"]:hover {
      cursor: pointer;
      background: #4285f4;
      color: #000;
    }
  </style>

  <!--Trigger Sweet Alert-->
  <?php if (isset($error)) { ?>
    <!--This code for injecting an alert-->
    <script>
      setTimeout(function() {
          swal("Failed!", "<?php echo $error; ?>!", "error");
        },
        100);
    </script>

  <?php } ?>
</head>

<body class="be-splash-screen">
  <div class="be-wrapper be-login">
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="splash-container">
          <div class="card card-border-color card-border-color-primary">
            <div class="card-header"><span> Login <span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">

              <!--Login Form-->
              <form method="POST">
                <input class="form-control" name="pass_email" type="email" placeholder="Email" autocomplete="off">
                <input class="form-control" name="pass_pwd" type="password" placeholder="Password">

                <div class="form-group row login-tools">
                  <div class="col-6 login-forgot-password"><a href="pass-pwd-forgot.php">Forgot Password?</a></div>
                </div>

                <div class="form-group row login-submit">
                  <div class="col-6"><a class="btn btn-secondary btn-xl" href="pass-signup.php">Register</a></div>
                  <div class="col-6"><input type="submit" name="pass_login" class="btn btn-primary btn-xl" value="Log In"></div>
                </div>

            </div>
            </form>
            <!--End Login-->
          </div>
        </div>
        <div class="splash-footer"><a href="index.php">Home</a></div>

        <div class="splash-footer">&copy; 2022 - <?php echo date('Y'); ?> VASHU Railway Reservation System </div>
      </div>
    </div>
  </div>
  </div>
  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script src="assets/js/swal.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
    });
  </script>
</body>

</html>