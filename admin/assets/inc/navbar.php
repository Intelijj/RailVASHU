<?php

/**
 *Server side code to get details of single passenger using id 
 */
$aid = $_SESSION['admin_id'];
$ret = "select * from admin where admin_id=?"; //fetch details of pasenger
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $aid);
$stmt->execute(); //ok
$res = $stmt->get_result();
//$cnt=1;
while ($row = $res->fetch_object()) {
?>
  <header id="header" class="fixed-top " style="background-color: black;">
    <div class="container d-flex align-items-center">
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar" style="margin-left: 35%;">
        <ul>
          <li><a class="nav-link scrollto active" style="color:white;" href="emp-dashboard.php">Dashboard</a></li>
          <li class="dropdown"><a href="#" id="specific-link"><span>Management</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!-- <li><a href="emp-add-passenger.php">Add Passengers</a></li> -->
              <li><a href="emp-manage-passengers.php">Manage Users</a></li>
              <!-- <li><a href="admin-add-employee.php">Add Employee</a></li> -->
              <!-- <li><a href="admin-manage-employee.php">Manage Employee</a></li> -->
            </ul>
          </li>
          <li class="dropdown"><a href="#" id="specific-link"><span>Passengers</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!-- <li><a href="emp-approved-tickets.php">View Ticket</a></li> -->
              <li><a href="emp-tickets.php">Passenger</a>
              </li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" id="specific-link"><span>Train Section</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="emp-add-train.php">Add Train</a></li>
              <li><a href="emp-manage-train.php">Manage Train</a>
              </li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" id="specific-link"><span>Feedback</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="emp-view-feedback.php">View Feedback</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" id="specific-link"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php
              $aid = $_SESSION['admin_id']; //assaign session a varible [PASSENGER ID]
              $ret = "select * from admin where admin_id=?";
              $stmt = $mysqli->prepare($ret);
              $stmt->bind_param('i', $aid);
              $stmt->execute(); //ok
              $res = $stmt->get_result();
              //$cnt=1;
              while ($row = $res->fetch_object()) {
              ?>
                <li><a href="emp-profile.php">View</a></li>
                <li><a href="emp-profile-update.php">Update</a>
                </li>
                <li><a href="emp-profile-password.php">Change Password</a></li>
              <?php } ?>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="emp-logout.php">Home</a></li>
          <li><a class="getstarted scrollto" style="border-color: #aa39fa;" href="emp-logout.php">Log Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <br>
<?php } ?>



<style>
  .navbar {
    padding: 0;
  }

  .navbar a {
    color: white;
    /* Initial color for links */
    text-decoration: none;
  }

  .navbar a.active {
    color: red;
    /* Color for the active link */
  }

  .navbar ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
  }

  .navbar li {
    position: relative;
  }

  .navbar a,
  .navbar a:focus {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0 10px 30px;
    font-size: 15px;
    font-weight: 500;
    color: #fff;
    white-space: nowrap;
    transition: 0.3s;
  }

  .navbar a i,
  .navbar a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
  }

  .navbar a:hover,
  .navbar .active,
  .navbar .active:focus,
  .navbar li:hover>a {
    color: #aa39fa;
  }

  .navbar .getstarted,
  .navbar .getstarted:focus {
    padding: 8px 20px;
    margin-left: 30px;
    border-radius: 50px;
    color: #fff;
    font-size: 14px;
    border: 2px solid #47b2e4;
    font-weight: 600;
  }

  .navbar .getstarted:hover,
  .navbar .getstarted:focus:hover {
    color: #fff;
    background-color: black;
  }

  .navbar .dropdown ul {
    display: block;
    position: absolute;
    left: 14px;
    top: calc(100% + 30px);
    margin: 0;
    padding: 10px 0;
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    background: #fff;
    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    transition: 0.3s;
    border-radius: 4px;
  }

  .navbar .dropdown ul li {
    min-width: 200px;
  }

  .navbar .dropdown ul a {
    padding: 10px 20px;
    font-size: 14px;
    text-transform: none;
    font-weight: 500;
    color: #eb2a81;
  }

  .navbar .dropdown ul a i {
    font-size: 12px;
  }

  .navbar .dropdown ul .active:hover,
  .navbar .dropdown ul a:hover,
  .navbar .dropdown ul li:hover>a {
    color: #47b2e4;
  }

  .navbar .dropdown:hover>ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
  }

  .navbar .dropdown .dropdown ul {
    top: 0;
    left: calc(100% - 30px);
    visibility: hidden;
  }

  .navbar .dropdown .dropdown:hover>ul {
    opacity: 1;
    top: 0;
    left: 100%;
    visibility: visible;
  }

  @media (max-width: 1366px) {
    .navbar .dropdown .dropdown ul {
      left: -90%;
    }

    .navbar .dropdown .dropdown:hover>ul {
      left: -100%;
    }
  }

  .mobile-nav-toggle {
    color: #fff;
    font-size: 28px;
    cursor: pointer;
    display: none;
    line-height: 0;
    transition: 0.5s;
  }

  .mobile-nav-toggle.bi-x {
    color: #fff;
  }

  @media (max-width: 991px) {
    .mobile-nav-toggle {
      display: block;
    }

    .navbar ul {
      display: none;
    }
  }

  .navbar-mobile {
    position: fixed;
    overflow: hidden;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    background: rgba(40, 58, 90, 0.9);
    transition: 0.3s;
    z-index: 999;
  }

  .navbar-mobile .mobile-nav-toggle {
    position: absolute;
    top: 15px;
    right: 15px;
  }

  .navbar-mobile ul {
    display: block;
    position: absolute;
    top: 55px;
    right: 15px;
    bottom: 15px;
    left: 15px;
    padding: 10px 0;
    border-radius: 10px;
    background-color: #fff;
    overflow-y: auto;
    transition: 0.3s;
  }

  .navbar-mobile a,
  .navbar-mobile a:focus {
    padding: 10px 20px;
    font-size: 15px;
    color: white;
  }

  .navbar-mobile a:hover,
  .navbar-mobile .active,
  .navbar-mobile li:hover>a {
    color: white;
  }

  .navbar-mobile .getstarted,
  .navbar-mobile .getstarted:focus {
    margin: 15px;
    color: white;
  }

  /* .navbar-mobile .dropdown ul {
                position: static;
                display: none;
                margin: 10px 20px;
                padding: 10px 0;
                z-index: 99;
                opacity: 1;
                visibility: visible;
                background: #fff;
                box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
            } */

  /* .navbar-mobile .dropdown ul li {
                min-width: 200px;
            }

            .navbar-mobile .dropdown ul a {
                padding: 10px 20px;
            }

            .navbar-mobile .dropdown ul a i {
                font-size: 12px;
            } */

  .navbar-mobile .dropdown ul a:hover,
  .navbar-mobile .dropdown ul .active:hover,
  .navbar-mobile .dropdown ul li:hover>a {
    color: white;
  }

  .navbar-mobile .dropdown>.dropdown-active {
    display: block;
  }

  #header {

    z-index: 997;
    padding: 15px 0;
  }

  #header.header-scrolled,
  #header.header-inner-pages {
    background: rgba(40, 58, 90, 0.9);
  }

  #header .logo {
    font-size: 30px;
    margin: 0;
    padding: 0;
    line-height: 1;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
  }

  #header .logo a {
    color: #fff;
  }

  #header .logo img {
    max-height: 40px;
  }
</style>