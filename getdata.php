<?php
include_once('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['device_id']) && $_GET['device_id'] === "nadim") {
        $sql = "SELECT * FROM sensordata ORDER BY created_at DESC LIMIT 1";
        $result = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "No data found"]);
        }

        mysqli_free_result($result);
        mysqli_close($con);
    } else {
        http_response_code(403);
        echo json_encode(["error" => "Unauthorized device_id"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Unsupported request method"]);
}
