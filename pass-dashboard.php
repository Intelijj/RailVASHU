<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];
?>
<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<style>
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
    padding: 0;
    margin: 0;
    background-color: #f8ebfc;
  }

  .container1 {
    background: url(./assets/images/fr.png) center no-repeat;
    background-size: cover;
    height: 500px;
  }

  /* .centered2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    text-align: center;
  } */
  .search-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: rgba(255, 255, 255, 0.5);
    padding: 10px;
    border-radius: 15px;
    width: 900px;
    /* Rounded corners for the container */
  }

  .search-container input[type="text"],
  .search-container input[type="date"] {
    width: 120px;
    padding: 5px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    /* Rounded corners for the input fields */
  }

  .search-container button {
    padding: 10px;
    background-color: #aa39fa;
    color: #fff;
    width: 80px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    /* Rounded corners for the button */
  }

  label {
    margin-left: 10px;
    color: black;
  }
</style>
<!--Head-->
<!--End Head-->



<body>

  <div>

    <div>
      <?php include("assets/inc/navbar.php"); ?>
    </div>


    <div>
      <div>
        <div class="container1">
          <div class="centered2">
            <div class="source">
              <form method="POST">
                <div class="search-container">
                  <table style="width:1200px; height:150px">
                    <!-- <label for="source">Source:</label><br>
                <input type="text" name="src" class="form-control" placeholder="Source Station" required>
                <input type="text" name="dest" class="form-control" placeholder="Destination" required>
                <input type="date" name="date" class="form-control" required>
                <button type="submit" name="search" class="btn btn-primary">Search</button> -->
                    <tr>
                      <td colspan="4">
                        <label> FROM </label><br>
                        <input type="text" name="src" class="form-control" placeholder="Source Station" required>
                      </td>
                      <td colspan="2">
                        <label> TO </label><br>
                        <input type="text" name="dest" class="form-control" placeholder="Destination" required>
                      </td><br>
                      <td>
                        <label> DATE </label><br>
                        <input type="date" name="date" class="form-control" required>
                      </td>
                      <td>

                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                      </td>

                    </tr>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        <?php


        if (isset($_POST['search'])) {
          $Src = ucwords($_POST['src']);
          $Dest = ucwords($_POST['dest']);
          $Date = $_POST['date'];
        ?>
          <div>
            <div>
              <div>
                <div>
                  <div style="margin-left: 6%;">
                    <h4>
                      Departing Train <i style="font-size:24px;color: red; rotate: skewY(90deg);" class="fa fa-train" color:red></i>
                    </h4>
                    <h3>
                      <b>
                        <?php echo "{$Src} to {$Dest} "; ?><i style="font-size:18px;color: #444444;" class="fa">&#xf111;</i>
                      </b>
                      <?php echo $Date; ?>
                    </h3>
                    <!-- <?php echo $row->route; ?>                -->
                  </div>
                  <div class="booked" style="width: 1250px;margin-left:6%; margin-top:1%;background-color: white;">
                    <table style="width: 1250px; border-collapse: separate;
        border-spacing: 15px;">
                      <tbody>
                        <?php
                        $ret = "SELECT * FROM train WHERE route LIKE '%$Src-%$Dest%' ORDER BY RAND() LIMIT 50 ";

                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        $cnt = 1;
                        while ($row = $res->fetch_object()) {
                          $get_src_index = "SELECT SUBSTRING(`route`, POSITION('$Src' IN `route`) - 2, 1) AS character_before_substring FROM `train` WHERE POSITION('$Src' IN `route`) > 0 AND `number`='$row->number'";
                          $result = $mysqli->query($get_src_index);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row1 = $result->fetch_assoc();
                              $src_index = $row1['character_before_substring'];
                            }
                          }

                          $get_dest_index = "SELECT SUBSTRING(`route`, POSITION('$Dest' IN `route`) - 2, 1) AS character_before_substring FROM `train` WHERE POSITION('$Dest' IN `route`) > 0 AND `number`='$row->number'";
                          $result = $mysqli->query($get_dest_index);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row2 = $result->fetch_assoc();
                              $dest_index = $row2['character_before_substring'];
                            }
                          }

                          $temp1 = $src_index . '-';
                          $get_src_time = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`time`, '$temp1', -1), '-', 1) AS time_after_char
                          FROM train WHERE `number` = '$row->number'";
                          $result = $mysqli->query($get_src_time);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row3 = $result->fetch_assoc();
                              $src_time = $row3['time_after_char'];
                            }
                          }

                          $temp2 = $dest_index . '-';
                          $get_dest_time = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`time`, '$temp2', -1), '-', 1) AS time_after_char
                          FROM train WHERE `number` = '$row->number'";
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
                          FROM train WHERE `number` = '$row->number'";
                          $result = $mysqli->query($get_src_distance);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row5 = $result->fetch_assoc();
                              $src_distance = $row5['distance_after_char'];
                            }
                          }

                          $get_dest_distance = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`distance`, '$temp2', -1), '-', 1) AS distance_after_char
                          FROM train WHERE `number` = '$row->number'";
                          $result = $mysqli->query($get_dest_distance);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row6 = $result->fetch_assoc();
                              $dest_distance = $row6['distance_after_char'];
                            }
                          }

                          $travel_distance = $dest_distance - $src_distance;

                          $get_total_distance = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(`distance`, '$temp2', -1), '-', -1) AS distance_after_char
                          FROM train WHERE `number` = '$row->number'";
                          $result = $mysqli->query($get_total_distance);
                          if ($result) {
                            if ($result->num_rows > 0) {
                              $row7 = $result->fetch_assoc();
                              $total_distance = $row7['distance_after_char'];
                            }
                          }
                        ?>
                          <tr>
                            <td style="font-size:14px;">
                              <?php echo $row->number; ?>
                            </td>
                            <td style="font-size:14px;">
                              <div style="background-color: #aa39fa;  display: inline-block; padding: 5px 10px; border-radius: 25px; color: black;">
                                <b>
                                  <?php echo $row->name; ?>
                                </b>
                              </div>
                            </td>
                            <td style="width: 280px;" style="font-size:14px;">
                              <b style="font-size:14px;"><b>
                                  <?php echo $src_time; ?>
                                </b></b> <br>
                              <?php echo $Src; ?>
                            </td>
                            <td style="width: 400px;font-size:14px;">
                              --------------------------<?php echo $duration ?> --------------------------
                              <i style="font-size:24px;color: black; rotate: skewY(90deg);" class="fa fa-train"></i> <?php echo " ~ " . $travel_distance . " km" ?><br>

                            </td>
                            <td style="font-size:14px;"> <b>
                                <?php echo $dest_time; ?>
                              </b><br>
                              <?php echo $Dest; ?>
                            </td>
                            <td style="font-size:14px;"><span class="badge badge-pill badge-success">₹
                                <?php echo round($row->fare * ($travel_distance / $total_distance)); ?>
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
                                <?php echo round($row->fare * ($travel_distance / $total_distance)); ?>
                              </b>
                            </td>
                            <td style="font-size:14px;"><b>
                                <b>
                                  <?php
                                  if ($row->seats > 0) {
                                    echo '<span style="color: green;">Available: ' . $row->seats . '</span>';
                                  } else {
                                    echo 'Not Available';
                                  }
                                  ?>
                                </b>

                            </td>
                          </tr>
                          <tr>
                            <td colspan="6">
                              <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            </td>
                          </tr>
                      <?php
                        }
                      } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </div>
      <br>
      <!--footer-->
      <?php include('assets/inc/footer.php'); ?>
      <!--EndFooter-->
    </div>

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
  <script src="assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="assets/lib/countup/countUp.min.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="assets/lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
  <script src="assets/lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/jszip/jszip.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
      App.dashboard();

    });
  </script>
</body>

</html>