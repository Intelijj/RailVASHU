<!--Start Server side code to give us and hold session-->
<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];
?>
<!--End Server side scriptiing-->
<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
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
    padding:0;
margin:0;
    background-color: #f8ebfc;
  }

  .first {
    border-radius: 10px;
 

    border-radius: 7px;
    width: 1400px;
  
  }
</style>
<!--HeAD-->
<!-- end HEAD-->
<script type="text/javascript">
    {
        function ShowHide(HiddenDiv2)
        {
            if(document.getElementById(HiddenDiv2).style.display == 'none')
            {
                document.getElementById(HiddenDiv2).style.display='block';
                
            }
            else{
                document.getElementById(HiddenDiv2).style.display = 'none';
            }
        }
    }</script>
<script type="text/javascript">
  {
    function confirmAction(delete_pnr) {
      Swal.fire({
        title: 'Do you want to cancel this train?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed',
        cancelButtonText: 'No, abort',
      }).then((result) => {
        if (result.isConfirmed) {
          // User clicked Yes, perform the action
          Swal.fire('Train canceled!', '', 'success');
          fetch('delete-train.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({
                action: 'deleteTrain',
                pnr: delete_pnr,
              }),
            })
            .then(response => response.json())
            .then(data => {
              // Handle the response from the server if needed
              setTimeout(() => {
                location.reload();
              }, 2000);
            })
            .catch(error => {
              console.error('Error:', error);
            });
          // Add your action here
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // User clicked No or closed the modal, do nothing or handle accordingly
          Swal.fire('Retry', '', 'error');
        }
      });
    }
  }
</script>

<body>
  <div>
    <!--navbar-->
    <?php include('assets/inc/navbar.php'); ?>
    <!--End navbar-->
    <!--Sidebar-->
    <!--End Sidebar-->

    <div>
      <div>
        <div>
          <div>
            <div class="first">
              <div>
              <h2 style="padding-left: 55px; padding-top: 7px;font-weight: 900;">
                <b> Cancel Tickets <i style="font-size:24px;color: red; rotate: skewY(90deg);" class="fa fa-train" color:red></i> </b>
              </h2>
              </div>
       
              <div class="booked1" style="background-color: white;">
                <table style="width: 1250px; border-collapse: separate;
        border-spacing: 15px;">
                  <tbody>
                    <?php
                    /**
                     *Lets select train booking details of logged in user using PASSENGER ID as the session
                     */
                    $aid = $_SESSION['pass_id'];
                    $ret = "select DISTINCT(pnr), train_no, train_name, date, train_dep_stat, dep_time, train_arr_stat, arr_time, train_fare from passenger where user_id=?"; //sql to get details of our user
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                      $time1 = DateTime::createFromFormat('H:i', $row->dep_time);
                      $time2 = DateTime::createFromFormat('H:i', $row->arr_time);

                      // If $time2 is before $time1, add a day to $time2
                      if ($time2 < $time1) {
                        $time2->modify('+1 day');
                      }

                      // Calculate the time difference
                      $timeDif = $time1->diff($time2);
                      $duration = $timeDif->format('%H:%I');
                    ?>
                      <tr>
                        <td>
                          <div style="width: 70px; height: 30px; background-image: url('g3.png'); background-size: cover;">
                          </div>
                        </td>
                        <td>
                          <b><?php echo "PNR: " . $row->pnr; ?></b>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                          <b> <?php echo $row->date ?> </b>
                        </td>
                      </tr>
                      <tr>
                        <td style="font-size:14px;">
                          <?php echo $row->train_no; ?>
                        </td>
                        <td style="font-size:14px;">
                          <div style="background-color: #aa39fa;  display: inline-block; padding: 5px 10px; border-radius: 25px; color: black;">
                            <b>
                              <?php echo $row->train_name; ?>
                            </b>
                          </div>
                        </td>
                        <td style="width: 280px;" style="font-size:14px;">
                          <b style="font-size:14px"> <?php echo $row->dep_time ?></b> <br>
                          <?php echo $row->train_dep_stat;; ?>
                        </td>
                        <td style="width: 400px;font-size:14px;">
                          -------------------------- <?php echo $duration ?> --------------------------<i style="font-size:24px;color: black; rotate: skewY(90deg);" class="fa fa-train"></i><br>
                        </td>
                        <td style="font-size:14px;"> <b>
                            <?php echo $row->arr_time ?>
                          </b><br>
                          <?php echo $row->train_arr_stat; ?>
                        </td>
                        <td style="font-size:14px;"><span class="badge badge-pill badge-primary">$
                            <?php echo $row->train_fare; ?>
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
                            <?php echo $row->train_fare; ?>
                          </b>
                        </td>
                        <td style="font-size:14px;"><b>
                            <a   style="color:#f075bf;" onclick="confirmAction('<?php echo $row->pnr; ?>')">Cancel</a>
                          </b>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Passengers:</b></td>
                      </tr>
                      <?php
                      $count = 0;
                      $ret1 = "select * from passenger where pnr=?";
                      $stmt1 = $mysqli->prepare($ret1);
                      $stmt1->bind_param('i', $row->pnr);
                      $stmt1->execute(); //ok
                      $res1 = $stmt1->get_result();
                      //$cnt=1;
                      while ($row1 = $res1->fetch_object()) {
                        $count++;
                      ?>
                        <tr>
                          <td>
                            <?php echo $count . ") " . $row1->pass_name ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <tr>
                        <td colspan=" 6">
                          <hr style="height:2px; border: none; border-top: 3.5px dotted #0c3c53;">

                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><br><br>
            </div>
            <br>
         
            <div >
              <div class="covid" style="margin-left: 3.5%; margin-top: 10px; border-radius: 15px;width: 1300px; padding-left: 10px; background-color: #f7a1b9;">

                <h3>
                  
                  <div style="background-color: #eb3165; width: 220px;padding-top: 5px; border-radius: 25px; color: white;">
                    <b> &nbsp
                      Important Information </b>
                  </div>
                </h3>
                <p align="justify-content">&#8226 In case of cancellation of train, full refund of fare shall be directly credited to customer’s
                  card/bank account used at the time of booking on Indian Railways.

                  <br><br>
                  &#8226 If the ticket holder of higher class is made to travel in lower class, refund of fare difference between booked class
                  and travelled class will be provided.<br><br>
                  &#8226 Send Original Certificate though post to Group General Manager/IT, Indian Railway Catering and Tourism Corporation Ltd.,
                  Internet Ticketing Centre, IRCA Building, State Entry Road, New Delhi - 110055.
                </p>
                <a href="javascript:ShowHide('HiddenDiv2')" style="margin-left: 90%;color:red;">Show More</a>
                <br>
                <div id="HiddenDiv2" style="display:none" ;>
                  <hr>
                  <p align="justify-content"> &#8226 <b>No refund of fare shall be admissible on the e-tickets having confirmed reservation </b>
                    in case the ticket is not cancelled or TDR not filed online upto 4
                    hours before the scheduled departure of the train.<br><br>
                    &#8226 Train Chart is usually prepared 4 hours before departure of train.
                    For train starting morning (up to 12 noon), the chart preparation is usually done on the previous night.
                    <br><br>
                    &#8226 Agent Service Fee and Payment Gateway Charges charged by Railways are non-refundable.
                    <br><br>
                    &#8226 Cancellations and Refund will be based on Indian Rail Refund and TDR filing rules. These rules are subjected to change
                    by Indian Railways. Indian Railways, though makes an effort to keep latest
                    railways terms and conditions and Refund Rules visible on our platform but cannot be held accountable in case of any changes.
                  </p>
                </div>
             
                <br>
              </div>

            <!--footer-->
            <!--End Footer-->
          </div>
        </div>
      </div>
    </div><br><br>
    


  </div>

  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
      App.dataTables();
    });
  </script>
</body>

</html>