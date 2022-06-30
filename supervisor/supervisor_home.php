<?php
session_start();
include "../libs/db_conn.php";
if($_SESSION['supervisorUsername']==null)
{
  header("Location: http://localhost/Emergency_Support_Service/supervisor/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emergency Support Service</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- datatable -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <!-- javascript function -->
  <script src="js/supervisor.js"></script> 

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php  
    include_once "top_bar.php";
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include_once "main_sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content pt-4" id="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row" id="dashboard">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <?php 
                    $countNewEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalNew' FROM `emergency` WHERE `supervisor_id`='".$_SESSION['userId']."' AND `status`='New'"));
                  ?>
                  <h3><?php echo $countNewEmergency['totalNew']; ?></h3>

                  <p>New Emergency</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="newEmergency()">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <?php 
                    $countActionEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalAction' FROM `emergency` WHERE `supervisor_id`='".$_SESSION['userId']."' AND `status`='Action'"));
                  ?>
                  <h3><?php echo $countActionEmergency['totalAction']; ?></h3>

                  <p>Action Emergency</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="actionEmergency()">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <?php 
                    $countCompleteEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalComplete' FROM `emergency` WHERE `supervisor_id`='".$_SESSION['userId']."' AND `status`='Complete'"));
                  ?>
                  <h3><?php echo $countCompleteEmergency['totalComplete']; ?></h3>
                  <p>Complete Emergency</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="completeEmergency()">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      
    </section>
  </div>

  <?php 
  include_once "footer.php";
  ?>

  <script type="text/javascript">
    $( document ).ready(function() {

          // setInterval(enableAutoplay, 10000); 
          setInterval(countEmergency, 2000); 
          // countEmergency();         
        });
    function enableAutoplay(status) {
     var x = document.getElementById("myAudio"); 
     if (status>0) {
       x.autoplay = true;
     }
     else
     {
      x.autoplay = false;
     }
    
     x.load();
   }

   function dashboardLoding() 
   {
     alert('ok');
   }
   function countEmergency()
   {
     
    var check = "countEmergency";
    $.ajax({
        url: "reports/emegencyAction.php",
        type: "POST",
        data: {
            check: check
        },
        success: function (response) {
            enableAutoplay(response);
            $("#emergencyCount").html(response);
            $("#dashboard").load(" #dashboard > *");


        }
    });
   }

 </script>