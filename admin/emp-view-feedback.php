<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Feedback</title>
  <style>
    
    .box1 {
      border: 2px solid black;
      border-radius: 10px;
      text-align: left;
      width: 200px;
      height: 40px;
      margin-left: 40px;
    }

    .box2 {
      border: 2px solid black;
      border-radius: 10px;
      text-align: left;
      width: 450px;
      height: 80px;
      margin-left: 20px;
    }

    .entry {
      display: flex;
      margin: 15px;
      align-items: center;
    }

    .parent {
      text-align: left;
      border: 2px solid black;
      border-radius: 10px;
      width: 600px;
      height: 200px;
      padding: 20px;

    }

    .container1 {
      display: flex;

      width: 120px;
      height: 20px;


    }

    /* Left segment style */
    .left-segment {
      flex: 1;
      /* padding: 20px;  */
      background-color: #e0e0e0;
      width: 60px;
      height: 20px;
    }

    /* Right segment style */
    .right-segment {
      flex: 1;
      /* padding: 20px;  */
      background-color: #f0f0f0;
      width: 60px;
      height: 20px;


    }
  </style>
</head>

<body style="  background-color: #f8ebfc;">

  <!--Navigation Bar-->
  <?php include('assets/inc/navbar.php'); ?>

  <?php 
  $aid = $_SESSION['pass_id'];
  $ret = "select * from feedback";
  $stmt = $mysqli->prepare($ret);
  $stmt->execute(); //ok
  $res = $stmt->get_result();
  //$cnt=1;
  while ($row = $res->fetch_object()) 
  { ?>
  <div class="parent">
    <div class="entry">
      <div>
        <p>User id:</p>
      </div>
      <div class="box1">
        <p> <?php echo $row->user_id ?></p>
      </div>
    </div>
    <div class="entry">
      <div class="container1">
        <div class="left-segment">
          Date


        </div>
        <div class="right-segment">
          <?php echo $row->date ?>
        </div>
      </div>
      <div class="container1">
        <div class="left-segment">
          Time

        </div>
        <div class="right-segment">
          <?php echo $row->time ?>
        </div>
      </div>
      <!-- <div style="margin-right: 40px;"><p>Date:3jan</p></div>
        <div ><p>Time: 5:00pm</p></div>
        -->
    </div>
    <div class="entry">
      <div>
        <p>Feedback:</p>
      </div>
      <div class="box2"> <?php echo $row->feedback ?></div>
    </div>
  </div>
  <?php } ?>
</body>

</html>