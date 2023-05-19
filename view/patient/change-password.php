 
 <?php

session_start();
require '../../vendor/autoload.php';
 
include_once('../../includes/config.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 2: Validate the form data
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newpassword'];
    $retypePassword = $_POST['renewpassword'];

    // Perform any necessary validation on the form data
    if (empty($currentPassword) || empty($newPassword) || empty($retypePassword)) {
       
           session_start(); 
      $_SESSION['success'] = array('message' => "Please fill in all the fields",'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/patient/change-password.php");
           exit();
    } elseif ($newPassword !== $retypePassword) {
       
          session_start(); 
      $_SESSION['success'] = array('message' => "New password and retype password do not match",'type' => "danger",'icon'=>"fa-triangle-exclamation");

      // Redirect to some page where you want to show the success message
      header("Location: ../../view/patient/change-password.php");
           exit();
    } else {
        // Step 3: Perform the password change operation
        // Here you can write the code to update the user's password in your database
        // You may need to adapt this code to your specific database and password hashing mechanism

        // Example code to update the password

        $userId = $_SESSION['user']['id']; // Assuming you have a user ID stored in the session
        $hashedNewPassword = md5($newPassword); // Hash the new password
        $hashedcurrentPassword = md5($currentPassword); // Hash the new password
        $passwordSql=  "SELECT  `loginPassword` FROM `tbluserregistration` WHERE id=      $userId";
        $result=mysqli_query($con, $passwordSql);
        $row = mysqli_fetch_assoc($result);
          if($row['loginPassword']==$hashedcurrentPassword)
          {
               $query = "UPDATE tbluserregistration SET loginPassword = '$hashedNewPassword' WHERE id = $userId";
              $save=mysqli_query($con, $query);
              if($save)
              {
                  session_start(); 
                  $_SESSION['success'] = array('message' => "Password change successfully", 'type' => "success",'icon'=>"fa-square-check");

                  // Redirect to some page where you want to show the success message
                header("Location: ../../view/patient/change-password.php");
                     exit();
              }
              else
              {
                       session_start(); 
                  $_SESSION['success'] = array('message' => "Password is not change", 'type' => "danger",'icon'=>"fa-triangle-exclamation");

                  // Redirect to some page where you want to show the success message
                header("Location: ../../view/patient/change-password.php");
                     exit();
              }
          }
          else
          {
                 
                       session_start(); 
                  $_SESSION['success'] = array('message' => "Current password is not match", 'type' => "danger",'icon'=>"fa-triangle-exclamation");

                  // Redirect to some page where you want to show the success message
                header("Location: ../../view/patient/change-password.php");
                     exit();
          }
        // Perform the database update
       
        // Execute the query using your database connection object ($conn)
        // ...

        // Step 4: Display success message or handle any errors
        // ...
        echo "Password changed successfully.";
    }
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
 
  <main id="main" class="main">

     <div class="d-flex justify-content-between">
    <div class="pagetitle">
      <h1>Change Password</h1>
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item active">Change-password</li>
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <section  class="section dashboard">
       <?php include_once('../../includes/alert-message.php'); ?>
                <div class=" pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST">

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
  
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->
 
 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 



 
  <!-- Vendor JS Files -->
 
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
 <?php } ?>
