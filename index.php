<!DOCTYPE HTML>
<!--
	Orion Railway Reservation System
	martdevelopers254 | @MartinMbithi
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
  <title>VASHU Railway Reservation System</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <style>
    .navbar.navbar-dark.bg-dark {
      background-color: black;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      margin-right: 10px;
      
    }

    .navbar.navbar-dark.bg-dark .navbar-nav .nav-link {
      color: white;
    }


    .btn.btn-outline-success {
      border-color: #aa39fa;
      border-width: 2px;
      color: white;
    }

    .navb .navbar {
      padding-right: 150px;
      padding-left: 150px;
    }

    .navbar-nav .nav-item {
      margin: 0 10px;
    }

    .navbar-nav .nav-item a.nav-link {

      transition: background-color 0.5s;
    }

    .navbar-nav .nav-item a.nav-link:hover {
      background-color: #aa39fa !important;
      border-radius: 7px;
    }


    .imghome img {
      margin-top: 100px;
      width: 100%;
      height: 270px;
    

    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .image-container {
      margin: 0 30px;
      position: relative;

    }

    .image-container img {
      height: 150px;
      display: block;
      width: 250px;
      border-radius: 10px;
    }

    .imghome .image-text {
      position: absolute;
      top: 15%;
      left: 50%;

      transform: translate(-50%, -50%);
      color: black;
      font-size: 33px;
      padding: 10px;
      font-weight: bold;
    }

    .tex1 {
      position: absolute;
      top: 50%;
      left: 50%;

      transform: translate(-50%, -50%);
      color: white;
      font-size: 15px;
      padding: 10px;

    }

    .custom-button {
      background-color: #aa39fa;
      color: white;
     
      padding: 10px 15px;
     
      border: none;
     
      border-radius: 5px;
    
      cursor: pointer;
      
    }

    .container {
      display: flex;
      justify-content: center;

    }

    .box {
      display: flex;
      flex-direction: column;
      width: 450px;
     
      margin: 10px;
    }

    .column {
      display: flex;
      flex-direction: column;
    }

    .box .content {
      display: flex;
    }

    

    .box .text {
      flex: 1;
      padding: 10px;
    }

    .nav {
      background-color: black;
      text-align: center;
      justify-content: center;
      padding: 10px 0;
    }

    .nav a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
    }

    .t3 {
      position: absolute;
      top: 10px;
      left: 10px;
      background: rgba(128, 128, 128, 0.7);
     
      color: black;
      padding: 5px;
      font-size: 15px;
    }
  </style>
</head>
</head>

<body>
  <div class="navb">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><img src="./assets/images/train-ticket.png" style="width: 30px;height: 35px;" Ticketo Logo"><b>VASHU</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book-without-login.php">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./admin/emp-login.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about-us.php">About Us</a>
          </li>
        </ul>


        <a href="pass-login.php"> <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign in</button></a>

      </div>
    </nav>
  </div>
  <div class="imghome">
    <div>
      <img src="./assets/images/ctkt.png"" alt="">
    </div>
        <div class=" image-text">
      Discover the world of hassle-free travel
    </div>

    <div class="tex1">
      Plan your trip and find the best fares with ease!!
      <br><br>
      <center><a href="book-without-login.php"><button class=" custom-button">Book Now</button></a></center>
    </div>


  </div>
  <div style="background-color: rgb(237, 223, 248);">
    <br><br><br>

    <div>
      <div class="head1" style="font-weight:bold;margin-left:280px;font-size:28px;">Why Book IRCTC Train Ticket on VASHU ?</div>
      <br>
      <div class="container">
        <div class="column">
          <div class="box">
            <div class="content">

              <div class="image"> <img src="./assets/images/ticket.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>Get Train Tickets</h5>
                <p>With our same train alternates and prediction feature, increase your chances of getting confirm train tickets.</p>
              </div>

            </div>
          </div>

          <div class="box">
            <div class="content">
              <div class="image"><img src="./assets/images/fcf.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>
                  Free Cancellation on Train Tickets</h5>
                <p>Get a full refund on train tickets by opting our free cancellation feature.</p>
              </div>

            </div>
          </div>

          <div class="box">
            <div class="content">
              <div class="image"><img src="./assets/images/refund.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>
                  Instant Refund & Cancellation</h5>
                <p>Get an instant refund and book your next Train ticket easily.</p>
              </div>

            </div>
          </div>
        </div>
        <div class="column">
          <div class="box">
            <div class="content">
              <div class="image"><img src="./assets/images/upi.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>UPI Enable Secured Payment</h5>
                <p>Payment on Confirmtkt is highly secured. Easy UPI and other multiple payment modes available.</p>
              </div>

            </div>
          </div>

          <div class="box">
            <div class="content">
              <div class="image"><img src="./assets/images/earphones.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>
                  Train Booking & Enquiry Support</h5>
                <p>24X7 customer support, for any train enquiry & booking related queries call 08068243910.</p>
              </div>

            </div>
          </div>

          <div class="box">
            <div class="content">
              <div class="image"><img src="./assets/images/train.png" style="width: 70px;height: 70px;" alt=""></div>
              <div class="text">
                <h5>
                  Live Train Status Tracking</h5>
                <p>Train status & notification of your Train tickets.</p>
              </div>

            </div>
          </div>
        </div>

       
      </div>


    </div>
    <br>
    <div>
      <div style="margin-left: 50px;">
        <h4>Popular Destinations</h4>
      </div>
      <br>
      <div class="container">

        <div class="image-container">
          <img src="./assets/images/f1.png" alt="Destination 1">
          <div class="t3">Ocean</div>

        </div>
        <div class="image-container">
          <img src="./assets/images/f2.jpg" alt="Destination 2">
          <div class="t3">Mountain</div>

        </div>
        <div class="image-container">
          <img src="./assets/images/f3.jpg" alt="Destination 3">
          <div class="t3">Iceland</div>

        </div>
        <div class="image-container">
          <img src="./assets/images/grass.jpg" alt="Destination 3">
          <div class="t3">Grassland</div>

        </div>
      </div>
    </div>
    <div>

    </div>


    <br><br>
  </div>

  <div class="nav">
    <a href="https://contents.irctc.co.in/en/contact.html">Blog</a>
    <a href="https://contents.irctc.co.in/en/FAQs.html">FAQ</a>
    <a href="https://contents.irctc.co.in/en/contact.html">Contact</a>
    <a href="https://contents.irctc.co.in/en/contact.html">MediaKit</a>
    <a href="https://contents.irctc.co.in/en/contact.html">Terms & Conditions</a>
    <a href="https://contents.irctc.co.in/en/contact.html">Investor Relations</a>
    <a href="https://contents.irctc.co.in/en/contact.html">Terms & Cancellations</a>
    <a href=https://contents.irctc.co.in/en/contact.html">Privacy Policy</a>
    <a href="http://localhost/VASHU/about-us.php">VASHU</a>
  </div>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Scripts -->
  <script src="includes/js/jquery.min.js"></script>
  <script src="includes/js/jquery.scrollex.min.js"></script>
  <script src="includes/js/browser.min.js"></script>
  <script src="includes/js/breakpoints.min.js"></script>
  <script src="includes/js/util.js"></script>
  <script src="includes/js/main.js"></script>

</body>

</html>