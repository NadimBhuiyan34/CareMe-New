<?php
session_start();
require '../../vendor/autoload.php';

include_once('../../includes/config.php');

if(isset($_POST['submit']))
{


if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../assets/audio/';
    $audioFilename = $_FILES['audio']['name'];
    $targetPath = $uploadDir . $audioFilename;
   move_uploaded_file($_FILES['audio']['tmp_name'], $targetPath);

    
} 

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../assets/prescription_image/';
    $imageFilename = $_FILES['image']['name'];
    $targetPath = $uploadDir . $imageFilename;
   move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

    
} 
 
$problem=$_POST['problem'];
$doctor_id=$_POST['doctor_id'];
$patient_id=$_SESSION['user']['id'];
 $audioFilename = $_FILES['audio']['name']??'';
 $imageFilename = $_FILES['image']['name']??'';
$prescriptionSql="INSERT INTO `prescriptions`(`patient_id`,`doctor_id`, `image`, `audio`, `problem`) VALUES ('$patient_id','$doctor_id','$imageFilename','$audioFilename','$problem')";

if(mysqli_query($con, $prescriptionSql))
{
       session_start(); 
     $_SESSION['success'] = array('message' => "Submit Successfull!", 'type' => "success",'icon'=>"fa-square-check");

      // Redirect to some page where you want to show the success message
     header("Location: ../../view/patient/take-treatment.php");
       exit();
}
else
{
       session_start(); 
     $_SESSION['success'] = array('message' => "Submited Fail!",'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/patient/take-treatment.php");
           exit();
}

}


 if($_SESSION['user']['role'] !='patient')
{
         header('Location:../../pages-error.php');
         exit();
}

if (strlen($_SESSION['user']['id']==0)) {
  header('Location:../../logout.php');
  } else{

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Patient-Record-problem</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/title-logo.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/datatables.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

   <script src="../../vendor/pdf/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
<?php include_once('../../includes/header.php'); ?>

<?php include_once('../../includes/sidebar.php'); ?>

<!-- End Sidebar-->

  <main id="main" class="main">
   <div class="d-flex justify-content-between pt-3">
    <div class="pagetitle">
      <h1>Problem Share</h1>
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <!-- End Page Title -->

    <section class="section dashboard">
          <?php include_once('../../includes/alert-message.php'); ?>
  <audio id="audioPlayer" controls class=" bg-info mx-auto"></audio><br>
   <small class="mb-3">After recording please download the record and upload audio</small>
  <br>
  <br>
  <button id="recordButton" class="btn btn-sm btn-primary"><i class="fa-solid fa-microphone me-1"></i>Start Record</button>
  <button id="stopButton" disabled class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-stop me-1"></i>Stop Recording</button>
  <form id="uploadForm">
    <input type="hidden" id="audioFilename" name="audioFilename">
    <input type="file" id="audioFile" name="audioFile" style="display: none;">
    <button type="button" id="uploadButton" disabled class="btn btn-success btn-sm d-none"><i class="fa-solid fa-upload me-1"></i>Upload</button>

  </form>

 <form  method="POST" enctype="multipart/form-data">
  <?php $doctor_id= $_GET['id']?>
<div class="card mt-3 ">
    <div class="card-body">
      <input type="hidden" name="doctor_id" value="<?php echo $doctor_id ?>">
<div class="mb-3 pt-2">
  <label for="exampleFormControlInput1" class="form-label">Audio Record</label>
  <input type="file" class="form-control" id="exampleFormControlInput1" name="audio">
  
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea2" class="form-label">Share Problem</label>
  <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="problem"></textarea>
</div>
    
<div class="mb-3">
  <label for="exampleFormControlInput3" class="form-label">Image</label>
  <input type="file" class="form-control" id="exampleFormControlInput3" name="image">
</div>
   
   <div class="text-center">
    <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
   </div>
    </div>
</div>


 
</form>


 

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 

 
<script>
      const audioPlayer = document.getElementById("audioPlayer");
    const recordButton = document.getElementById("recordButton");
    const stopButton = document.getElementById("stopButton");
    const uploadForm = document.getElementById("uploadForm");
    const audioFilenameInput = document.getElementById("audioFilename");
    const audioFileInput = document.getElementById("audioFile");
    const uploadButton = document.getElementById("uploadButton");

    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    uploadButton.addEventListener("click", uploadAudio);

    let stream;
    let mediaRecorder;
    let chunks = [];

    function startRecording() {
      // Clear previous recording
      audioPlayer.src = "";
      chunks = [];

      navigator.mediaDevices
        .getUserMedia({ audio: true })
        .then((userMediaStream) => {
          stream = userMediaStream;
          mediaRecorder = new MediaRecorder(stream);

          mediaRecorder.addEventListener("dataavailable", (e) => {
            chunks.push(e.data);
          });

          mediaRecorder.addEventListener("stop", () => {
            const audioBlob = new Blob(chunks, { type: "audio/webm" });
            chunks = [];

            const audioUrl = URL.createObjectURL(audioBlob);
            audioPlayer.src = audioUrl;

            const timestamp = new Date().getTime();
            const filename = `recording_${timestamp}.webm`;
            audioFilenameInput.value = filename;

            uploadButton.disabled = false;
          });

          mediaRecorder.start();

          recordButton.disabled = true;
          stopButton.disabled = false;
        })
        .catch((error) => {
          console.error("Error accessing microphone:", error);
        });
    }

    function stopRecording() {
      if (mediaRecorder && mediaRecorder.state === "recording") {
        mediaRecorder.stop();
        stream.getTracks().forEach((track) => {
          track.stop();
        });

        recordButton.disabled = false;
        stopButton.disabled = true;
      }
    }

    function uploadAudio() {
      const formData = new FormData();
      formData.append("audioFilename", audioFilenameInput.value);
      formData.append("audioFile", audioFileInput.files[0]);

      fetch("upload.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((result) => {
          console.log(result); // Handle the server response here
        })
        .catch((error) => {
          console.error("Error uploading audio:", error);
        });
    }
</script>


  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <!-- <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
   
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
 

 
  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
<script src="https://kit.fontawesome.com/496c26838e.js" crossorigin="anonymous"></script>
 
 
</body>

</html>
<?php } ?>