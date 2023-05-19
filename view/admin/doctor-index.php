<?php
session_start();

include_once('../../includes/config.php');

 

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
   <div class="d-flex justify-content-between">
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
    <!-- End Page Title -->

   <div class="col-12" id="myTable">
              <div class="card recent-sales overflow-auto" >

                <!-- <div class="filter">
                  <a class="icon btn btn-info btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i>Action</a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->
                <div class="mt-2 ms-2">
                   <a href="../../view/admin/doctor-registration.php" class="btn btn-primary btn-sm shadow">Doctor Registration</a>
                </div>
                

                <div class="card-body">
                  <h5 class="card-title">Doctor List <span></span></h5>
                 
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>
             
                 



                </div>

              </div>
            </div>
                 <div class="row g-2" id="mobileDiv">
                      <div>
                        <a href="../../view/admin/doctor-registration.php" class="btn btn-sm btn-primary mb-2 shadow">Doctor Registration</a>
                      </div>
                           <div class="col-md-3 col-12 col-xl-4 col-sm-6">

            <div class="card p-2 py-3 text-center border-left-info doctor">

                <div class="img mb-2">

                    <img src="https://i.imgur.com/LohyFIN.jpg" width="70" class="rounded-circle">
                    
                </div>

                <h5 class="mb-0">Patey Cruiser</h5>
                <small>Neurosurgeon</small>

                <div class="ratings mt-2">

                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    
                </div>

                <div class="mt-4 apointment d-flex justify-content-center gap-2">

                    <button class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-info text-white mr-1"></i></i>More</button>
                    <button class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1"><i class="fa-solid fa-share text-white mr-1"></i>Update</button>
    
                </div>
                <!-- More  -->
                <div class="collapse mt-2 shadow" id="collapseExample">
                    <div class="card card-body">
                      <p>Education Qualification: Dhaka Medical Collage</p><br>
                      <p>hdsgbcndbc: ahsgcghgsdb</p>
                    </div>
                </div>
                <!-- Share -->
                <div class="collapse mt-2 shadow" id="collapseExample1">
                    <div class="card card-body">

                    <div class="form-floating ">

                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Share your problem</label>
                    <br>
                            <div class="m-auto">
                            <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                    </div>
                </div>
            </div>
            
      
</div>
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
// JavaScript/jQuery code to check device size and toggle table visibility

function checkDeviceSize() {
  if ($(window).width() < 576) {
    // If device size is less than 576px (Bootstrap's mobile breakpoint)
    $('#myTable').addClass('d-none'); // Hide the table
    $('#myTable').removeClass('datatable'); // Hide the table
    $('#mobileDiv').removeClass('d-none'); // Show the mobile div
  } else {
    $('#myTable').removeClass('d-none'); // Show the table
    $('#myTable').addClass('datatable'); // Show the table
    $('#mobileDiv').addClass('d-none'); // Hide the mobile div
  }
}

$(window).on('load resize', function() {
  // Check device size on page load and window resize
  checkDeviceSize();
});
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
 