<?php
session_start();

include_once('../../includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 if($_SESSION['user']['role'] !='admin')
{
         header('Location:../../pages-error.php');
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
   

 
   $fname=$_POST['name'];

   $is_varify=$_POST['is_varify'];
    $is_verify=$is_varify==1?'1':'0';
   $email=$_POST['email'];
   $address=$_POST['address'];
   $birth=$_POST['birth'];
   $proffession=$_POST['proffession'];
   $mobile=$_POST['mobile'];
   $about=$_POST['about'];
   $image=$newFileName??$_POST['currentImage'];
   $ret=mysqli_query($con,"select id from tbluserregistration where emailid='$email'");
    $result=mysqli_num_rows($ret);
    $data=mysqli_fetch_assoc($ret);
    $user_id=$data['id'];
   if($result>0){
        
   $userSql= "UPDATE `tbluserregistration` SET `fullName`='$fname',`is_varify`='$is_verify' WHERE emailid = '$email'";

   $profileSql=" UPDATE `profiles` SET `address`='$address',`mobileNumber`='$mobile',`date_of_birth`='$birth',`about`='$about',`image`='$image',`proffession`='$proffession' WHERE user_id = $user_id";
     $user_update= mysqli_query($con, $userSql);

      if(mysqli_query($con, $userSql) &&   mysqli_query($con, $profileSql))
   {
           session_start(); 
     $_SESSION['success'] = array('message' => "Profile update Successfull!", 'type' => "success",'icon'=>"fa-square-check");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/admin/patient-index.php");
           exit();
   }
   else
   {
      session_start(); 
     $_SESSION['success'] = array('message' => "Profile update Fail!",'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
        header("Location: ../../view/admin/patient-index.php");
           exit();
   }
     
    //  $mail=sendMail($email,$v_code,$random_password,$fname);
    
 
      
         

}
else 
{
     session_start(); 
     
     $_SESSION['success'] = array('message' => "This data is not available", 'type' => "danger",'icon'=>"fa-triangle-exclamation");
      // Redirect to some page where you want to show the success message
     header("Location: ../../view/admin/patient-index.php");
          exit();
}
 
 


 }

if (strlen($_SESSION['user']['id']) == 0) {
       header('Location:../../logout.php');
  exit();
}

 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin-PtientEdit</title>
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
      <h1>Patient Edit</h1>
   
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
     <div class="card">
        <div class="card-header bg-primary text-white text-center mb-2">
            <h6>Edit Patient Profile</h6>
        </div>
    <?php 
       $id=$_GET['id'];
       
   $patientSql = "SELECT *
              FROM tbluserregistration
              JOIN profiles ON tbluserregistration.id = profiles.user_id
              WHERE emailid ='$id'";
      $users= mysqli_query($con, $patientSql); 
      $row = mysqli_fetch_assoc($users);
      
      ?>
        <div class="card-body ">
           <form class="row g-3" method="POST"  enctype="multipart/form-data">
                <div class="col-12 col-lg-6">
                  <label for="inputNanme" class="form-label">Patient Name</label>
                  <input type="text" class="form-control" id="inputNanme" name="name" required value="<?php echo $row['fullName'] ?>">
                </div>
                <div class="col-12 col-lg-6">
               
                   <img src="../../assets/profile/<?php echo $row['image'] ?>" alt="Profile" style="width:70px; height:70px" id="preview-image">
                        
                        <label class=" bg-primary rounded-2" for="inputGroupFile01" id="upload-label">
                           <img src="https://cdn.pixabay.com/photo/2016/01/03/00/43/upload-1118929_1280.png" alt="" style="width:70px;height:70px">
                           </label>
                        <input type="file" class="form-control mx-auto" id="inputGroupFile01" style="display:none" onchange="previewImage()" name="image">
                           
                  
                </div>
 
                 
                  <input type="hidden" class="form-control" id="inputEmail1" name="email" value="<?php echo $row['emailid'] ?>">
                  <input type="hidden" class="form-control" id="inputEmail1" name="currentImage" value="<?php echo $row['image'] ?>">

            
                  <div class="col-12 col-lg-6">
                  <label for="inputNanme2" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="inputNanme2" name="birth" value="<?php echo $row['date_of_birth'] ?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Mobile</label>
                  <input type="text" class="form-control" id="inputAddress" name="mobile" value="<?php echo $row['mobileNumber'] ?>">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme3" class="form-label">Address</label>
                  <input type="text" class="form-control" id="inputNanme3" name="addreess" value="<?php echo $row['address'] ?>">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme4" class="form-label">Profession</label>
                  <input type="text" class="form-control" id="inputNanme4" name="profession" value="<?php echo $row['proffession'] ?>">
                </div>
                 <div class="col-12 col-lg-6">
                  <label for="inputNanme5" class="form-label">About</label>
                    <textarea class="form-control" style="height: 100px" id="inputabout" name="about" ><?php echo $row['about'] ?></textarea>
                </div>
               
                
                <div class="col-12">
                     <label for="inputAddress" class="form-label">Account Status</label>
                   <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="is_varify" value="1" id="flexSwitchCheckChecked" <?php echo $row['is_varify']==1?'checked':'' ?>>
                        
                       <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo $row['is_varify']?'Active':'InActive' ?></label>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submit">Save Change</button>
                  
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
 
    <script>
  var checkbox = document.getElementById('flexSwitchCheckChecked');
  var hiddenInput = document.querySelector('input[name="is_varify"]');

  checkbox.addEventListener('change', function() {
    hiddenInput.value = this.checked ? '1' : '0';
  });
</script>

   <script>
   function previewImage() {
  var preview = document.getElementById('preview-image');
  var fileInput = document.getElementById('inputGroupFile01');
  var file = fileInput.files[0];
  var reader = new FileReader();
  reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "{{ asset('storage/profiles').'/'.$user->profile->image }}";
  }
}
 
    
    
</script>  


 


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
 