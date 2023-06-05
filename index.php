<?php 
session_start();
error_reporting(0);
//DB conncetion
include_once('includes/config.php');




if(isset($_POST['login']))
  {
$email=$_POST['emailid'];
$userpassword=md5($_POST['userpassword']);
    $query=mysqli_query($con,"select * from tbluserregistration where  emailid='$email' && loginPassword='$userpassword' ");
    $ret=mysqli_fetch_array($query);
    if($ret['role']=='admin'){
       $_SESSION['user'] = array(
           'id' => $ret['id'],
           'device' => $ret['device'],
           'role' => $ret['role'],
   
);
     header('location:view/admin/admin-dashboard.php');
    }
    elseif($ret['role']=='patient'){
      // $_SESSION['aid']=$ret['id'];
      $_SESSION['user'] = array(
     'id' => $ret['id'],
     'device' => $ret['device'],
    'role' => $ret['role'],
   
);
     header('location:view/patient/dashboard.php');
    }
    elseif($ret['role']=='doctor'){
       $_SESSION['user'] = array(
     'id' => $ret['id'],
     'device' => $ret['device'],
    'role' => $ret['role'],
   
);
     header('location:view/doctor/doctor-dashboard.php');
    }
    else{
       
      // Perform some action and set a success message
       $_SESSION['success'] = array('message' => "Email or Password is not Correct",'type' => "danger",'icon'=>"fa-triangle-exclamation");
      // Redirect to some page where you want to show the success message
      header("Location: index.php");
      exit();
              
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CareMe / Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
   <link href="assets/img/title-logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">
    
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <!-- <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo4.png" alt="" style="height:100px; width:100px">
 
                </a>
              </div> -->

              <div class="card mb-3">
<?php include_once('includes/alert-message.php'); ?>
                <div class="card-body">

                  <div class="pt-4 pb-2 mx-auto text-center">
                     <img src="assets/img/logo4.png" alt="" style="height:70px; width:150px" class="mx-auto">
                  
                   <!-- <p>Login to Your Account</p> -->
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate >

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="email" name="emailid" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="userpassword" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                   
                  </form>

                </div>
              </div>

            

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>