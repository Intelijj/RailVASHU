<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];

date_default_timezone_set('Asia/Kolkata');

$date = date("Y-m-d");

$time = date("H:i");

if (isset($_POST['feedback_submit'])) {
  $feedback = $_POST['message'];

  $query = "insert into feedback(user_id, feedback, date, time) values(?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  $rc = $stmt->bind_param('isss', $aid, $feedback, $date, $time);
  $stmt->execute();
  if ($stmt) {
    $succ = "Feedback submitted";
  } else {
    $err = "Please Try Again Later";
  }
}

?>
<!--End Server side scriptiing-->
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <style>
    .container1 {
      padding: 10px 70px 10px 70px;
      border-top: 7px solid rgb(103, 5, 79);
      margin: 90px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      background-color: rgb(247, 229, 246);
      max-width: 500px;
      margin: 90px auto;
      text-align: center;
    }

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    label {
      width: 120px;
      text-align: right;
      margin-right: 10px;
    }


    input[type="text"],
    input[type="password"],
    input[type="email"],
    textarea {
      width: calc(100% - 130px);
      padding: 10px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #555;
      border-radius: 5px;
      outline: none;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus,
    textarea:focus {
      background-color: lightblue;
    }
  </style>

</head>

<body>
  <div>
    <div>
      <?php include("assets/inc/navbar.php"); ?>

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
      <div class="container1">
        <div class="header1">
          <h2>Feedback</h2>
        </div>
        <!-- <?php echo $date . " " . $time . " " . $aid; ?> -->
        <form method="POST">
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" placeholder="First Name" />
          </div>

          <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" placeholder="Last Name" />
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email" />
          </div>

          <div class="form-group">
            <label for="Subject">Subject:</label>
            <input type="text" id="Subject" name="subject" placeholder="Subject" />
          </div>

          <div class="form-group">
            <label for="Message">Message:</label>
            <textarea id="Message" name="message" placeholder="Message"></textarea>
          </div>

          <input type="submit" name="feedback_submit" value="Submit" />
        </form>
      </div>
</body>

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

</html>