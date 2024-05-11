<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['admin_id'];

$sql1 = "SELECT count(*) FROM user";
$res1 = $mysqli->query($sql1);
if ($res1) {
  if ($res1->num_rows > 0) {
    $row = $res1->fetch_assoc();
    $num_user = $row['count(*)'];
  }
}

$sql2 = "SELECT count(*) FROM passenger";
$res2 = $mysqli->query($sql2);
if ($res2) {
  if ($res2->num_rows > 0) {
    $row = $res2->fetch_assoc();
    $num_pass = $row['count(*)'];
  }
}

$sql3 = "SELECT count(*) FROM train";
$res3 = $mysqli->query($sql3);
if ($res3) {
  if ($res3->num_rows > 0) {
    $row = $res3->fetch_assoc();
    $num_train = $row['count(*)'];
  }
}

$sql4 = "SELECT sum(train_fare) FROM passenger";
$res4 = $mysqli->query($sql4);
if ($res4) {
  if ($res4->num_rows > 0) {
    $row = $res4->fetch_assoc();
    $sum_fare = $row['sum(train_fare)'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    /* Main CSS Here */

    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    * {
      /* margin: 0; */
      padding: 0;
      box-sizing: border-box;
      /* font-family: "Poppins", sans-serif; */
    }

    :root {
      --background-color1: #fafaff;
      --background-color2: #ffffff;
      --background-color3: #ededed;
      --background-color4: #cad7fda4;
      --primary-color: #4b49ac;
      --secondary-color: #0c007d;
      --Border-color: #3f0097;
      --one-use-color: #3f0097;
      --two-use-color: #5500cb;
    }

    body {
      background-color: var(--background-color4);
      max-width: 100%;
    }

    /* 
    header {
      height: 70px;
      width: 100vw;
      padding: 0 30px;
      background-color: var(--background-color1);
      position: fixed;
      z-index: 100;
      box-shadow: 1px 1px 15px rgba(161, 182, 253, 0.825);
      display: flex;
      justify-content: space-between;
      align-items: center;
    } */



    .main-container {
      display: flex;
      width: 100vw;
      position: relative;
      z-index: 1;
    }


    /* .main {
      height: calc(100vh - 70px);
      width: 100%;
      padding: 0px 30px 30px 30px;
    } */

    .main::-webkit-scrollbar-thumb {
      background-image:
        linear-gradient(to bottom, rgb(0, 0, 85), rgb(0, 0, 50));
    }

    .main::-webkit-scrollbar {
      width: 5px;
    }

    .main::-webkit-scrollbar-track {
      background-color: #9e9e9eb2;
    }

    .box-container {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      flex-wrap: wrap;
      gap: 50px;
    }

    .box {
      height: 130px;
      width: 230px;
      border-radius: 20px;
      box-shadow: 3px 3px 10px rgba(0, 30, 87, 0.751);
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-around;
      cursor: pointer;
      transition: transform 0.3s ease-in-out;
    }

    .box:hover {
      transform: scale(1.08);
    }

    .box:nth-child(1) {
      background-color: #b945f7;
    }

    .box:nth-child(2) {
      background-color: #b945f7;
    }

    .box:nth-child(3) {
      background-color: #b945f7;
    }

    .box:nth-child(4) {
      background-color: #b945f7;
    }

    .box img {
      height: 50px;
    }

    .box .text {
      color: white;
    }

    .topic {
      font-size: 13px;
      font-weight: 400;
      letter-spacing: 1px;
    }

    .topic-heading {
      font-size: 30px;
      letter-spacing: 3px;
    }

    .report-container {
      min-height: 300px;
      max-width: 1200px;
      margin: 50px auto 30px auto;
      background-color: #ffffff;
      border-radius: 30px;
      box-shadow: 3px 3px 10px rgb(188, 188, 188);
      padding: 0px 20px 20px 20px;
    }
  </style>
</head>

<?php include('assets/inc/head.php'); ?>

<body style="  background-color: #f8ebfc;">

  <div style="margin-top:4%;">
    <!--Navigation Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navigation Bar-->

    <!--End Sidebar-->
    <div>

      <div>
        <div>

          <div class="report-container">

            <div class="Image" ">
            <center>
            <img
            src=" ../assets/images/metro.png" alt="Views" style="width:1050px; height:400px;margin-top: 20px;border-radius:30px;
          " />
            </center>
          </div>



          <div class="box-container" style="margin: 30px;">

            <div class="box box1">
              <div class="text">
                <h2 class="topic-heading"><?php echo $num_train ?></h2>
                <h2 class="topic">No. of Trains</h2>
              </div>

              <img src="../assets/images/train_f.png" alt="trains" />
            </div>

            <div class="box box2">
              <div class="text">
                <h2 class="topic-heading"><?php echo $num_user ?></h2>
                <h2 class="topic">No. of Users</h2>
              </div>

              <img src="../assets/images/user.png" alt="users" />
            </div>

            <div class="box box3">
              <div class="text">
                <h2 class="topic-heading"><?php echo $num_pass ?></h2>
                <h2 class="topic">Passengers booked</h2>
              </div>

              <img src="../assets/images/passenger.png" alt="passengers" />
            </div>

            <div class="box box4">
              <div class="text">
                <h2 class="topic-heading"><?php echo $sum_fare ?></h2>
                <h2 class="topic">Total Payment</h2>
              </div>
              <img src="../assets/images/payment.png" alt="payment" />

            </div>

          </div>
        </div>

      </div>
      <?php include('assets/inc/footer.php'); ?>
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