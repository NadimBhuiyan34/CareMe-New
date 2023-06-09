<?php
session_start();
 
include_once('../../includes/config.php');
$adid=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];
 
 if($role !='patient')
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

  <title>Patient-TakeTreatment</title>
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

  <main id="main" class="main">
   <div class="d-flex justify-content-between pt-3">
    <div class="pagetitle">
      <h1>Take Treatment</h1>
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Take Treatment</li>
        </ol>
      </nav>
      
    </div>
    <div>
        <img src="../../assets/img/logo4.png" alt="" style="height:40px; width:90px" class="mx-auto">
    </div>
  </div>
    <!-- End Page Title -->

    <section class="section dashboard row">
          <?php include_once('../../includes/alert-message.php'); ?>
      <div class="col-xl-6 col-md-6 mb-4 col-6">
                           <!-- <a href="dashboard.php"> -->
                           <div class="card border-info border-3 border-start shadow h-100 py-2">
                                
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">


                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           
                                        <button class="btn btn-info shadow " id="hospitalbtn"><i class="fa-solid fa-hospital mr-1"></i>
                                        <br>
                                        From Hospital</button>
                                        </div>
                                            
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fa fa-home  text-dark"></i>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- data -->
                            </div>
                           </a>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4 col-6">
                            <div class="card border-success border-3 border-start shadow h-100 py-2">
                                
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">


                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <button class="btn btn-success shadow" id="doctorbtn"><i class="fa-solid fa-user-doctor mr-1"></i>
                                            <br>
                                            From Doctor</button>
                                            </div>
                                            
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-users  text-dark"></i>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- data -->
                            </div>
                        </div>
<!-- Hospital div -->
   <div class="card  border-left-primary m-auto" id="hospitaldiv" style="display:none">
   
  <div class="card-body">
  <form action="">
    <div class="form-floating">

 <textarea class="form-control mt-3" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Share your problem</label>
  <br>
  <div class="m-auto">
  <button class="btn btn-success" type="submit">Submit</button>
  </div>
 </form>
</div>
  </div>
</div>
     
<!-- Image div -->
<div class="card col-12 col-xl-6 col-md-6 col-sm-6 m-auto " id="imagediv">
   <div class="card-body m-auto mt-3">
    <img src="https://i.pinimg.com/originals/4b/22/93/4b229396885b90ea126258e5d19370ec.gif" alt="" class="img-fluid shadow rounded">
    </div>
  </div>
 
<!-- Doctor div -->

<div class=" mt-1 mb-5" id="doctordiv" style="display:none">

<div class="row">

<!-- <div class="input-group mb-3 col-10 col-xl-5 mx-auto mb-2" >
  <input type="text" class="form-control shadow" placeholder="Search here" style="border-radius:20px;">
 
</div> -->

</div>
    
    <div class="row g-2">
            <?php 
                  $doctorSql="SELECT *
                              FROM tbluserregistration
                             JOIN doctor_profiles ON tbluserregistration.id = doctor_profiles.user_id WHERE role = 'doctor' ORDER BY regDate DESC";
                              $users= mysqli_query($con, $doctorSql);
               while ($Doctor_data = $users->fetch_assoc()) : ?>
        <div class="col-md-3 col-12  col-xl-4 col-sm-6 ">

            <div class="card p-2 py-3 text-center border-left-info doctor">

                <div class="img mb-2">

                 <img src="../../assets/profile/<?php echo $Doctor_data ['image'] ?>" width="70" class="rounded-circle" height="70px">
                    
                </div>

               <h6 class="mb-0"><?php echo $Doctor_data ['fullName'] ?></h6>
                <small><?php echo $Doctor_data ['specialties'] ?></small>

               

                <div class="mt-4 apointment d-flex justify-content-center gap-2">

                  <a href="../../view/patient/doctor-details-patient.php?id=<?php echo $Doctor_data ['emailid']; ?>" class="btn btn-sm btn-primary">More</a>
                   <a href="../../view/patient/record-problem.php?id=<?php echo $Doctor_data['user_id'] ?>" class="btn btn-sm btn-success">Take Treatment</a>
    
                </div>
               
         </div>
      </div>
                
  <?php endwhile; ?>
 

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


  <script>
  const searchBox = document.getElementById('search');

searchBox.addEventListener('input', function () {
  filterDoctors(searchBox.value.toLowerCase());
});
function filterDoctors(query) {
  const doctors = document.querySelectorAll('.doctor');

  doctors.forEach(function (doctor) {
    const name = doctor.querySelector('h6').textContent.toLowerCase();
    const occupation = doctor.querySelector('small').textContent.toLowerCase();

    if (name.includes(query) || occupation.includes(query)) {
      doctor.style.display = '';
    } else {
      doctor.style.display = 'none';
    }
  });
}

  </script>

  <script>
    const searchInput = document.getElementById('search');
const suggestionContainer = document.getElementById('suggestion-container');

searchInput.addEventListener('input', displaySuggestions);

function displaySuggestions() {
  const searchTerm = searchInput.value.trim();

  if (searchTerm !== '') {
    // Perform AJAX request to fetch suggestions based on the search term
    fetchSuggestions(searchTerm)
      .then((suggestions) => {
        // Display the suggestions in the suggestion container
        showSuggestions(suggestions);
      })
      .catch((error) => {
        console.error('Error fetching suggestions:', error);
      });
  } else {
    // Clear the suggestion container if the search term is empty
    clearSuggestions();
  }
}

function fetchSuggestions(searchTerm) {
  // Define your existing data for suggestions
  const suggestions = ['Suggestion 1', 'Suggestion 2', 'Suggestion 3'];

  // Filter the suggestions based on the search term
  const filteredSuggestions = suggestions.filter((suggestion) => {
    return suggestion.toLowerCase().includes(searchTerm.toLowerCase());
  });

  // Return the filtered suggestions
  return Promise.resolve(filteredSuggestions);
}
 function showSuggestions(suggestions) {
  // Clear the suggestion container
  clearSuggestions();

  // Create and append suggestion elements to the container
  suggestions.forEach((suggestion) => {
    const suggestionElement = document.createElement('div');
    suggestionElement.textContent = suggestion;
    suggestionElement.classList.add('suggestion');
    suggestionElement.addEventListener('click', () => {
      // Set the clicked suggestion as the search input value
      searchInput.value = suggestion;
      // Clear the suggestion container
      clearSuggestions();
      // Show doctors based on the selected suggestion
      showDoctors(suggestion);
    });
    suggestionContainer.appendChild(suggestionElement);
  });
}

function showDoctors(suggestion) {
  // Get all the doctor cards within the "doctordiv" container
  const doctorCards = document.querySelectorAll('.doctor');

  // Loop through each doctor card and check if the name matches the suggestion
  doctorCards.forEach((card) => {
    const fullName = card.querySelector('h6').textContent;

    // Show/hide the card based on the suggestion match
    if (fullName === suggestion) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}


  </script>
  <script>
  document.getElementById("doctorbtn").addEventListener("click", doctor);
  document.getElementById("hospitalbtn").addEventListener("click", hospital);
 
  
  function doctor() {
      var doctordiv = document.getElementById("doctordiv");
      // var hospitalBtn = document.getElementById("hospital");
      var div = document.getElementById("hospitaldiv");
      var imagediv = document.getElementById("imagediv");
      

      if (doctordiv.style.display === "none") {
        doctordiv.style.display = "block";
          imagediv.style.display = "none";
          div.style.display = "none";
          // hospitalBtn.disabled=true;
      } 
      else
      {
        doctordiv.style.display = "none";
        imagediv.style.display = "block";
        // hospitalBtn.disabled=false;
      }
    }

  function hospital() {
      var div = document.getElementById("hospitaldiv");
      var doctordiv = document.getElementById("doctordiv");
      var imagediv = document.getElementById("imagediv");
      // var doctorBtn = document.getElementById("doctor");
      if (div.style.display === "none") {
          div.style.display = "block";
           
          imagediv.style.display = "none";
          doctordiv.style.display = "none";
          // doctorBtn.disabled = true;
      } 
      else
      {
        div.style.display = "none";
        imagediv.style.display = "block";
        // doctorBtn.disabled = false;
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
 