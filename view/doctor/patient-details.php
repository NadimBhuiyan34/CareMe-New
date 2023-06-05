 
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
?>
 
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Doctor-PatientDetails</title>
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
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
<style>
.custom-table thead th {
    font-size: 12px;
}

.custom-table tbody td {
    font-size: 10px;
}
</style>
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
$pat_id=$_GET['id'];
$pres_id=$_GET['pres_id'];
$presSql="SELECT * FROM problems
                     WHERE id=$pres_id";
    $pres= mysqli_query($con, $presSql);

  while ($row = $pres->fetch_assoc()) : 

   $query="SELECT *
     FROM tbluserregistration
     JOIN profiles ON tbluserregistration.id = profiles.user_id  WHERE tbluserregistration.id = $pat_id";
 $ret=mysqli_query($con,$query);
  


?>
  <main id="main" class="main">
<?php include_once('../../includes/alert-message.php'); ?>
     <div class="d-flex justify-content-between pt-3">
    <div class="pagetitle">
      <h1>Patient Details</h1>
   
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
             <?php  while ($user = $ret->fetch_assoc()) :  ?>
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../assets/profile/<?php echo $user['image'] ?>" alt="Profile" class="rounded-circle border-2 border-info" style="width:150; height:150px">
              <h5><?php echo $user['fullName'] ?></h5>
              <h6><?php echo $user['proffession'] ?></h6>
              <div class="social-links mt-2">
                   <a href="../../view/doctor/rx.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Prescription Generate</a>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Problem</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#prescription">Prescription</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#health-data">Health Data</button>
                </li>

               

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Problem</h5>
                  <p class="small fst-italic"><?php echo $row['problem'] ?></p>

                  <h5 class="card-title">Audio</h5>
                    <audio controls class="form-control bg-info">
                        <source src="../../assets/audio/<?php echo $row['audio'] ?>" type="audio/mpeg">
                 
                    </audio>
                      <br>
                       <h5 class="card-title">Image</h5> 
                          <img src="../../assets/prescription_image/<?php echo $row['image'] ?>" alt="image not sent">
                    
                </div>

       

                 

                   

              

                <div class="tab-pane fade profile-edit pt-3" id="profile">

                      <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Full Name :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['fullName'] ?></div>
                  </div>
                  <hr>
                                            <?php
                        $dateOfBirth = $user['date_of_birth'];


                        $birthDate = new DateTime($dateOfBirth);
                        $currentDate = new DateTime();
                        $ageInterval = $currentDate->diff($birthDate);
                        $years = $ageInterval->y;
                        $months = $ageInterval->m;
                        $days = $ageInterval->d;
                       
                        ?>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Date of Birth :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['date_of_birth'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Age :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $years.' Y ' .$months.   ' M '.$days. ' D' ?></div>
                  </div>
                      <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Proffession :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['proffession'] ?></div>
                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Address :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['address'] ?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Mobile :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['mobileNumber'] ?></div>
                  </div>
                        <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label col-6">Email :</div>
                    <div class="col-lg-9 col-md-8 col-6"><?php echo $user['emailid'] ?></div>
                  </div>
                 

                </div>
                 <?php endwhile; ?>
                  




        <div class="tab-pane fade  pt-3" id="prescription">
         <div class="row g-2 mx-auto mx-md-0">
                     
                <?php 
                    $pSql="SELECT * FROM `prescriptions` WHERE user_id = $pat_id";
                      $pr= mysqli_query($con,$pSql);
                         while ($user_ps = $pr->fetch_assoc()) :   
                    
                ?>
                <div class="col-md-3 col-12 col-xl-3 col-sm-6">

                <div class="card p-2 py-3 text-center border-left-info">

                    <div class="img mb-2">

                    <i class="fa-solid fa-file-prescription fa-bounce fa-2xl" style="color: #f91a5d;"></i>
                        
                    </div>
                        
                        <h6 style="color:#041f8a">PS-<?php echo $user_ps['id'] ?></h6>
                          <?php 
                           $d_id=$user_ps['doctor_id'];
                           $us_id=$user_ps['user_id'];
                    $dSql="SELECT * FROM `tbluserregistration` WHERE id = $d_id";
                      $dr= mysqli_query($con,$dSql);
                         while ($d_ps = $dr->fetch_assoc()) :   
                    
                        ?>
                        <small><?php echo $d_ps['fullName'] ?></small>
                        <p><?php echo $user_ps['created_at'] ?></p>

                   <?php endwhile; ?>
                    <div class="mt-1 apointment d-flex justify-content-center gap-2">

                      
                        <a href="../../view/doctor/prescription-pdf.php?presId=<?php echo $d_id ?>" class="btn btn-success btn-sm ">View</a>
                      
                    </div>

           </div>
                  
          </div>
            <?php endwhile; ?>
        </div> 
                       
        </div>
                 
                    

              


              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
       <div class="tab-pane fade  pt-3" id="health-data">
                             
                       <?php 
                       
                       $sensor = "SELECT * FROM sensordata WHERE user_id= $us_id ORDER BY created_at DESC";
                     $result = $con->query($sensor);
 ?>
                  <div class="table-responsive">
    <table class="table datatable">
        <thead class="table-dark">
            <tr style="font-size: 10px">
                <th style="cursor: default;">Room Temp</th>
                <th style="cursor: default;">Humidity</th>
                <th style="cursor: default;">Body Temp</th>
                <th style="cursor: default;">Heart Rate</th>
                <th style="cursor: default;">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['room_temperature']; ?></td>
                    <td><?php echo $row['humidity']; ?></td>
                    <td><?php echo $row['body_temperature']; ?></td>
                    <td><?php echo $row['heart_rate']; ?></td>
                    <td><?php echo date("Y-m-d h:i: A", strtotime($row['created_at'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
     <?php endwhile; ?>





     
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
<script src="https://kit.fontawesome.com/496c26838e.js" crossorigin="anonymous"></script>

</body>

</html>
 
