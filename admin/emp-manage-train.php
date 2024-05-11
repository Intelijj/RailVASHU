<!--Start Server side code to give us and hold session-->
<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
//delete or remove library user  php code
if (isset($_GET['del'])) {
  $id = intval($_GET['del']);
  $adn = "delete from train where number=?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();

  if ($stmt) {
    $succ = "Train Details Deleted";
  } else {
    $err = "Try Again Later";
  }
  #echo "<script>alert('Success! Book details removed');</script>" ;
}
?>
<!--End Server side scriptiing-->
<!DOCTYPE html>
<html lang="en">
<!--HeAD-->
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
    padding:0;
margin:0;
    background-color: #f8ebfc;
  }
</style>
<!-- end HEAD-->

<body>
  <!--navbar-->
  <?php include('assets/inc/navbar.php'); ?>
  <!--End navbar-->
  <!--Sidebar-->
  <!--End Sidebar-->

  <div>
    <div style="margin-left: 5%;">
      <h2 style="padding-left: 55px; padding-top: 7px;  font-weight: 900; margin-top: px;">
        <b> Manage Train <i style="font-size:24px;color: darkblue; rotate: skewY(90deg);" class="fa fa-train"></i> </b>
      </h2>
    </div>
    <?php if (isset($succ)) { ?>
      <!--This code for injecting an alert-->
      <script>
        setTimeout(function () {
          swal("Success!", "<?php echo $succ; ?>!", "success");
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

    <div>
      <div style="margin-left: 5%;">
        <div>
          <div>
            <div class="booked" style="width: 1250px;margin-left:4%; margin-top:1%;background-color: white;">
              <table style="width: 1250px; border-collapse: separate;
        border-spacing: 15px;">
                <tbody>
                  <?php
                  /*
                   *Lets get details of available trains!!
                   */
                  $ret = "SELECT * FROM train"; //sql code to get all details of trains.
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute(); //ok
                  $res = $stmt->get_result();
                  $cnt = 1;
                  while ($row = $res->fetch_object()) {
                    ?>
                    <tr>
                      <td style="font-size:14px;">
                        <?php echo $row->number; ?>
                      </td>
                      <td style="font-size:14px;">
                        <div
                          style="background-color: #aa39fa;   display: inline-block; padding: 5px 10px; border-radius: 25px; color: black;">
                          <b>
                            <?php echo $row->name; ?>
                          </b>
                        </div>
                      </td>
                      <td style="width: 280px;" style="font-size:14px;">
                        <b style="font-size:14px;"><b>
                          <?php echo $row->dep_time; ?>
                        </b></b> <br>
                        <?php echo $row->source; ?>
                      </td>
                      <td style="width: 400px;font-size:14px;">
                        -------------------------- 04h 45m --------------------------<i
                          style="font-size:24px;color: black; rotate: skewY(90deg);" class="fa fa-train"></i><br>
                        No stop
                      </td>
                      <td style="font-size:14px;"> <b>
                          <?php echo $row->arr_time; ?>
                        </b><br>
                        <?php echo $row->destination; ?>
                      </td>
                      <td style="font-size:14px;">
                          <a class="badge badge-success" href="emp-update-train.php?number=<?php echo $row->number; ?>"
                            style="border-radius: 10px; color:#f075bf;"> Update</a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" style="font-size:14px;">
                        <b>Premium economy <br>value</b>
                      </td>
                      <td style="font-size:14px;">
                        <b> Capacity</b> (10kg)
                      </td>
                      <td style="font-size:14px;">
                        <b> Price $
                          <?php echo $row->fare; ?>
                        </b>
                      </td>
                      <td style="font-size:14px;"><b>
                          <b>
                            <?php
                            if ($row->seats == 0) {
                              echo '<span style="color: red;">Not Available</span>';
                            } else {
                              echo '<span style="color: red;">Available ' . $row->seats . '</span>';
                            }
                            ?>
                          </b>
                          <!-- <a href = "pass-book-specific-train.php?id=<?php echo $row->id ?>">Click here</a></b> -->
                      </td>
                      <td>
                          <a class="badge badge-danger" href="emp-manage-train.php?del=<?php echo $row->number; ?>"
                            style="border-radius: 10px; color:#f075bf;">Delete</a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="6">
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                      </td>
                    </tr>
                    <!-- <tr class="odd gradeX even gradeC odd gradeA even gradeA ">
                        <td><?php echo $row->number; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->route; ?></td>
                        <td class="center"><?php echo $row->current; ?></td>
                        <td class="center"><?php echo $row->destination; ?></td>
                        <td class="center"><?php echo $row->time; ?></td>
                        <td class="center"><span class="badge badge-pill badge-success">Ksh<?php echo $row->fare; ?></span></td>
                        <td class="center"><?php echo $row->passengers; ?></td>
                        <td class="center"><a class ="badge badge-success" href ="emp-update-train.php?id=<?php echo $row->id; ?>">Update</a> 
                            <hr> <a class ="badge badge-danger" href ="emp-manage-train.php?del=<?php echo $row->id; ?>">Delete</a>
                            <hr><a class ="badge badge-primary" href ="emp-view-train.php?id=<?php echo $row->id; ?>">View</a>
                        </td>                      
                      </tr> -->
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<br><br><br>  
      <!--footer-->
      <div style="margin-top:90px; " >
        <center>
      <?php include('assets/inc/footer.php'); ?></center></div>
      <!--End Footer-->
    </div>
  </div>

  </div>
  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js"
    type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/jszip/jszip.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"
    type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script>
  <script src="assets/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"
    type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      //-initialize the javascript
      App.init();
      App.dataTables();
    });
  </script>
</body>

</html>