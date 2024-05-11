<!DOCTYPE html>
<html>

<head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
    }

    .navbar.navbar-dark.bg-dark {
      background-color: black;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      margin-right: 10px;
      /* Adjust the margin to move the image to the left */
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

    /* About Section */
    .about {
      background: rgb(224, 251, 222);
      background: linear-gradient(to bottom, #cc33ff 0%, #ffccff 100%);
      padding: 100px 0 20px 0;
      text-align: center;
    }

    .about h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .about p {
      font-size: 1rem;
      color: #323030;
      max-width: 800px;
      margin: 0 auto;
    }

    .about-info {
      margin: 2rem 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: left;
    }

    .about-img {
      width: 500px;
      height: 400px;
  

    }

    .about-img img {
      width: 450px;
      height: 300px;
    border-radius:50%;
      padding-left:20px;
    }

    .about-info p {
      font-size: 1.3rem;
      margin: 0 5rem;
      text-align: justify;
    }

    button {
      border: none;
      outline: 0;
      padding: 10px;
      margin: 5rem;
      font-size: 1rem;
      color: white;
      background-color: #40b736;
      text-align: center;
      cursor: pointer;
      width: 10rem;
      border-radius: 4px;
    }

    button:hover {
      background-color: #1f9405;
    }

    /* Team Section */
    .team {
      padding: 30px 0;
      text-align: center;
    }

    .team h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .team-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .card {
      background-color: white;
      border-radius: 6px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
      width: 18rem;
      height: 28rem;
      margin-top: 10px;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5);
    }

    .card-img {
      width: 18rem;
      height: 12rem;
    }

    .card-img img {
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    .card-info button {
      margin: 2rem 1rem;
    }

    .card-name {
      font-size: 2rem;
      margin: 10px 0;
    }

    .card-role {
      font-size: 1rem;
      color: #888;
      margin: 5px 0;
    }

    .card-email {
      font-size: 1rem;
      color: #555;
    }

    /* Footer */
    footer {
      background-color: #222;
      color: white;
      text-align: center;
      padding: 20px 0;
    }

    @media (max-width: 768px) {
      nav {
        display: block;
      }

      .logo {
        text-align: center;
      }

      .nav-links {
        margin-top: 1rem;
        justify-content: space-between;
      }

      .nav-links li {
        margin-right: 0;
      }

      .about h1 {
        font-size: 2rem;
      }

      .about p {
        font-size: 0.9rem;
      }

      .about-info {
        flex-direction: column;
        text-align: center;
      }

      .about-img {
        width: 30px;
        height: 30px;
      
      }

      .about-info p {
        margin: 1rem 2rem;
      }

      .about-info button {
        margin: 1rem 2rem;
        width: 10rem;
      }

      .team {
        margin: 0 1rem;
      }
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>About Us</title>
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
            <a class="nav-link" href="index.php">Home</a>
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

  <section class="about">
    <h1>About Us</h1>
    <p style="font-weight: bold">VASHU - The trust of people</p>
    <div class="about-info">
      <div class="about-img">
        <img src="./assets/images/brandname.png" alt="Geeksforgeeks" >
      </div>
      <div>
        <p>Vashu, an online ticket booking website for trains, is a company founded by a group of individuals whose names are represented by the acronym "VASHU."<span id="dots"></span><span id="more">Vashu provides a user-friendly platform that allows customers to conveniently book train tickets, check train schedules, and access essential travel information. The company's founders are likely passionate about providing a seamless and efficient way for travelers to plan and book their train journeys. With a team made up of individuals whose names are the foundation of the company, Vashu may prioritize personalized and reliable service to enhance the train travel experience for its users.





</span></p>
        <button onclick="myFunction()" id="myBtn" style="margin-left:80px;">Read more</button>
      </div>
    </div>
  </section>

  <section class="team" style="background-color: #f8ebfc;">
    <h1>Meet Our Founders</h1>
    <div class="team-cards">
      <!-- Cards here -->
      <!-- Card 1 -->
      <div class="card">
        <div class="card-img">
          <img src="" alt="User 1">
        </div>
        <div class="card-info">
          <h2 class="card-name">Saras Nagaria</h2>
          <p class="card-role">Software Engineer</p>
          <p class="card-email">bt21cse113iiitn@ac.in</p>
          <p><button class="button">Contact</button></p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <div class="card-img">
          <img src="" alt="User 2">
        </div>
        <div class="card-info">
          <h2 class="card-name">Uday Bhati</h2>
          <p class="card-role">Software Engineer</p>
          <p class="card-email">bt21cse141iiitn@ac.in</p>
          <p><button class="button">Contact</button></p>
        </div>
      </div>
      <div class="card">
        <div class="card-img">
          <img src="IMAGE_URL_HERE" alt="User 4">
        </div>
        <div class="card-info">
          <h2 class="card-name">Ansh Bansal</h2>
          <p class="card-role">Software Engineer</p>
          <p class="card-email">bt21cse143iiitn@ac.in</p>
          <p><button class="button">Contact</button></p>
        </div>
      </div>


      <!-- Existing code -->
      <div class="team-cards">
        <!-- Cards here -->
        <!-- Card 1 -->
        <div class="card">
          <div class="card-img">
            <img src="" alt="User 1">
          </div>
          <div class="card-info">
            <h2 class="card-name">Harsh Lohiya</h2>
            <p class="card-role">Software Engineer</p>
            <p class="card-email">bt21cse123iiitn@ac.in</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>


        <div class="card">
          <div class="card-img">
            <img src="IMAGE_URL_HERE" alt="User 4">
          </div>
          <div class="card-info">
            <h2 class="card-name">Vineet Kushwaha</h2>
            <p class="card-role">Software Engineer</p>
            <p class="card-email">bt21cse144iiitn@ac.in</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>



  </section>

  <footer>
    <p>© 2023 GeeksforGeeks. All Rights Reserved.</p>
  </footer>
  <script>
    function myFunction() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");

      if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</body>


</html>