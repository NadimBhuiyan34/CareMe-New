 <?php 
session_start();
require '../../vendor/autoload.php';

include_once('../../includes/config.php');
 
// Check if the request contains an audio file
if (isset($_FILES['audioFile'])) {
    $targetDirectory = '../../assets/audio/';  // Specify the directory where you want to save the audio file
    $audioFile = $_FILES['audioFile']['tmp_name'];
    $audioFilename = $_POST['audioFilename'];

    // Move the uploaded audio file to the target directory
    if (move_uploaded_file($audioFile, $targetDirectory . $audioFilename)) {
        echo "Audio saved successfully";
    } else {
        echo "Error saving audio";
    }
} else {
    echo "No audio file found";
}
 

?>
