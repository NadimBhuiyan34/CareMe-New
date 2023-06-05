 <?php
session_start();
require '../../vendor/autoload.php';
include_once('../../includes/config.php');
$adid=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];
 if($role !='doctor')
{
         header('Location:../../pages-error.php');
         exit();
}
 

 

if ($adid == 0) {
       header('Location:../../logout.php');
  exit();
}
if(isset($_POST['submit']))
{
        function sendMail($email,$v_code,$password,$name)
{
 require '../../vendor/autoload.php';
    $mail=new PHPMailer(true);  
try{
    $mail=new PHPMailer(true);                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'caremeprojectiot@gmail.com';                     //SMTP username
    $mail->Password   = 'szcjrmgixdxbxjul';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            
    $mail->Port       = 465;  
    $mail->setFrom('caremeprojectiot@gmail.com');
    $mail->addAddress($email);     //Add a recipient
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from CareMe';
    
    $mail->Body = "Dear $name, <br><br>
    Your Email is: $email <br>
    Your password is: $password<br><br>
    please login use this email and password <br><br>
    Click the link to verify your email: <a href='http://localhost/NiceAdmin/verify.php?v_code=$v_code & email=$email'><button>Verify</button></a> ";

     $mail->send();
     return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}                   //Enable verbose debug output
    
}
 $doctor_id=$adid;
  $rx=$_POST['rx'];
  $test=$_POST['test'];
  $advice=$_POST['advice'];
  $pres_id=$_POST['pres_id'];
  $patient_id=$_POST['patient_id'];
  $description="Your treatment request have prescribe";

  $prsSql="INSERT INTO `prescriptions`(`pres_id`, `user_id`, `doctor_id`, `rx`, `test`, `advice`) VALUES ('$pres_id','$patient_id','$doctor_id','$rx','$test','$advice')";
  $notifSql="INSERT INTO `notifications`(`user_id`, `description`, `status`) VALUES ('$patient_id','$description','')";
  
   $problemSql="UPDATE `problems` SET `status`='1' WHERE id = $pres_id";

  if(mysqli_query($con, $prsSql) && mysqli_query($con, $notifSql) && mysqli_query($con, $problemSql))
  {
     session_start(); 
     $_SESSION['success'] = array('message' => "Prescription submit Successfull!", 'type' => "success",'icon'=>"fa-square-check");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/doctor/requested-treatment.php");
           exit();
  }
  else
  {
     
     session_start(); 
     $_SESSION['success'] = array('message' => "Prescription not inserted!", 'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/doctor/requested-treatment.php");
           exit(); 
  }
  


  
      

}


 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Patient-Prescription-PDF</title>
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
      <h1>Dashboard</h1>
   
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

    <section class="">
         <div class=" d-flex justify-content-center  mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3 col-12 col-xl-12">
                  <button class="btn btn-primary" id="download"><i class="fa-solid fa-download fa-shake"></i></button>
            </div>
             <?php 
       $id=$_GET['id'];
        $presSql="SELECT * FROM problems
                     WHERE id=$id";
    $pres= mysqli_query($con, $presSql);

  while ($row = $pres->fetch_assoc()) : 
      $doctor_id=$row['doctor_id'];
   $doctorSql = "SELECT *
              FROM tbluserregistration
              JOIN doctor_profiles ON tbluserregistration.id = doctor_profiles.user_id
              WHERE tbluserregistration.id  =$doctor_id";
      $users= mysqli_query($con, $doctorSql); 
       
        while ($doctor = $users->fetch_assoc()) :
      
      ?>
            <div class="col-md-12 col-xl-12  col-12">
                <div class="card" id="invoice"> 
                    <div class="card-header d-flex flex-column" style="background-color:#f7e3cd">
                       <div class="mx-auto">
                        <img src="../../assets/img/logo4.png" alt=""  style="width:150px; height:50px" alt="logo">
                       </div>
                       
                       <div class="mx-auto d-flex flex-column text-dark">
                          <h5 class="mx-auto fw-bold"><?php echo $doctor['fullName'] ?></h5>
                          <small class="text-center mx-auto"><?php echo $doctor['specialties'] ?></small>
                          <small class="mx-auto"><?php echo $doctor['academic_title'] ?>,<?php echo $doctor['collage'] ?></small>

                       </div>
                    </div>
                    <?php
                        $patient_id=$row['patient_id'];
              $patientSql = "SELECT *
              FROM tbluserregistration
              JOIN profiles ON tbluserregistration.id = profiles.user_id
              WHERE tbluserregistration.id  =$patient_id";
          $patient= mysqli_query($con, $patientSql); 
       
        while ($patient_data = $patient->fetch_assoc()) :
                    ?>
                    <div class="card-body">
                        <div class="row text-black">
                            <div class="col-sm-6 col-12 col-md-6 col-xl-3">
                                 <small>Name: <?php echo $patient_data['fullName'] ?></small>
                            </div>
                               <?php
                        $dateOfBirth = $patient_data['date_of_birth'];


                        $birthDate = new DateTime($dateOfBirth);
                        $currentDate = new DateTime();
                        $ageInterval = $currentDate->diff($birthDate);
                        $years = $ageInterval->y;
                        ?>
                            <div class="col-sm-6 col-12 col-md-6 col-xl-3">
                                 <small>Age: <?php echo $years ?></small>
                            </div>
                            <!-- <div class="col-sm-6 col-12 col-md-6 col-xl-3">
                                 <small >Address: Narayanganj</small>
                            </div> -->
                            <div class="col-sm-6 col-12 col-md-6 col-xl-3">
                                 <small>Date: <?php echo date("d F Y"); ?></small>
                            </div> 

                        
                        </div>
                        <!-- name part end -->
                          <form action="" method="POST">
                       <div class="row">
              
                        <!-- Symptoms -->
                              <div class="mt-3 text-xl-left text-sm-left text-md-left text-black">
                                   <h5 class="fw-bold">Symptoms</h5>
                                   <hr>
                              </div> 
                             
                             <div class="col-12 col-xl-12">
                                <p class="text-justify"><?php echo $row['problem'] ?></p>
                             </div>
                             <!-- Rx table -->
                              <div class="text-xl-left text-sm-left text-md-left text-black">
                                   <h5 class="fw-bold">Rx</h5>
                                   <hr>
                             </div> 
                              <!-- hidden file -->
                              <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>">
                              <input type="hidden" name="pres_id" value="<?php echo $id ?>">
  
            <div class="mb-3">
           <label for="exampleFormControlTextarea2" class="form-label"></label>
         <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="rx">
    
          </textarea>
 
   
             </div>

                    
                       
                        <div class="mt-3 text-xl-left text-sm-left text-md-left text-black">
                                   <h5 class="fw-bold">Test</h5>
                                   <hr>
                       </div> 

                      <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="test">
                    
                    </textarea>
 
   
                      </div>

                        <div class="mt-3 text-xl-left text-sm-left text-md-left text-black">
                                   <h5 class="fw-bold">Advice</h5>
                                   <hr>
                       </div> 

                     
                                      <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="advice">
                      
                    </textarea>
              
                  
                </div>
             
        
                       </div>
                        <button class="btn btn-primary btn-sm" name="submit">Submit</button>
                       </form>
                       </div>
                      
                    </div>
                   
                  
                </div>
            </div>
        </div>
    </div>


    </section>
  <?php endwhile; ?>
  <?php endwhile; ?>
  <?php endwhile; ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


 



<!-- pdf generate -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get the button element
  var downloadBtn = document.getElementById("download-pdf");

  // Add a click event listener to the button
  downloadBtn.addEventListener("click", function() {
    // Create a new jsPDF instance
    var doc = new jsPDF();

    // Generate the PDF from the HTML content
    doc.html(document.body, {
      callback: function(pdf) {
        // Save the PDF file
        pdf.save("file.pdf");
      }
    });
  });
});
</script>



  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <!-- <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
<script src="https://kit.fontawesome.com/496c26838e.js" crossorigin="anonymous"></script>
 
 
</body>

</html>
 