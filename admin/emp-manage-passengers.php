<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
// $aid = $_SESSION['emp_id'];
//delete or remove library user  php code
if (isset($_GET['del'])) {
  $id = intval($_GET['del']);
  $adn = "delete from user where user_id=?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();

  if ($stmt) {
    $succ = "Pasenger Details Removed";
  } else {
    $err = "Try Again Later";
  }
}
?>
<!--End Server side scriptiing-->
<!DOCTYPE html>
<html lang="en">
<!--HeAD-->
<style>
  .booked {
    

    border-radius: 7px;
    width: 1300px;
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

  /* USER LIST TABLE */
  .user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
  }

  .user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
  }

  .user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
  }

  /* TABLES */
  .table {
    border-collapse: separate;
  }

  .table-hover>tbody>tr:hover>td,
  .table-hover>tbody>tr:hover>th {
    background-color: #eee;
  }

  .table thead>tr>th {
    border-bottom: 1px solid #C2C2C2;
    padding-bottom: 0;
  }

  .table tbody>tr>td {
    font-size: 0.875em;
    background: #f5f5f5;
    border-top: 10px solid #fff;
    vertical-align: middle;
    padding: 12px 8px;
  }

  .table tbody>tr>td:first-child,
  .table thead>tr>th:first-child {
    padding-left: 20px;
  }

  .table thead>tr>th span {
    border-bottom: 2px solid #C2C2C2;
    display: inline-block;
    padding: 0 5px;
    padding-bottom: 5px;
    font-weight: normal;
  }

  .table thead>tr>th>a span {
    color: #344644;
  }

  .table thead>tr>th>a span:after {
    content: "\f0dc";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    margin-left: 5px;
    font-size: 0.75em;
  }

  .table thead>tr>th>a.asc span:after {
    content: "\f0dd";
  }

  .table thead>tr>th>a.desc span:after {
    content: "\f0de";
  }

  .table thead>tr>th>a:hover span {
    text-decoration: none;
    color: #2bb6a3;
    border-color: #2bb6a3;
  }

  .table.table-hover tbody>tr>td {
    -webkit-transition: background-color 0.15s ease-in-out 0s;
    transition: background-color 0.15s ease-in-out 0s;
  }

  .table tbody tr td .call-type {
    display: block;
    font-size: 0.75em;
    text-align: center;
  }

  .table tbody tr td .first-line {
    line-height: 1.5;
    font-weight: 400;
    font-size: 1.125em;
  }

  .table tbody tr td .first-line span {
    font-size: 0.875em;
    color: #969696;
    font-weight: 300;
  }

  .table tbody tr td .second-line {
    font-size: 0.875em;
    line-height: 1.2;
  }

  .table a.table-link {
    margin: 0 5px;
    font-size: 1.125em;
  }

  .table a.table-link:hover {
    text-decoration: none;
    color: #2aa493;
  }

  .table a.table-link.danger {
    color: #fe635f;
  }

  .table a.table-link.danger:hover {
    color: #dd504c;
  }

  .table-products tbody>tr>td {
    background: none;
    border: none;
    border-bottom: 1px solid #ebebeb;
    -webkit-transition: background-color 0.15s ease-in-out 0s;
    transition: background-color 0.15s ease-in-out 0s;
    position: relative;
  }

  .table-products tbody>tr:hover>td {
    text-decoration: none;
    background-color: #f6f6f6;
  }

  .table-products .name {
    display: block;
    font-weight: 600;
    padding-bottom: 7px;
  }

  .table-products .price {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
  }

  .table-products .price>i {
    color: #8dc859;
  }

  .table-products .warranty {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
  }

  .table-products .warranty>i {
    color: #f1c40f;
  }

  .table tbody>tr.table-line-fb>td {
    background-color: #9daccb;
    color: #262525;
  }

  .table tbody>tr.table-line-twitter>td {
    background-color: #9fccff;
    color: #262525;
  }

  .table tbody>tr.table-line-plus>td {
    background-color: #eea59c;
    color: #262525;
  }

  .table-stats .status-social-icon {
    font-size: 1.9em;
    vertical-align: bottom;
  }

  .table-stats .table-line-fb .status-social-icon {
    color: #556484;
  }

  .table-stats .table-line-twitter .status-social-icon {
    color: #5885b8;
  }

  .table-stats .table-line-plus .status-social-icon {
    color: #a75d54;
  }

  .booked {
    left: 50%;
    margin-top: 1%;
    border-radius: 7px;
    width: 1400px;
  }
</style>
<!-- end HEAD-->

<body>
  <div>
    <!--navbar-->
    <?php include('assets/inc/navbar.php'); ?>

    <div>

      <div>
        <div>
          <div>
            <div>
              <h2
                style="padding-left: 55px; padding-top: 7px; margin-left: 2%; font-weight: 900;">
               
                  <b>Manage Users</b>
             
              </h2>



              <div class="booked" style="margin-top:3%;margin-left:20px;background-color: white;"><br><br>
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
                  rel="stylesheet">
                <table class="table user-list" style="width: 1300px; margin: 0 auto; font-size: 15px;">
                  <thead>
                    <tr>
                      <th><span>User</span></th>
                      <th><span>Phone</span></th>
                      <th class="text-center"><span>Address</span></th>
                      <th><span>Email</span></th>
                      <th><span>Action</span></th>
                      <!-- <th>Name</th>
          <th>Phone No</th>
          <th>Address</th>
          <th>Email</th>
          <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    /*
                     *Lets get details of available trains!!
                     */
                    $ret = "SELECT * FROM user"; //sql code to get all details of trains.
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    $cnt = 1;
                    while ($row = $res->fetch_object()) {
                      ?>
                      <tr>
                        <td>
                          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                          <div style="font-size:15px; margin-top:13px;">
                          <center><?php echo $row->user_fname; ?>
                            <?php echo $row->user_lname; ?></center>
                          </div>
                        </td>
                        <td>
                          <div style="font-size:15px;">
                          <center> <?php echo $row->user_phone; ?></center>
                          </div>
                        </td>
                        <td class="text-center">
                          <span class="label label-default" style="  text-align: center;">
                          <center> <?php echo $row->user_addr; ?></center>
                          </span>
                        </td>
                        <td>
                          <a href="#" >
                           <center> <?php echo $row->user_email; ?></center>
                          </a>
                        </td>
                        <td style="width: 20%;">
                          <a href="emp-update-passenger.php?pass_id=<?php echo $row->user_id; ?>" class="table-link">
                          <center>
                            <span class="fa-stack">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                         
                          </a>
                          <a href="emp-manage-passengers.php?del=<?php echo $row->user_id; ?>" class="table-link danger">
                          
                            <span class="fa-stack">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                            </span>
                            </center>
                          </a>
                        </td>
                      </tr>
                      <!-- <tr class="odd gradeX even gradeC odd gradeA even gradeA ">
            <td>
              <?php echo $row->pass_fname; ?>
              <?php echo $row->pass_lname; ?>
            </td>
            <td>
              <?php echo $row->pass_phone; ?>
            </td>
            <td>
              <?php echo $row->pass_addr; ?>
            </td>
            <td class="center">
              <?php echo $row->pass_email; ?>
            </td>
            <td class="center"><a class="badge badge-success"
                href="emp-update-passenger.php?pass_id=<?php echo $row->pass_id; ?>">Update</a>
              <a class="badge badge-danger"
                href="emp-manage-passengers.php?del=<?php echo $row->pass_id; ?>">Delete</a>
              <a class="badge badge-primary"
                href="emp-view-pass.php?pass_id=<?php echo $row->pass_id; ?>">View</a>
            </td>
          </tr> -->
                    <?php } ?>
                  </tbody>
                </table>
                <br><br>
              </div>
            </div>
          </div>
        </div>

        <!--footer-->
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