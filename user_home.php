<?php
session_start();
include "libs/db_conn.php";
if($_SESSION['user_name']==null)
{
	header("Location: http://localhost/Emergency_Support_Service/");
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

	<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<!-- datatable -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- select2 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
	<!-- javascript function -->
	<script src="js/index.js"></script> 

</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo"  height="500" width="500">
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
			<!-- Content Header (Page header) -->
			<!--<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Dashboard</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Dashboard v1</li>
							</ol>
						</div>
					</div>
				</div>
			</div>-->
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content" id="content">
				<div class="container-fluid">
					<div class="row" id="newEnergencyField">

					</div>
					<div class="row justify-content-center" id="mapView">
						<div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 text-center p-0 mt-1 mb-1">
							<?php 
							$locationAddress=mysqli_query($conn, "SELECT emergency.lat AS 'lat', emergency.lon AS 'lon', supervisors.latitude AS 'latitude', supervisors.longitude AS 'longitude'
								FROM emergency
								INNER JOIN supervisors
								ON emergency.supervisor_id = supervisors.id WHERE emergency.status='Action' AND emergency.user_id='".$_SESSION['userId']."' LIMIT 1 ");
							$locationData=mysqli_fetch_assoc($locationAddress);

							$url="https://www.openstreetmap.org/directions?engine=graphhopper_foot&route=".$locationData['lat']."%2C".$locationData['lon']."%3B".$locationData['latitude']."%2C".$locationData['longitude'];
								?>
								
								<div id="dvMap" style="width: 100%; height: 250px">
									<div class="col-12">
									<img style="width: 45%;" src="images/direction.png">										
									</div>
									<div class="col-12 mt-2">										
									<a class="btn btn-danger"  href="<?php echo $url; ?>" target="_blank">View Map</a>
									</div> 
								</div>
							</div>
						</div>
						
						<div class="row mt-2" id="emergencyUnit">
							<?php 
							$serviceData=mysqli_query($conn, "SELECT * FROM `services` WHERE `status`='1'");
							while ($row=mysqli_fetch_assoc($serviceData)) 
							{

								?>
								
								<div class="col-md-3 mt-1 mb-1 float-left mb-4" >
									<div class="shadow p-2 bg-white rounded" onclick="openEmergencyBox('<?php echo $row["id"]; ?>')">
									<img style="width: 100%;" src="<?php echo $row['serviceImg']; ?>">
								</div>
								</div>
								<?php
							}
							?>
						
						</div>
						<!-- /.row (main row) -->
					</div><!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<input type="hidden" name="latitudeVal" id="latitudeVal">
			<input type="hidden" name="longitudeVal" id="longitudeVal">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['userId']; ?>"> 
			<!-- /.content-wrapper -->
			<?php 
			include_once "footer.php";
			?>

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->


		<!-- modal -->
		<div class="modal fade" id="comBox">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div id="modalInfo">

					</div>

				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAjbn_rb7xcavM74VhIUOLjnBFbURiZXc&callback=initMap&v=weekly"
		async
		></script>
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- ChartJS -->
		<script src="plugins/chart.js/Chart.min.js"></script>
		<!-- Sparkline -->
		<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap --><!-- 
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


</body>
</html>

<script type="text/javascript">




	$( document ).ready(function() {
		$("#mapView").hide();
		function progressBar()
		{
			var newStatus=$("#comStatus").val();
			if (newStatus=="New") {
				$("#emergencyUnit").hide();
				$("#mapView").hide();
			}
			if (newStatus=="Action") {
				$("#emergencyUnit").hide();
				$("#mapView").show();
				$("#personal").addClass("active");
			}
		}

		// function checkFeedback()
		// {
		// 	var userID=$("#user_id").val();
		// 	var check="checkFeedback";
		// 	$.ajax({
		// 		url: "reports/emergencyAction.php",
		// 		type: "POST",
		// 		data: {
		// 			userID: userID,
		// 			check: check
		// 		},
		// 		success: function (response) {
		// 			$("#emergencyUnit").hide();
		// 			$("#newEnergencyField").html(response);
		// 			// progressBar();
		// 		}
		// 	});
		// }

		function checkEmergency(){
			var userID=$("#user_id").val();
			var check="checkEmergencyExist";
			$.ajax({
				url: "reports/emergencyAction.php",
				type: "POST",
				data: {
					userID: userID,
					check: check
				},
				success: function (response) {
					$("#newEnergencyField").html(response);
					$("#mapView").hide();
					progressBar();
				}
			});
		}
		setInterval(function (){
			checkEmergency();

		}, 3000);

		// setInterval(function (){
		// 	checkFeedback();

		// }, 3000);

		setInterval(function () {
			getLocation();
		},1000);
		setInterval(function () {
			loactionUpdate();
		},1500);
	});
</script>

