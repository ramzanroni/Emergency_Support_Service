<?php  
 // session_start();
 // include "../libs/db_conn.php";
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge" id="emergencyCount" >0</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php  
        $notificationResult=mysqli_query($conn, "SELECT emergency.id as 'emergencyId', emergency.date as 'date', users.firstName AS 'userName' FROM `emergency` INNER JOIN users ON users.id=emergency.user_id WHERE `emergency`.`status`='New' AND `emergency`.`supervisor_id`='".$_SESSION['userId']."' LIMIT 5");
        while ($notificationRow=mysqli_fetch_assoc($notificationResult)) 
        {
          ?>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" onclick="newEmergency()">
            <i class="fas fa-bell mr-2 text-danger"></i> Emergency from - <?php echo $notificationRow['userName']; ?>            
          </a>
          <?php
        }
        ?>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>