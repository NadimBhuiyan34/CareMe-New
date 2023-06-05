<?php
include_once('includes/config.php');
// Perform the necessary database update or any other actions
// Here, we assume you have a function or query to update the notification table's status column

// Your database update code goes here

// Assuming the update is successful, you can send a response back to the AJAX request
$patient_id=$_SESSION['user']['id'];
  $notifiSql="UPDATE `notifications` SET `status`='seen' WHERE user_id = 4";
$result1 = $con->query($notifiSql);
$response = array(
  'success' => true,
  'message' => 'Data updated successfully sdhvd'
);

// Convert the response array to JSON format
echo json_encode($response);
?>
