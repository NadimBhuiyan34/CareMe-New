<?php
session_start();
 
include_once('../../includes/config.php');
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

  <title>Patient-RequestedTreatment</title>
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

  <main id="main" class="">
   <div class="d-flex justify-content-between ">
    <div class="pagetitle">
      <h1>Requested Treatment</h1>
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">Prescription</li>
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      
<div class="row g-2 mx-auto mx-md-0">


<div class="col-md-3 col-6 col-xl-3 col-sm-6 mx-auto">

    <div class="card p-2 py-3 text-center border-left-info mx-auto">

        <div class="img mb-2">

        <i class="fa-solid fa-file-prescription fa-bounce fa-2xl" style="color: #f91a5d;"></i>
            
        </div>

            <h6 style="color:#041f8a">PS-1236</h6>
            <small>Nadim Bhuiyan</small>
            <p>12 June 2023</p>

        
        <div class="mt-1 apointment d-flex justify-content-center gap-2">

            <!-- <a href="" class="btn btn-info btn-sm "><i class="fa-regular fa-eye"></i></a> -->
            <a href="prescription-pdf.php" class="btn btn-success btn-sm "><i class="fa-solid fa-download"></i></a>
           
        </div>
    </div>
</div>
<div class="col-md-3 col-6 col-xl-3 col-sm-6">

    <div class="card p-2 py-3 text-center border-left-info">

        <div class="img mb-2">

        <i class="fa-solid fa-file-prescription fa-bounce fa-2xl" style="color: #f91a5d;"></i>
            
        </div>

            <h6 style="color:#041f8a">PS-1236</h6>
            <small>Nadim Bhuiyan</small>
            <p>12 June 2023</p>

        
        <div class="mt-1 apointment d-flex justify-content-center gap-2">

            <!-- <a href="" class="btn btn-info btn-sm "><i class="fa-regular fa-eye"></i></a> -->
            <a href="prescription-pdf.php" class="btn btn-success btn-sm "><i class="fa-solid fa-download"></i></a>
           
        </div>
    </div>
</div>
<div class="col-md-3 col-6 col-xl-3 col-sm-6 mx-auto">

    <div class="card p-2 py-3 text-center border-left-info mx-auto">

        <div class="img mb-2">

        <i class="fa-solid fa-file-prescription fa-bounce fa-2xl" style="color: #f91a5d;"></i>
            
        </div>

            <h6 style="color:#041f8a">PS-12366</h6>
            <small>Rahim Bhuiyan</small>
            <p>13 June 2023</p>

        
        <div class="mt-1 apointment d-flex justify-content-center gap-2">

            <!-- <a href="" class="btn btn-info btn-sm "><i class="fa-regular fa-eye"></i></a> -->
            <a href="prescription-pdf.php" class="btn btn-success btn-sm "><i class="fa-solid fa-download"></i></a>
           
        </div>
    </div>
</div>
<div class="col-md-3 col-6 col-xl-3 col-sm-6">

    <div class="card p-2 py-3 text-center border-left-info">

        <div class="img mb-2">

        <i class="fa-solid fa-file-prescription fa-bounce fa-2xl" style="color: #f91a5d;"></i>
            
        </div>

            <h6 style="color:#041f8a">PS-1236</h6>
            <small>Nadim Bhuiyan</small>
            <p>12 June 2023</p>

        
        <div class="mt-1 apointment d-flex justify-content-center gap-2">

            <!-- <a href="" class="btn btn-info btn-sm "><i class="fa-regular fa-eye"></i></a> -->
            <a href="prescription-pdf.php" class="btn btn-success btn-sm "><i class="fa-solid fa-download"></i></a>
           
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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