<?php
session_start();
include('assets/inc/config.php');
//date_default_timezone_set('Africa /Nairobi');
include('assets/inc/checklogin.php');
check_login();
// $aid = $_SESSION['emp_id'];
if (isset($_POST['add_train'])) {
  $number = $_POST['number'];
  $name = $_POST['name'];
  $route = $_POST['route'];
  $time = $_POST['time'];
  $distance = $_POST['distance'];
  $source = $_POST['source'];
  $destination = $_POST['destination'];
  $dep_time = $_POST['dep_time'];
  $arr_time = $_POST['arr_time'];
  $fare = $_POST['fare'];
  $seats = $_POST['passengers'];

  $routeArray = preg_split('/, ?/', $route);
  $routeWords = array_map(
    function ($index, $word) {
      return $index + 1 . '-' . $word;
    },
    array_keys($routeArray),
    $routeArray
  );

  $timeArray = preg_split('/, ?/', $time);
  $timeWords = array_map(
    function ($index, $word) {
      return $index + 1 . '-' . $word;
    },
    array_keys($timeArray),
    $timeArray
  );

  $distanceArray = preg_split('/, ?/', $distance);
  $distanceWords = array_map(
    function ($index, $word) {
      return $index + 1 . '-' . $word;
    },
    array_keys($distanceArray),
    $distanceArray
  );

  // Join the words with hyphens
  $final_route = implode('-', $routeWords);
  $final_time = implode('-', $timeWords);
  $final_distance = implode('-', $distanceWords);

  // Output the result
  // echo $hyphenSeparatedString;
  //sql querry to post the entered information
  $query = "insert into train (number, name, route, time, distance, source, destination, dep_time, arr_time, fare, seats) values(?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  //bind this parameters
  $rc = $stmt->bind_param('issssssssii', $number, $name, $final_route, $final_time, $final_distance, $source, $destination, $dep_time, $arr_time, $fare, $seats);
  $stmt->execute();
  if ($stmt) {
    $succ = "Train Added";
  } else {
    $err = "Please Try Again Later";
  }
  // #echo"<script>alert('Your Profile Has Been Updated Successfully');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .button {
      display: inline-block;
      border-radius: 8px;
      background-color: #bf56e8;
      border: none;
      color: black;
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
      color: #e84362;
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
<!--Head-->
<?php include('assets/inc/head.php'); ?>
<!--End Head-->

<body style="  background-color: #f8ebfc;">>
  <div class="be-wrapper be-fixed-sidebar ">
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div style="margin-left: 8%;">
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
        <div class="row">
          <div class="col-md-11">
            <div class="card card-border-color card-border-color-primary" style="border-color:#690191;">
              <div class="card-header card-header-divider" style="font-size: 40px; font-weight: bold;">Add train <span class="card-subtitle" style=" color:#e84362;">Please Fill All Details</span></div>
              <div class="card-body">

                <form method="POST">
                  <div class="horizontal-line"></div>
                  <div class="parentDiv" style="border-radius: 100px;">
                    <div class="childDiv leftChild" style="border-top-left-radius: 80px;border-bottom-left-radius: 80px;">
                      <img src="../assets/images/train.png" alt="Image" class="center" width="250" height="250" style=" margin-top: 260px;">
                    </div>
                    <div class="childDiv">

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"> Train Number</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="number" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;"> Train Name</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="name" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Route</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="route" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Station Timings</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="time" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Station Distances</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="distance" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Source Station</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="source" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Departure Time</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="dep_time" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Destination Station</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="destination" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Arrival Time</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="arr_time" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Number of passengers</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="passengers" id="inputText3" type="text">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3" style="margin-top: 12px;">Train Fare</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                          <input class="form-control" name="fare" id="inputText3" type="text">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <p class="text-right">
                          <input class="button" value="Add Train" name="add_train" type="submit" style="margin-left:20px">
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