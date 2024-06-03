<?php
include_once('includes/config.php');
 

 

if($_SERVER["REQUEST_METHOD"] === "POST")
{

  if($_POST['name'] === "nadim")
  {
    $sql = "SELECT * FROM sensordata";

     
    $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_assoc($result);

    while ($row = mysqli_fetch_assoc($result)) {
     
      $data[] = $row;
      
    }

    mysqli_free_result($result);
    // Set the response content type to JSON
    header('Content-Type: application/json');

    // Send the JSON object back to the client
    $jsonData = json_encode($data);
    echo $jsonData;
    mysqli_close($con);
  }
  else
  {
    http_response_code(404);
    echo json_encode(["error"=>"Unathorize"]);
  }
  // Fetch the latest sensor data from the sensordata table
 

}
else
{
  // http_response_code(405); // Method Not Allowed
  echo json_encode(["error" => "Unsupported request method"]);
  
}
