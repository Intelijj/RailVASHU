<?php
include('assets/inc/config.php');
include('assets/inc/checklogin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON data from the request body
    $requestData = json_decode(file_get_contents("php://input"), true);

    // Check the action type
    if ($requestData['action'] === 'deleteTrain') {
        // Assuming you have a database connection

        // Sanitize and get the PNR from the request
        $delete_pnr = $mysqli->real_escape_string($requestData['pnr']);

        $query0 = "select train_no from booked where pnr = $delete_pnr";
        $res0 = $mysqli->query($query0);
        if ($res0) {
            if ($res0->num_rows > 0) {
                $row = $res0->fetch_assoc();
                $train_no = $row['train_no'];
            }
        }

        $query1 = "select count(*) from passenger where pnr = $delete_pnr";
        $res1 = $mysqli->query($query1);
        if ($res1) {
            if ($res1->num_rows > 0) {
                $row = $res1->fetch_assoc();
                $count = $row['count(*)'];
            }
        }
        $query2 = "UPDATE train SET seats = seats + $count WHERE number = $train_no";
        $res2 = $mysqli->query($query2);

        // Perform the deletion in the database
        $query = "DELETE FROM booked WHERE pnr = '$delete_pnr'";
        $result = $mysqli->query($query);

        // Close the database connection
        $mysqli->close();

        // Send a response back to the client
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit;
    }
}

// If the request is not a POST request or the action is not recognized
header('HTTP/1.1 400 Bad Request');
echo 'Bad Request';
exit;
