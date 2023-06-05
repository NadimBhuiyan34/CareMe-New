 
 <?php

session_start();
require '../../vendor/autoload.php';
 
include_once('../../includes/config.php');

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
?>
 
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Doctor-Details</title>
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
       $id=$_GET['id'];
       
   $doctorSql = "SELECT *
              FROM tbluserregistration
              JOIN doctor_profiles ON tbluserregistration.id = doctor_profiles.user_id
              WHERE emailid ='$id'";
      $users= mysqli_query($con, $doctorSql); 
      $row = mysqli_fetch_assoc($users);
      
      ?>
 
  <main id="main" class="main">
<?php include_once('../../includes/alert-message.php'); ?>
     <div class="d-flex justify-content-between pt-3">
    <div class="pagetitle">
      <h1><?php echo $row['fullName'] ?></h1>
   
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

              <img src="../../assets/profile/<?php echo $row['image'] ?>" alt="Profile" class="rounded-circle border-2 border-info" style="width:150; height:150px">
              <h5><?php echo $row['fullName'] ?></h5>
             <span class="badge  <?php echo $row['is_varify'] == 1 ? 'text-bg-success' : 'text-bg-danger' ?>"><?php echo $row['is_varify']==1?'Active':'InActive' ?></span>
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
                  <!-- <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button> -->
                  <a href="../../view/admin/doctor-edit.php?id=<?php echo $row['emailid']; ?>" class="nav-link btn ">Edit Profile</a>
                </li>

              
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo $row['about'] ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Full Name :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['fullName'] ?></div>
                  </div>
                  <hr>
                   <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Medical Collage :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['collage'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Academic Title :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['academic_title'] ?></div>
                  </div>
                      <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Specialist :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['specialties'] ?></div>
                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Degree :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['degree'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Mobile :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['mobile'] ?></div>
                  </div>
                        <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Email :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $row['emailid'] ?></div>
                  </div>

                </div>

     

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

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
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <p id="messageText">Email has been modified. Click OK to save changes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="okButton" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

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
  const emailInput = document.getElementById('Email');
  const messageText = document.getElementById('messageText');
  const okButton = document.getElementById('okButton');
  let originalEmailValue = emailInput.value;

  emailInput.addEventListener('input', function() {
    if (emailInput.value !== originalEmailValue) {
      messageText.textContent = 'Email has been modified. Click OK to save changes.';
      $('#myModal').modal('show');
    }
  });

  okButton.addEventListener('click', function() {
    originalEmailValue = emailInput.value;
    $('#myModal').modal('hide');
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
  <!-- <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
<script src="https://kit.fontawesome.com/496c26838e.js" crossorigin="anonymous"></script>

</body>

</html>
 