<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['emp_id'];
if (isset($_POST['update_train'])) {
  $number = $_GET['number'];
  $name = $_POST['name'];
  $route = $_POST['route'];
  $time = $_POST['time'];
  $distance = $_POST['distance'];
  $source = $_POST['source'];
  $destination = $_POST['destination'];
  $dep_time = $_POST['dep_time'];
  $arr_time = $_POST['arr_time'];
  $fare = $_POST['fare'];
  $seats = $_POST['seats'];
  //sql querry to post the entered information
  $query = "update train set name= ?, route = ?, time = ?, distance = ?, source = ?, destination = ?, dep_time = ?, arr_time = ?, fare = ?, seats = ? where number = ?";
  $stmt = $mysqli->prepare($query);
  //bind this parameters
  $rc = $stmt->bind_param('ssssssssiii', $name, $route, $time, $distance, $source, $destination, $dep_time, $arr_time, $fare, $seats, $number);
  $stmt->execute();
  if ($stmt) {
    $succ = "Train Updated";
  } else {
    $err = "Please Try Again Later";
  }
  #echo"<script>alert('Your Profile Has Been Updated Successfully');</script>";
}
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
<?php include('assets/inc/head.php'); ?>
<!--End Head-->

<body>
  <div style="margin-left:1%;">
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div>
      <?php if (isset($succ)) { ?>
        <!--This code for injecting an alert-->
        <script>
          setTimeout(function() {
              swal("Success!", "<?php echo $succ; ?>!", "success");
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
        <!--Train Details forms-->
        <?php
        $aid = $_GET['number'];
        $ret = "select * from train where number=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $aid);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
        ?>


          <div>
            <div>
              <div>
                <div class="card card-border-color card-border-color-primary">
                  <div class="card-header card-header-divider" style="font-size: 40px; font-weight: bold;">Update Train<span class="card-subtitle" style="color:#0c3c53;">Please Fill All The Details</span></div>
                  <div class="card-body">

                    <form method="POST">
                      <div class="horizontal-line"></div>
                      <div class="parentDiv" style="border-radius: 100px;">
                        <div class="childDiv leftChild" style="border-top-left-radius: 80px;border-bottom-left-radius: 80px;">
                          <img src="../assets/images/train.png" alt="Image" class="center" width="250" height="250" style=" margin-top: 260px;">
                        </div>
                        <div class="childDiv">

                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"> Train Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="name" value="<?php echo $row->name; ?>" id="inputText3" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Route</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="route" value="<?php echo $row->route; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Station Timing</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="time" value="<?php echo $row->time; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Station Distances</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="distance" value="<?php echo $row->distance; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Source Station</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="source" value="<?php echo $row->source; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Destination Station</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="destination" value="<?php echo $row->destination; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Departure Time</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="dep_time" value="<?php echo $row->dep_time; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Arrival Time</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="arr_time" value="<?php echo $row->arr_time; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Total Seats</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="seats" value="<?php echo $row->seats; ?>" id="inputText3" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Fare</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                              <input class="form-control" name="fare" value="<?php echo $row->fare; ?>" id="inputText3" type="text">
                            </div>
                          </div>


                          <div class="col-sm-6">
                            <p class="text-right">
                              <input class="button" value="Update Train" name="update_train" type="submit" style="margin-left:20px">
                              <button class="button" style="margin-right:-120px"><span>Cancel</span></button>
                            </p>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!--End Train Instance-->
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
  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
      App.formElements();
    });
  </script>
</body>

</html>