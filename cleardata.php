<?php
include_once('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? '';

    if (!empty($user_id)) {
        // Prepare a secure DELETE query using prepared statements
        $stmt = $con->prepare("DELETE FROM sensordata WHERE user_id = ?");
        $stmt->bind_param("s", $user_id); // use "i" if user_id is an integer

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: view/patient/dashboard.php?message=Data+cleared+successfully");
            exit;
        } else {
            $stmt->close();
            echo "Error: Could not clear data.";
        }
    } else {
        echo "Invalid user ID.";
    }
} else {
    http_response_code(405); // Method not allowed
    echo "Method not allowed.";
}
?>
