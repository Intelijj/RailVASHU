<?php
session_start();
include('assets/inc/config.php');
//date_default_timezone_set('Africa /Nairobi');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];
$train_no = $_GET['number'];
$src = $_SESSION['src'];
$dest = $_SESSION['dest'];
$date = $_SESSION['date'];

$get_train_name = "SELECT name, fare FROM train WHERE number = '$train_no'";
$result = $mysqli->query($get_train_name);
if ($result) {
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $train_name = $row['name'];
    $fare = $row['fare'];
  }
}

$get_src_index = "SELECT SUBSTRING(route, POSITION('$src' IN route) - 2, 1) AS character_before_substring FROM train WHERE POSITION('$src' IN route) > 0 AND number='$train_no'";
$result = $mysqli->query($get_src_index);
if ($result) {
  if ($result->num_rows > 0) {
    $row1 = $result->fetch_assoc();
    $src_index = $row1['character_before_substring'];
  }
}

$get_dest_index = "SELECT SUBSTRING(route, POSITION('$dest' IN route) - 2, 1) AS character_before_substring FROM train WHERE POSITION('$dest' IN route) > 0 AND number='$train_no'";
$result = $mysqli->query($get_dest_index);
if ($result) {
  if ($result->num_rows > 0) {
    $row2 = $result->fetch_assoc();
    $dest_index = $row2['character_before_substring'];
  }
}

$temp1 = $src_index . '-';
$get_src_time = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(time, '$temp1', -1), '-', 1) AS time_after_char
                          FROM train WHERE number = '$train_no'";
$result = $mysqli->query($get_src_time);
if ($result) {
  if ($result->num_rows > 0) {
    $row3 = $result->fetch_assoc();
    $src_time = $row3['time_after_char'];
  }
}

$temp2 = $dest_index . '-';
$get_dest_time = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(time, '$temp2', -1), '-', 1) AS time_after_char
                          FROM train WHERE number = '$train_no'";
$result = $mysqli->query($get_dest_time);
if ($result) {
  if ($result->num_rows > 0) {
    $row4 = $result->fetch_assoc();
    $dest_time = $row4['time_after_char'];
  }
}

$time1 = DateTime::createFromFormat('H:i', $src_time);
$time2 = DateTime::createFromFormat('H:i', $dest_time);

// If $time2 is before $time1, add a day to $time2
if ($time2 < $time1) {
  $time2->modify('+1 day');
}

// Calculate the time difference
$timeDif = $time1->diff($time2);
$duration = $timeDif->format('%H:%I');

$get_src_distance = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`distance`, '$temp1', -1), '-', 1) AS distance_after_char
                          FROM train WHERE `number` = '$train_no'";
$result = $mysqli->query($get_src_distance);
if ($result) {
  if ($result->num_rows > 0) {
    $row5 = $result->fetch_assoc();
    $src_distance = $row5['distance_after_char'];
  }
}

$get_dest_distance = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`distance`, '$temp2', -1), '-', 1) AS distance_after_char
                          FROM train WHERE `number` = '$train_no'";
$result = $mysqli->query($get_dest_distance);
if ($result) {
  if ($result->num_rows > 0) {
    $row6 = $result->fetch_assoc();
    $dest_distance = $row6['distance_after_char'];
  }
}

$travel_distance = $dest_distance - $src_distance;

$get_total_distance = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`distance`, '$temp2', -1), '-', -1) AS distance_after_char
                          FROM train WHERE `number` = '$train_no'";
$result = $mysqli->query($get_total_distance);
if ($result) {
  if ($result->num_rows > 0) {
    $row7 = $result->fetch_assoc();
    $total_distance = $row7['distance_after_char'];
  }
}

$calc_fare = round($fare * ($travel_distance / $total_distance));

if (isset($_POST['Book_Train'])) {
  do {
    $pnr = mt_rand(1000000000, 9999999999);
    // Check if $pnr already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM booked WHERE pnr = ?";
    $checkStmt = $mysqli->prepare($checkQuery);
    $checkStmt->bind_param('i', $pnr);
    $checkStmt->execute();
    $checkStmt->bind_result($c);
    $checkStmt->fetch();
    $checkStmt->close();
  } while ($c > 0);

  echo "pnr: " . $pnr;

  $query = "insert into booked(pnr, user_id, train_no, train_name) values(?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  $rc = $stmt->bind_param('iiis', $pnr, $aid, $train_no, $train_name);
  $stmt->execute();
  if ($stmt) {
    $count = 0;

    foreach ($_POST['p_name'] as $key => $value) {
      $count++;
      $pass_name = $_POST['p_name'][$key];
      $pass_email = $_POST['p_email'][$key];

      $query = "insert into passenger (pnr, user_id, pass_name, pass_email, train_name, train_no, date, train_dep_stat, dep_time, train_arr_stat, arr_time, distance, train_fare) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $mysqli->prepare($query); //prepare sql and bind it later
      $rc = $stmt->bind_param('iisssisssssii', $pnr, $aid, $pass_name, $pass_email, $train_name, $train_no, $date, $src, $src_time, $dest, $dest_time, $travel_distance, $calc_fare);
      $stmt->execute();
    }
    $query = "UPDATE train SET seats = seats - $count WHERE number = $train_no";
    $result = $mysqli->query($query);
  } else {
    $err = "Please Try Again Later";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <style>
    .trainde {
      width: 1000px;
      height: 200px;
      border: 1px solid rgb(0, 0, 0);
    }


    .tra {
      display: flex;
      background-color: rgb(247, 233, 243);
      width: 1000px;
    }

    .st {
      display: flex;
    }

    .tm {
      display: flex;
    }

    .pname,
    .pemail,
    .page {
      height: 40px;
      padding-left: 15px;

    }

    .gender {
      padding-left: 12px;
      color: rgb(81, 81, 166);
    }

    .pname::placeholder,
    .pemail::placeholder,
    .page::placeholder {
      color: rgb(81, 81, 166);
    }

    .passenger {
      width: 1000px;
      height: 100px;

    }

    #passenger-list {
      border: 1px solid black;
      width: 1000px;
    }
  </style>
</head>
<style>
  .booked1 {
    left: 50%;
    margin-top: 1%;
    border-radius: 7px;
    width: 1300px;
    margin-left: 4%
  }

  .booked {
    left: 50%;
    margin-top: 1%;
    border-radius: 7px;
    width: 1400px;
  }

  .rounded-entry {
    border-radius: 10px;
    background-color: #f0f0f0;
    border: 2px solid red;
    /* Add this line for the red border */
  }

  a {
    color: #47b2e4;
    text-decoration: none;
  }

  a:hover {
    color: #73c5eb;
    text-decoration: none;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: "Jost", sans-serif;
  }

  body {
    font-family: "Open Sans", sans-serif;

    background-color: #f8ebfc;

  }

  .first {
    border-radius: 10px;
    background-color: lightgoldenrodyellow;
    left: 0%;
    margin-top: 1%;
    border-radius: 7px;
    width: 1400px;
    margin-left: 3%
  }

  .button25 {
    background-color: #04AA6D;
    /* Green */
    border: none;
    color: white;
    padding: 12px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 20px;
  }

  .button2 {
    background-color: #008CBA;
  }

  /* Blue */
  .button3 {
    background-color: #f44336;
    border-radius: 20px;
  }

  /* Red */
  .button4 {
    background-color: #e7e7e7;
    color: black;
  }

  /* Gray */
  .button5 {
    background-color: #555555;
  }
</style>
<!--Head-->
<?php include('assets/inc/head.php'); ?>
<!--End Head-->

<body style=" background-color: #f8ebfc;">
  <div class="be-wrapper be-fixed-sidebar ">
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div style="margin-left: 4%">
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
          <div class="row">
            <div>
              <h2 style="padding-left: 55px; padding-top: 7px;">
                <b> Train Information <i style="font-size:24px;color: darkblue; rotate: skewY(90deg);" class="fa fa-train"></i> </b>
              </h2>
              <div class="booked" style="width: 1250px;margin-left:4%; margin-top:1%;background-color: white;">
                <table style="width: 1250px; border-collapse: separate;
                  border-spacing: 15px;">
                  <tr>
                    <td style="font-size:14px;">
                      <?php echo $train_no; ?>
                    </td>
                    <td style="font-size:14px;">
                      <div style="background-color: #aa39fa;   display: inline-block; padding: 5px 10px; border-radius: 25px; color: black;">
                        <b>
                          <?php echo $train_name; ?>
                        </b>
                      </div>
                    </td>
                    <td style="width: 280px;" style="font-size:14px;">
                      <b style="font-size:14px;"><b>
                          <?php echo $src_time; ?>
                        </b></b> <br>
                      <?php echo $src; ?>
                    </td>
                    <td style="width: 400px;font-size:14px;">
                      --------------------------<?php echo $duration ?> --------------------------
                      <i style="font-size:24px;color: black; rotate: skewY(90deg);" class="fa fa-train"></i><?php echo " ~ " . $travel_distance . " km" ?><br>

                    </td>
                    <td style="font-size:14px;"> <b>
                        <?php echo $dest_time; ?>
                      </b><br>
                      <?php echo $dest; ?>
                    </td>
                    <td style="font-size:14px;"><span class="badge badge-pill badge-success" style="background-color: #aa39fa; ">₹
                        <?php echo round($calc_fare); ?>
                      </span></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="font-size:14px;">
                      <b>Premium economy <br>value</b>
                    </td>
                    <td style="font-size:14px;">
                      <b> Capacity</b> (10kg)
                    </td>
                    <td style="font-size:14px;">
                      <b> Price ₹
                        <?php echo $fare; ?>
                      </b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="6">
                      <hr style="height:2px; border: none; border-top: 3.5px dotted #0c3c53;">

                    </td>
                  </tr>
                </table>
              </div><br><br>
              <div>
                <div class="detail" style="background-color: white;  margin-left: 4%; margin-top: 1%; border-radius: 7px;width: 1250px; padding-left: 10px; padding-top: 0.1px;">
                  <div style="margin-left: 1%;">
                    <h2 font-weight: bold;"> Traveller Details</h2>
                    <i class='fa fa-user' style="font-size: 24px;"></i>&nbsp;&nbsp;&nbsp;
                    <b style="font-size: 16px;">ADULT (12 yrs+)</b>

                  </div> </b> <br>
                  <hr>
                  <hr>
                  <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; margin-left: 20px;">
                    <button id="add-passenger-btn" class="button25 button2" style="border-radius: 5px; padding: 5px 10px; background-color: #aa39fa;">Add Passenger</button>
                    <button class="remove-passenger-btn" style="border-radius: 5px; padding: 5px 10px; background-color: #aa39fa; color: white; border: none; margin-right: 25px;">
                      Remove
                    </button>
                  </div>


                  <form method="POST">
                    <div class="pass1" style=" background-color: #f1f1f1; margin-top: 1%;margin-left: 1.8%;border-radius: 7px;width: 1200px;">
                      <div>
                        <p style="background-color: #f09eb5; height: 34px;padding: 7px 3px 8px; font-size: 16px;">
                          Enter name as
                          mentioned
                          on
                          your passport or Government approved IDs.</p>
                        <br><br>
                      </div>
                      <div id="passenger-li">
                        <div class="passenger">
                          <table style="margin-left: 5%; width: 1100px; border-collapse:separate;
                            border-spacing:0 15px;">
                            <tr>
                              <td>
                                <input type="text" class="pname" name="p_name[]" placeholder="Passenger Name" style="width: 180px; height: 30px;"><br>
                              </td>
                              <td>
                                <input type="text" class="pemail" name="p_email[]" placeholder="Email" style="width: 200px; height: 30px;"><br>
                              </td>
                              <td>
                                <input type="text" class="page" placeholder="Age" style="width: 200px; height: 30px;">
                              </td>
                              <td>
                                <select class="gender" style="width: 200px; height: 30px;">
                                  <option value="default" disabled selected> Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                  <option value="other">Other</option>
                                </select>
                              </td>
                            </tr>
                          </table>
                          <br>
                        </div>
                      </div>
                      <input class="button25" value="Book Train" name="Book_Train" type="submit" style="margin-left:39%">
                      <button class="button25 button3" style="margin-left:9%">Cancel</button><br><br><br>
                    </div>
                  </form><br>
                  <hr>
                  <hr>
                  <br>
                  <br>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>



  </div>
<?php } ?> -->
<!--footer-->
<?php include('assets/inc/footer.php'); ?>
<!--EndFooter-->
</div>

</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const addPassengerButton = document.getElementById("add-passenger-btn");
    const passengerList = document.getElementById("passenger-li");
    const removePassengerButton = document.querySelector(".remove-passenger-btn");

    addPassengerButton.addEventListener("click", function() {
      const passengerDiv = document.querySelector('.passenger'); // Update the class here
      const newPassengerDiv = passengerDiv.cloneNode(true);
      newPassengerDiv.querySelector('.pname').value = '';
      newPassengerDiv.querySelector('.pemail').value = '';
      newPassengerDiv.querySelector('.page').value = '';
      newPassengerDiv.querySelector('.gender').value = 'default';
      passengerList.appendChild(newPassengerDiv);
    });

    removePassengerButton.addEventListener("click", function() {
      const passengerDivs = passengerList.querySelectorAll('.passenger');
      if (passengerDivs.length > 1) {
        passengerList.removeChild(passengerDivs[passengerDivs.length - 1]);
      }
    });
  });
</script>


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