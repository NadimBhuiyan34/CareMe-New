  
  <aside id="sidebar" class="sidebar">
 
    <ul class="sidebar-nav" id="sidebar-nav">



            <?php if ($_SESSION['user']['role']=='admin')
               {
                ?>
              <li class="nav-item">
        <a class="nav-link " href="../../view/admin/admin-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
            
                <?php
               }
               elseif($_SESSION['user']['role']=='doctor')
               {
                ?>
                <li class="nav-item">
        <a class="nav-link " href="../../view/doctor/doctor-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
                <?php
               }
               else
               {
                ?>
                   <li class="nav-item">
        <a class="nav-link " href="../../view/patient/dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
                      <?php
               }
            ?>
         


     <!-- End Dashboard Nav -->
 
      <li class="nav-heading">Pages</li>
<?php if ($_SESSION['user']['role']=='patient')
               {
                ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/patient/take-treatment.php">
          <i class="bi bi-person"></i>
          <span>Take Treatment</span>
        </a>
      </li><!-- End Profile Page Nav -->
   
      <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/patient/prescription.php">
          <i class="bi bi-question-circle"></i>
          <span>Prescription</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/patient/requested-treatment.php">
          <i class="bi bi-question-circle"></i>
          <span>Requested Treatment</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
    <?php } 
         if($_SESSION['user']['role']=='admin')
         {

    
    ?>
       <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/admin/doctor-index.php">
          <i class="bi bi-question-circle"></i>
          <span>Doctor</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/admin/patient-index.php">
          <i class="bi bi-question-circle"></i>
          <span>Patient</span>
        </a>
      </li>
      <?php }
      
      if($_SESSION['user']['role']=='doctor')
      {
      ?>
              <li class="nav-item">
        <a class="nav-link collapsed" href="../../view/doctor/requested-treatment.php">
          <i class="bi bi-question-circle"></i>
          <span>Requested Treatment</span>
        </a>
      </li>
    <?php } ?>

    </ul>
 
  </aside>