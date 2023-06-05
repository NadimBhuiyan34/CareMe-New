<?php
session_start();

include_once('../../includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$adid=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];
 if($role !='admin')
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

   
  // mail send
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
  // end of mail send



   if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $_FILES['image']['tmp_name'];
    $originalFileName = $_FILES['image']['name'];
    
    // Generate a unique identifier
    $uniqueId = uniqid();
    
    // Extract the file extension from the original file name
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
    // Create the new file name by combining the unique identifier and the file extension
    $newFileName = $uniqueId . '.' . $fileExtension;
    
    $newFilePath = '../../assets/profile/' . $newFileName;
    
    move_uploaded_file($tempFilePath, $newFilePath) ;
      // Image upload successful
   }
   
  //  random passowrd
    $password_length = 8;
        $random_password = '';
        $char_range = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        for ($i = 0; $i < $password_length; $i++) {
            $random_password .= $char_range[rand(0, count($char_range) - 1)];
        }

   $email = $_POST['email'];
   $fname=$_POST['name'];
   $collage=$_POST['collage'];
   $academic_title=$_POST['academic_title'];
   $specialist=$_POST['specialist'];
   $mobile=$_POST['mobile'];
   $degree=$_POST['degree'];
   $image=$newFileName??'profile.png';
   $userpassword=md5($random_password);
   $role= 'doctor';
   $v_code=bin2hex(random_bytes(16));
   $ret=mysqli_query($con,"select id from tbluserregistration where emailid='$email'");
    $result=mysqli_num_rows($ret);
    
   if($result==0){
     $query="INSERT INTO `tbluserregistration`( `fullName`, `emailid`, `loginPassword`, `role`, `varification_code`, `is_varify`) VALUES ('$fname','$email','$userpassword','$role','$v_code','0')";
     $user_registration= mysqli_query($con, $query);
     $mail=sendMail($email,$v_code,$random_password,$fname);
    
       
     $ret=mysqli_query($con,"select id from tbluserregistration where emailid='$email'");
        // $user = mysqli_query($con, $ret);
       
    $row = mysqli_fetch_assoc( $ret);
    $user_id = $row['id'];
    // $user_id = 1;
  
    $sql = "INSERT INTO `doctor_profiles`(`user_id`,`mobile`, `academic_title`, `specialties`, `degree`, `collage`, `image`) VALUES ('$user_id','$mobile','$academic_title','$specialist','$degree','$collage','$image')";
    $profile = mysqli_query($con,$sql);
      
    if($user_registration && $mail &&  $profile)
    {
          session_start(); 
     $_SESSION['success'] = array('message' => "Registration Successfull!", 'type' => "success",'icon'=>"fa-square-check");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/admin/doctor-registration.php");
           exit();
    }
    else
    {
         
          session_start(); 
        $_SESSION['success'] = array('message' => "Registration Fail!", 'type' => "danger",'icon'=>"fa-triangle-exclamation");
      // Redirect to some page where you want to show the success message
      header("Location: ../../view/admin/doctor-registration.php");
           exit();  
    }
      
         

}
else 
{
     session_start(); 
     
     $_SESSION['success'] = array('message' => "This email is already taken", 'type' => "danger",'icon'=>"fa-triangle-exclamation");
      // Redirect to some page where you want to show the success message
      header("Location: ../../view/admin/doctor-registration.php");
          exit();
}
 
 


 }

 
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin-Doctor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/title-logo.png" rel="icon">
  <!-- <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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
  <!-- <link href="../../assets/vendor/simple-datatables/datatables.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../../assets/vendor/simple-datatables/style.css">
 
    

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

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
      <h1>Doctor</h1>
   
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
  <?php include_once('../../includes/alert-message.php'); ?>
    <!-- End Page Title -->
     <div class="card">
        <div class="card-header bg-primary text-white text-center mb-2">
            <h6>Doctor Registration</h6>
        </div>
        <div class="card-body ">
           <form class="row g-3" method="POST"  enctype="multipart/form-data">
                <div class="col-12 col-lg-6">
                  <label for="inputNanme" class="form-label">Doctor Name</label>
                  <input type="text" class="form-control" id="inputNanme" name="name" required>
                </div>
                <div class="col-12 col-lg-6">
               
                       <label for="inputNanme0" class="form-label">Image</label>
                  <input type="file" class="form-control" id="inputNanme0" name="image"> 
                  
                </div>

                <div class="col-12">
                  <label for="inputEmail1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail1" name="email" required>
                </div>
                  <div class="col-12 col-lg-6">
                  <label for="inputNanme2" class="form-label">Medical Collage</label>
                  <input type="text" class="form-control" id="inputNanme2" name="collage">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme3" class="form-label">Academic Title</label>
                  <input type="text" class="form-control" id="inputNanme3" name="academic_title">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme4" class="form-label">Specialist</label>
                  <input type="text" class="form-control" id="inputNanme4" name="specialist">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme5" class="form-label">Deegree</label>
                  <input type="text" class="form-control" id="inputNanme5" name="degree">
                </div>
               
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Mobile</label>
                  <input type="text" class="form-control" id="inputAddress" name="mobile">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
     </form>
        </div>
     </div>

              
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
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
 



 


  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

 

  <!-- Template Main JS File -->
 <script src="../../assets/js/main.js"></script>


    
    
    
 
</body>

</html>
 