<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];
?>
<!DOCTYPE html>
<html lang="en">
<style>
  .container1 {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 800px;
    height: 230px;
    background-color: rgb(226, 240, 252);
    border-radius: 20px;
  }
  li{
    text-decoration: none;
  }

  .column1 {
    width: 200px;

  }

  .column3 {
    width: 150px;

  }

  body {
    background-color: #f8ebfc;
    padding: 0;
    margin: 0;
    background-color: #f8ebfc;

  }

  .column2 {
    align-items: center;
    justify-content: center;
    display: flex;
    width: 450px;
    height: 230px;



  }

  .image-container {
    width: 100%;
    height: 100%;
  }

  .tu1 {
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
  }

  .n1 {
    display: flex;
    flex-direction: row;
    gap: 15px;

  }


  .tu2 {
    display: flex;
    flex-direction: column;
  }

  .headings1 {
    display: flex;
    flex-direction: row;
    gap: 30px;
  }



  .texts {
    display: flex;
    flex-direction: row;

    gap: 40px;

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
</style>
<!--Head-->
<!--End Head-->

<body style="  background-color: #f8ebfc;">

  <!-- <?php include('assets/inc/head.php'); ?> -->
  <div>
    <!--Nav Bar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End Navbar-->
    <div>

      <?php
      /**
       *Server side code to get details of single passenger using id 
       */
      $aid = $_SESSION['pass_id'];
      $ret = "select * from passenger where user_id=?"; //fetch details of pasenger
      $stmt = $mysqli->prepare($ret);
      $stmt->bind_param('i', $aid);
      $stmt->execute(); //ok
      $res = $stmt->get_result();
      //$cnt=1;
      while ($row = $res->fetch_object()) {
        ?>
        <!--get details of logged in user-->
        <div>
          <div>
            <div style="margin-top:80px;">

              <!--Train Details-->
              <!-- <div id='printReceipt' class="invoice">
                <div class="row invoice-header">
                  <div class="col-sm-7">
                    <div class="invoice-logo"></div>
                  </div>
                  <div class="col-sm-5 invoice-order"><span class="invoice-id">Train Ticket For</span><span
                      class="incoice-date">
                      <?php echo $row->pass_name; ?>
                    </span></div>
                </div> -->
              <!-- <div class="row invoice-data">
                  <div class="col-sm-5 invoice-person"><span class="name">
                      <?php echo $row->pass_name; ?>
                    </span><span>
                      <?php echo $row->pass_email; ?>
                    </span><span>
                      <?php echo $row->pnr; ?>
                    </span></div>
                  <div class="col-sm-2 invoice-payment-direction"></div>
                </div> -->
              <div class="row">
                <div class="col-lg-12" style="margin-left:23%;">
                  <table class="invoice-details">
                    <tbody>
                      <?php
                      /**
                       *Lets select train booking details of logged in user using PASSENGER ID as the session
                       */
                      //$aid=$_SESSION['pass_id'];
                      $ret = "select * from passenger where user_id=?"; //sql to get details of our user
                      $stmt = $mysqli->prepare($ret);
                      $stmt->bind_param('i', $aid);
                      $stmt->execute(); //ok
                      $res = $stmt->get_result();
                      //$cnt=1;
                      while ($row = $res->fetch_object()) {
                        ?>
                        <!-- <tr>
                            <td>
                              <?php echo $row->train_no; ?>
                            </td>
                            <td>
                              <?php echo $row->train_name; ?>
                            </td>
                            <td>
                              <?php echo $row->train_dep_stat; ?>
                            </td>
                            <td>
                              <?php echo $row->train_arr_stat; ?>
                            </td>
                            <td>
                              <?php echo "N.A." ?>
                            </td>
                            <td><span class="badge badge-pill badge-success">Ksh
                                <?php echo $row->train_fare; ?>
                              </span></td>
                          </tr> -->
                        <tr>
                          <div id='printReceipt' class="invoice">
                            <div class="container1">
                              <div class="column1">
                                <img src="./assets/images/t3.png" alt="Image 1" style="width: 150px;height: 150px;">
                              </div>
                              <div class="column2">

                                <div class="tu1">
                                  <div>
                                    <h1><b>Train Ticket</b></h1>
                                  </div>
                                  <div class="n1">
                                    <div>
                                    <?php
$tno =  $row->train_no;
?>
                                      <p>No:
                                        <?php echo '<span id="sub4">' . $tno . '</span>'; ?>
                                      </p>
                                    </div>
                                    <div>
                                      <p>Date:
                                        <?php echo "N.A." ?>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="n2">
                                    <h4><b> Train:</b>
                                    <?php
$tname = $row->train_name ;
?>
                                      <?php echo '<span id="sub5">' .$tname . '</span>'; ?>
                                    </h4>
                                  </div>
                                </div>
                                <hr>
                                <div class="tu2">
                                  <div class="headings1">

                                    <h4><b>From</b></h4>
                                    <p style="font-size: 20px; color:rgb(23, 105, 105);margin-top:10px;">&#8594;</p>
                                    <h4><b>To</b></h4>
                                  </div>
                                  <div class="texts">
                                  <?php
$dep = $row->train_dep_stat;
?>
                                    <p>
                                      <?php echo '<span id="sub1">' . $dep . '</span>'; ?>
                                    </p>
                                    <?php
$arr = $row->train_arr_stat;
?>

                                    <p>
                                      <?php echo '<span id="sub2">' . $arr. '</span>'; ?>
                                    </p>
                                  </div>
                                  <br>
                                  <div>
                                    <h4>
                                      <b> Passenger name:</b>
                                      <br>
                                      <?php
$nameVariable = $row->pass_name;
?>

<b>
    <?php echo '<span id="name1">' . $nameVariable . '</span>'; ?>
</b>
                                     
                                    </h4>
                                  </div>
                                  <div>
                                  <?php
$fare = $row->train_fare;
?>
                                    <p><?php echo  '<span id="sub3">' .$fare . '</span>'; ?></p>
                                  </div>
                                </div>
                                <hr>
                              </div>
                              <div class="column3">
                                <img src="qrte.png" alt="Image 2"
                                  style="width: 150px;height: 220px;  border-radius: 20px;border-left:2px dashed navy">
                              </div>
                            </div>
                          </div>
                        </tr>

                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <br><br><br>
            <hr style="border:1.5px dashed #ff002f; margin-top:100px;">
            <div class="row invoice-footer">
              <div class="col-lg-12">
                <center>
                  <button id="print" onclick="printContent('printReceipt');"
                    class="btn btn-lg btn-space btn-secondary">Print</button>
                </center>
                <center>
                  <input type="email" id="email" placeholder="email" autocomplete="off">
                  <button id="email1"
                    class="btn btn-lg btn-space btn-secondary">Send Email</button>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Close logged in user instance-->
    <?php } ?>
    <!--footer-->
    <br><br>
    <div>
      <center>
        <?php include('assets/inc/footer.php'); ?>
      </center>
    </div>

    <!--end footer-->
  </div>

  </div>


  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      //-initialize the javascript
      App.init();
    });
  </script>
  <!--print train ticket js-->
  <script>
    function printContent(el) {
      var restorepage = $('body').html();
      var printcontent = $('#' + el).clone();
      $('body').empty().html(printcontent);
      window.print();
      $('body').html(restorepage);
    }
  </script>
  <script src="https://smtpjs.com/v3/smtp.js">
</script>
<script>
    var btn=document.getElementById('email1');
    btn.addEventListener('click',function(e){
        e.preventDefault();
        var name = "<?php echo $nameVariable; ?>";
        // var name=document.getElementById('name1').value;
        var email=document.getElementById('email').value;
        var sub1= "<?php echo $dep; ?>";
        var sub2="<?php echo $arr; ?>";
        var sub3="<?php echo $fare; ?>";
        var sub4="<?php echo $tno; ?>";
        var sub5="<?php echo $tname; ?>";
        // var message=document.getElementById('message').value;
        var body='Name-'+name+ '<br/> Depart-'+sub1+ '<br/> Arrive-'+sub2+ '<br/> Fare-'+sub3+ '<br/> Train no-'+sub4+ '<br/> Train name-'+sub5;
        Email.send({
    SecureToken : "865b9dd7-d033-42e7-82fa-fb2505230b1b",
    To : email,
    From : 'alphahike134@gmail.com',
    Subject : 'give information about the ticket',
    Body : body
}).then(
  message => alert(message)
);

    })


  
 
</script>


</body>

</html>