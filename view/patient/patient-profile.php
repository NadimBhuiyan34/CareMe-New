 
 <?php

session_start();
require '../../vendor/autoload.php';
 
include_once('../../includes/config.php');
$adid=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];

if (isset($_POST['update'])) 

{
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

  
 
   $email = $_POST['email'];
   $fullname=$_POST['fullName'];
   $address=$_POST['address'];
   $proffession=$_POST['proffession'];
   $mobileNumber=$_POST['mobile'];
   $birth=$_POST['birth'];
   $about=$_POST['about'];
   $image=$newFileName??$_POST['profile'];
   
   $userSql= "UPDATE `tbluserregistration` SET `fullName`='$fullname',`emailid`='$email' WHERE id = $adid";

   $profileSql="UPDATE `profiles` SET `address`='$address',`mobileNumber`='$mobileNumber',`date_of_birth`='$birth',`about`='$about',`image`='$image',`proffession`='$proffession' WHERE user_id = $adid";
  //  mysqli_query($conn, $userSql);
  //  mysqli_query($conn, $profileSql);
   if(mysqli_query($con, $userSql) &&   mysqli_query($con, $profileSql))
   {
           session_start(); 
     $_SESSION['success'] = array('message' => "Profile update Successfull!", 'type' => "success",'icon'=>"fa-square-check");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/patient/patient-profile.php");
           exit();
   }
   else
   {
      session_start(); 
     $_SESSION['success'] = array('message' => "Profile update Fail!",'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/patient/patient-profile.php");
           exit();
   }

   


}

if ( $adid == 0) {
       header('Location:../../logout.php');
  exit();
}
?>
 
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Patient-Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../../assets/img/title-logo.png" rel="icon">

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
  
  <!-- End Header -->



  <!-- ======= Sidebar ======= -->
   <?php include_once('../../includes/header.php'); ?>
  <?php include_once('../../includes/sidebar.php'); ?>
 <!-- End Sidebar-->
 
<?php 
 
$patientProfileSql="SELECT *
     FROM tbluserregistration
     JOIN profiles ON tbluserregistration.id = profiles.user_id  WHERE tbluserregistration.id = $adid";
 $sqlData=mysqli_query($con,$patientProfileSql);
  
while($patientProfileData=mysqli_fetch_array($sqlData)){

?>
  <main id="main" class="main">
<?php include_once('../../includes/alert-message.php'); ?>
     <div class="d-flex justify-content-between pt-3">
    <div class="pagetitle">
      <h1>Profile</h1>
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <section  class="section dashboard">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../assets/profile/<?php echo $patientProfileData['image'] ?>" alt="Profile" class="rounded-circle border-2 border-info" style="width:150; height:150px">
              <h5><?php echo $patientProfileData['fullName'] ?></h5>
              <h6><?php echo $patientProfileData['proffession'] ?></h6>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo $patientProfileData['about'] ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Full Name :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['fullName'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Date of Birth :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['date_of_birth'] ?></div>
                  </div>
                      <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Proffession :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['proffession'] ?></div>
                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Address :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['address'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Mobile :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['mobileNumber'] ?></div>
                  </div>
                        <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Email :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $patientProfileData['emailid'] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="../../assets/profile/<?php echo $patientProfileData['image'] ?>" alt="Profile" style="width:100px; height:100px" id="preview-image">
                        <div class="pt-2 mx-auto">
                         <div class="input-group mb-3 mx-auto">
                        <label class="input-group-text bg-primary rounded-2" for="inputGroupFile01" id="upload-label">
                          <i class="bi bi-upload px-4 text-white rounded-2"></i>
                           </label>
                        <input type="file" class="form-control mx-auto" id="inputGroupFile01" style="display:none" onchange="previewImage()" name="image">
                        <input type="hidden" name="profile" value="<?php echo $patientProfileData['image'] ?>">
                      </div>
                           
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $patientProfileData['fullName'] ?>">
                      </div>
                    </div>
                   <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="birth" type="date" class="form-control" id="birth" value="<?php echo $patientProfileData['date_of_birth'] ?>" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo $patientProfileData['about'] ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Proffession</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="proffession" type="text" class="form-control" id="proffession" value="<?php echo $patientProfileData['proffession'] ?>">
                      </div>
                    </div>

                  
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo $patientProfileData['address'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Mobile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="mobile" type="text" class="form-control" id="Phone" value="<?php echo $patientProfileData['mobileNumber'] ?>" required>
                      </div>
                    </div>

                <div class="row mb-3">
  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
  <div class="col-md-8 col-lg-9">
    <input name="email" type="email" class="form-control" id="Email" value="<?php echo $patientProfileData['emailid'] ?>">
  </div>
</div>

                    
 
  

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="update">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

               

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
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
<?php } ?>
 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 



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
  <!-- <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
<script src="https://kit.fontawesome.com/496c26838e.js" crossorigin="anonymous"></script>

</body>

</html>
 
