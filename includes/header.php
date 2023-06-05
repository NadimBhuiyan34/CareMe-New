
 <header id="header" class="header fixed-top d-flex align-items-center">
 
  <?php
//Fetching admin Name

 
if($role=='doctor')
{
     $query="SELECT *
     FROM tbluserregistration
     JOIN doctor_profiles ON tbluserregistration.id = doctor_profiles.user_id WHERE tbluserregistration.id = $adid";
}
else
{
     $query="SELECT *
     FROM tbluserregistration
     JOIN profiles ON tbluserregistration.id = profiles.user_id  WHERE tbluserregistration.id = $adid";
}

$ret1=mysqli_query($con,$query);
  

while($header=mysqli_fetch_array($ret1)){

?>
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- <img src="../../assets/img/title-logo.png" alt=""> -->
        <span class="d-none d-lg-block">CareMe</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword" id="search">
        
      </form>
      
    </div><!-- End Search Bar -->
       <div id="suggestion-container"></div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">
       <?php 
            
            $countSql="SELECT * FROM `notifications` WHERE user_id= $adid && status != 'seen' ";
            $notifiSql="SELECT * FROM `notifications` WHERE user_id= $adid";
            $notiCount = mysqli_query($con, $countSql);
            $notification = mysqli_query($con, $notifiSql);
             $rowCount = mysqli_num_rows($notiCount);

       ?>
        <!-- header.php -->
 
  <div class="dropdown">
  <button type="button" class="nav-link nav-icon notification-button" id="notificationIcon" data-bs-toggle="dropdown" style="border:none; background-color:transparent;padding:0">
    <i class="bi bi-bell"></i>
    <?php if ($rowCount > 0): ?>
  <span class="badge bg-primary badge-number"><?php echo $rowCount ?></span>
<?php endif; ?>

   
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
    <li class="dropdown-header">
      You have <?php echo $rowCount ?> new notifications
      <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <?php
    while ($notifications = $notification->fetch_assoc()) :
      $createdTime = $notifications ['created_at'];
      $createdTimestamp = strtotime($createdTime);
      $currentTimestamp = time();
      $timeDiff = $currentTimestamp - $createdTimestamp;
      $interval = date_diff(date_create('@0'), date_create("@$timeDiff"));
      $formattedTimeDiff = '';

      if ($interval->y > 0) {
        $formattedTimeDiff = $interval->format('%y years ago');
      } elseif ($interval->m > 0) {
        $formattedTimeDiff = $interval->format('%m months ago');
      } elseif ($interval->d > 0) {
        $formattedTimeDiff = $interval->format('%d days ago');
      } elseif ($interval->h > 0) {
        $formattedTimeDiff = $interval->format('%h hours ago');
      } elseif ($interval->i > 0) {
        $formattedTimeDiff = $interval->format('%i minutes ago');
      } else {
        $formattedTimeDiff = 'Just now';
      }
    ?>
      <li class="notification-item">
        <i class="bi bi-x-circle text-danger"></i>
        <div>
          <p class="text-primary"><?php echo $notifications['description'] ?></p>
          <p><?php echo $formattedTimeDiff ?></p>
        </div>
      </li>
    <?php endwhile; ?>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li class="dropdown-footer">
      <a href="#">Show all notifications</a>
    </li>
  </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#notificationIcon').click(function() {
      // Perform AJAX request to update the data
      $.ajax({
        url: '../../notification.php', // PHP file to handle the AJAX request
        type: 'POST',
        success: function(response) {
          console.log('Data updated successfully sag');
          // Handle the response if needed
        },
        error: function(xhr, status, error) {
          console.log('Error updating data');
        }
      });
    });
  });
</script>

       <?php if($role=='patient') 
                {

               
       
       ?>
        <li class="nav-item dropdown">
          <?php 
            $sensorSql = "SELECT * FROM sensordata WHERE user_id = $adid AND (body_temperature > 99 OR heart_rate > 99)";

              $result = $con->query($sensorSql);
             
          ?>
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number"></span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
             
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           <?php 
            if($result)
              {
                
             
           ?>
            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4></h4>
                 
                     <?php while ($row = $result->fetch_assoc()) : ?></p>
                      <p>Your health data is Iregular Body Temperature is<?php echo $row['body_temperature'] ?> 
                </div>
              </a>
            </li>
            <li>
                   <?php endwhile; ?>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->
        <?php }
         }
        
        ?>
    
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../../assets/profile/<?php echo $header['image'] ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $header['fullName'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $header['fullName'] ?></h6>
              <span class="badge text-bg-success"><?php echo $header['role'] ?></span>
            
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
      <?php 
          if($header['role']=='doctor')
          {
        ?>   
              <li>
              <a class="dropdown-item d-flex align-items-center" href="../../view/doctor/doctor-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
         <?php }
         else {
           ?>
             <li>
              <a class="dropdown-item d-flex align-items-center" href="../../view/patient/patient-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <?php

         }
          
         
         ?>
           
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../view/patient/change-password.php">
                 <i class="bi bi-gear"></i>
                <span>Change Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
 
  <?php } ?>
 