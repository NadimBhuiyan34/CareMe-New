<?php
session_start();

include_once('../../includes/config.php');
$adid=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];
 if($role !='admin')
{
         header('Location:../../pages-error.php');
         exit();
}
 
if(isset($_POST['delete']))
{
         $id=$_POST['id'];
         $deleteSql="DELETE FROM `tbluserregistration` WHERE id = $id";
         $deleteConfirm= mysqli_query($con, $deleteSql);

             $_SESSION['success'] = array('message' => "Doctor Delete Successfull",'type' => "success",'icon'=>"fa-triangle-exclamation");
      // Redirect to some page where you want to show the success message
      header("Location:../../view/admin/doctor-index.php");
      exit();
}

 

if ($adid == 0) {
       header('Location:../../logout.php');
  exit();
}
 
// $patientSql="SELECT * FROM `tbluserregistration` WHERE role =='patient'";
$patientSqlData="SELECT *
     FROM tbluserregistration
     JOIN profiles ON tbluserregistration.id = profiles.user_id WHERE role = 'patient' ORDER BY regDate DESC";
$patientsData= mysqli_query($con, $patientSqlData);

 

 
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin-Emergency Patients</title>
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
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../../assets/css/datatables.min.css"> -->
 
    

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
          <li class="breadcrumb-item"><a href="index.html"><i class="fa-solid fa-backward-fast"></i></a></li>
          <li class="breadcrumb-item"><a href="index.html"><i class="fa-solid fa-rotate-left"></i></a></li>
         
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <!-- End Page Title -->
 <?php include_once('../../includes/alert-message.php'); ?>
   <div class="col-12" id="myTable">
              <div class="card recent-sales overflow-auto" >

               
               
                

                <div class="card-body">
                  <h5 class="card-title">Emergency Patients <span></span></h5>
                 
                  <table class="table datatable">
                    <thead>
                      <tr>
                       
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Body Temperature</th>
                        <th scope="col">Room Temperature</th>
                        <th scope="col">Humidity</th>
                        <th scope="col">Heart Rate</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php while ($data = $patientsData->fetch_assoc()) : ?>
                     <?php 
                         $id = $data['user_id'];
                    $sensorSql = "SELECT * FROM sensordata WHERE user_id = $id AND (body_temperature > 99 OR heart_rate > 100)";

                         $sensorData= mysqli_query($con,$sensorSql);
                      
                      ?>
                <?php while ($sensor = $sensorData->fetch_assoc()) : ?>
                      <tr>
              
                        <td><?php echo $data['fullName'] ?></td>
                        <td><?php echo $data['address'] ?></td>
                        <td><?php echo $data['mobileNumber'] ?></td>
                        <td><?php echo $sensor['room_temperature'] ?></td>
                        <td><?php echo $sensor['body_temperature'] ?></td>
                        <td><?php echo $sensor['humidity'] ?></td>
                        <td><?php echo $sensor['heart_rate'] ?></td>
                        <td></td>
              

                      </tr>
                       <?php endwhile; ?>
                       <?php endwhile; ?>
                       
                      
                    </tbody>
                  </table>
             
                 



                </div>

              </div>
            </div>
            <!-- mobileDiv -->
                 <div class="row g-2" id="mobileDiv">
                      <div>
                        <a href="../../view/admin/doctor-registration.php" class="btn btn-sm btn-primary mb-2 shadow">Doctor Registration</a>
                      </div>
               <?php 
                  $doctorSql="SELECT *
                              FROM tbluserregistration
                             JOIN doctor_profiles ON tbluserregistration.id = doctor_profiles.user_id WHERE role = 'doctor' ORDER BY regDate DESC";
                              $users= mysqli_query($con, $doctorSql);
               while ($row = $users->fetch_assoc()) : ?>
                  <div class="col-md-3 col-6 col-xl-4 col-sm-6">

                   <div class="card p-2  text-center border-left-info doctor">

                <div class="img mb-2">

                    <img src="../../assets/profile/<?php echo $row['image'] ?>" width="70" class="rounded-circle" height="70px">
                    
                </div>

                <h6 class="mb-0"><?php echo $row['fullName'] ?></h6>
                <small><?php echo $row['specialties'] ?></small>

                

                <div class="mt-4 apointment d-flex justify-content-center gap-2">

                   <a href="../../view/admin/doctor-details.php?id=<?php echo $row['emailid']; ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
<a href="../../view/admin/doctor-edit.php?id=<?php echo $row['emailid']; ?>" class="btn btn-sm btn-primary me-1"><i class="fa-solid fa-pen-to-square"></i></a>
    <form action="" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
      <button class="btn btn-sm btn-danger" type="submit" name="delete">
             <i class="bi bi-trash"></i> 
      </button>

    </form>
    
                </div>
                <!-- More  -->
                 
                <!-- Share -->
              
            
      
</div>
</div>
  <?php endwhile; ?>
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
  <script src="../../assets/js/jquery-3.6.0.min.js"></script>
 

  <!-- Template Main JS File -->
 <script src="../../assets/js/main.js"></script>


    
    
    
 
</body>

</html>
 