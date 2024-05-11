<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];
?>

<!DOCTYPE html>
<html lang="en">
<!--Head-->

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
      border-radius: 10px;
    }

    input[type=text]:focus {
      background-color: lightblue;
    }

    input[type=date] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;
      border-radius: 10px;
    }

    input[type=date]:focus {
      background-color: lightblue;
    }

    input[type=number] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;
      border-radius: 10px;
    }

    input[type=number]:focus {
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
      border-radius: 8px;
      /* Rounded corners for the parent only */
      width: auto;
    }

    .childDiv {
      flex: 1;
      padding: 10px;
    }

    .leftChild {
      background-color:#ed77b2;
      /* Yellow background color */
    }

    .childDiv img {
      max-width: 100%;
      /* height: auto; */
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
      margin-top: 15px;
      margin-bottom: 10px;
      width: 40%;
      height: 70%;
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


  <div class="be-wrapper be-fixed-sidebar">
    <!--Navigation Bar-->
    <?php include("assets/inc/navbar.php"); ?>
    <!--End Naigation Bar-->
    <!--End Sidebar-->

    <!--Server Side Scrit To Fetch all details of logged in user-->
    <?php
    $aid = $_SESSION['pass_id']; //Assaign session variable to passenger ID
    $ret = "select * from user where user_id=?"; //sELECT ALL FROM PASSENGERS WHERE PASSENGER ID IS THE LOGGED ONE
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param('i', $aid);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    //$cnt=1;
    while ($row = $res->fetch_object()) //Display all passenger details
    {
    ?>

      <div class="row" style="margin-left: 8%;">
        <div class="main-content container-fluid">
          <div class="col-md-11">
            <div class="card card-border-color card-border-color-primary" style="border-color:#690191;">
              <div class="card-header card-header-divider" style="font-size: 40px; font-weight: bold;  margin-left: 35%;">Your Profile<span class="card-subtitle" style="color:#0c3c53;"></span></div>
              <div class="card-body">

                <form method="POST">

                  <div class="horizontal-line"></div>
                  <div class="parentDiv" style="border-radius: 100px;">

                    <div class="childDiv leftChild" style="border-top-left-radius: 100px;border-bottom-left-radius: 100px; justify-content: center; align-items: center;">
                      <img src="./assets/images/abc.png" alt="Image" style=" width: 100%; height: 100%">
                    </div>

                    <div class="childDiv">
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 15px;"><b>My First Name</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="admin_fname" readonly value="<?php echo $row->user_fname; ?>" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 10px;"><b>My Last Name</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="admin_lname" readonly value="<?php echo $row->user_lname; ?>" id="inputText3" type="text">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 10px;"><b>My Email</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="admin_email" readonly value="<?php echo $row->user_email; ?>" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 10px;"><b>My Username</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="admin_uname" readonly value="<?php echo $row->user_uname; ?>" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 10px;"><b>Mobile</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="user_phone" readonly value="<?php echo $row->user_phone; ?>" id="inputText3" type="number">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"><b>Location</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="user_addr" readonly value="<?php echo $row->user_addr; ?>" id="inputText3" type="text">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 8px;"><b>Birthday</b></label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="user_bday" readonly value="<?php echo $row->user_bday; ?>" id="inputText3" type="date">
                        </div>
                      </div>




                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
  <!--footer-->
  <?php include('assets/inc/footer.php'); ?>
  <!--EndFooter-->
  </div>
  </div>
<?php } ?>

</div>
<script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="assets/js/app.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/jquery.flot.time.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
<script src="assets/lib/jquery-flot/plugins/jquery.flot.tooltip.js" type="text/javascript"></script>
<script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    //-initialize the javascript
    App.init();
    App.pageProfile();
  });
</script>
</body>

</html>