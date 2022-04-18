<?php
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
	<?php  
	$countNewEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`status`) AS 'totalNew' FROM `emergency` WHERE `status`='New'"));
	?>
	<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-danger">
				<div class="inner">
					<h3 class="text-white"><?php echo $countNewEmergency['totalNew']; ?></h3>

					<p class="text-white">New Emergency</p>
				</div>
				<div class="icon">
					<i class="far fa-calendar-plus"></i>
				</div>
				<a href="#" onclick="emergecyReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php  
		$countActionEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`status`) AS 'totalAction' FROM `emergency` WHERE `status`='Action'"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3 class="text-white"><?php echo $countActionEmergency['totalAction']; ?></h3>

					<p class="text-white">Action Emergency</p>
				</div>
				<div class="icon">
					<i class="fas fa-running"></i>
				</div>
				<a href="#" onclick="emergecyReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php  
		$countCompleteEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`status`) AS 'totalComplete' FROM `emergency` WHERE `status`='Complete'"));
		?>
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<h3 class="text-white"><?php echo $countCompleteEmergency['totalComplete']; ?></h3>

					<p class="text-white">Complete Emergency</p>
				</div>
				<div class="icon">
					<i class="far fa-check-square"></i>
				</div>
				<a href="#" onclick="emergecyReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php  
		$countEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'total' FROM `emergency`"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3 class="text-white"><?php echo $countEmergency['total']; ?></h3>

					<p class="text-white">Total Emergency</p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a href="#" onclick="emergecyReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php  
		$countSupervisor=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalSupervisor' FROM `supervisors` WHERE `status`=1"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box" style="background: #3c8dbc;">
				<div class="inner">
					<h3 class="text-white"><?php echo $countSupervisor['totalSupervisor']; ?></h3>

					<p class="text-white">Total Supervisor</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" onclick="supervisorList()"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<?php  
		$countSupervisor=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalSupervisor' FROM `live_supervisors` WHERE `status`=1"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box" style="background: #d81b60;">
				<div class="inner">
					<h3 class="text-white"><?php echo $countSupervisor['totalSupervisor']; ?></h3>

					<p class="text-white">Live Supervisor</p>
				</div>
				<div class="icon">
					<i class="fas fa-user-check"></i>
				</div>
				<a href="#" onclick="supervisorLive()"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<?php  
		$countUser=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalUser' FROM `users` WHERE `status`='1'"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box" style="background: #3d9970;">
				<div class="inner">
					<h3 class="text-white"><?php echo $countUser['totalUser']; ?></h3>

					<p class="text-white">Total User</p>
				</div>
				<div class="icon">
					<i class="fas fa-user-friends"></i>
				</div>
				<a href="#" onclick="userList()"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php  
		$LiveUser=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'liveUser' FROM `live_users`"));
		?>
		<div class="col-lg-3 col-6">
			<div class="small-box" style="background: #e83e8c;">
				<div class="inner">
					<h3 class="text-white"><?php echo $LiveUser['liveUser']; ?></h3>

					<p class="text-white">Live User</p>
				</div>
				<div class="icon">
					<i class="fas fa-user-check"></i>
				</div>
				<a href="#" onclick="liveUserList()"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- Main row -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<div class="row">


		<section class="col-lg-6 connectedSortable">
			<div class="card card-danger">
				<div class="card-header">
					<h3 class="card-title">Feedback Ratio Chart</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<canvas id="myChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
					<!-- <canvas id="myChart"></canvas> -->
				</div>
				<?php  
				$feedbackTitle=array();
				$feebackItem=array();
				$countFeedback=mysqli_query($conn, "SELECT COUNT(*) AS 'item', reaction FROM `emergency_feedback` GROUP BY reaction");
				while ($countRow=mysqli_fetch_assoc($countFeedback)) {
					$titleStr="'".$countRow['reaction']."'";
					array_push($feedbackTitle, $titleStr);
					array_push($feebackItem, $countRow['item']);
				}
				$title=implode(",",$feedbackTitle);
				$item=implode(",",$feebackItem);
				?>
			</div>
		</section>
		<script type="text/javascript">
			var feedbackName = [<?php echo $title; ?>];
			var dataElement = {
				labels: feedbackName,
				datasets: [{
					label: 'My First Dataset',
					data: [<?php echo $item; ?>],
					backgroundColor: [
					'rgb(255, 99, 132)',
					'rgb(54, 162, 235)',
					'rgb(255, 205, 86)',
					'#3d9970',
					'#d81b60'
					],
					borderColor: [
					'rgb(255, 99, 132)',
					'rgb(255, 159, 64)',
					'rgb(255, 205, 86)',
					'rgb(75, 192, 192)',
					'rgb(54, 162, 235)'
					],
					borderWidth: 1
				}]
			};
			var config1 = {
				type: 'pie',
				data: dataElement,
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'Feedback Ratio'
						}
					}
				},
			};
			var myChart = new Chart(
				document.getElementById('myChart'),
				config1
				);
			</script>
			<section class="col-lg-6 connectedSortable">
				<div class="card card-danger">
					<div class="card-header">
						<h3 class="card-title">Last Seven Days Emergency</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<canvas id="lastSevenDay" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
						<!-- <canvas id="myChart"></canvas> -->
					</div>
					<?php  
					$sevenDates=array();
					$sevenEmergencyItem=array();
					for ($i=0; $i < 7; $i++) { 
						$dateRange="-".$i." days";
						$date=date('Y-m-d', strtotime($dateRange));
						array_push($sevenDates, $date);
					}
					foreach ($sevenDates as  $value) {
						$statDate=$value." 00:00:00";
						$endDate=$value. " 23:59:59";
						$countEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalEmergency' FROM `emergency` WHERE `date`>='$statDate' AND `date`<='$endDate'"));
						array_push($sevenEmergencyItem, $countEmergency['totalEmergency']);
					}
					$dayEmergenctItem=implode(",",$sevenEmergencyItem);
					$dayName=array();
					foreach ($sevenDates as $dateItem) {
						$dayNameItem=date("l", strtotime($dateItem));
						$dayStr="'".$dayNameItem."'";
						array_push($dayName, $dayStr);
					}
					$dayEmergenctItem=implode(",",$sevenEmergencyItem);
					$dayItem=implode(",",$dayName);
					?>
				</div>
			</section>
		</div>
		<script type="text/javascript">


	// lastSevenDay
	var dateName = [<?php echo $dayItem; ?>];
	var chartData = {
		labels: dateName,
		datasets: [{
			label: 'Last 7 Days Record',
			data: [<?php echo $dayEmergenctItem; ?>],
			backgroundColor: [
			'rgb(255, 99, 132)',
			'rgb(54, 162, 235)',
			'rgb(255, 205, 86)',
			'#3d9970',
			'#d81b60',
			'#e83e8c',
			'#3c8dbc'

			],
			borderColor: [
			'rgb(255, 99, 132)',
			'rgb(255, 159, 64)',
			'rgb(255, 205, 86)',
			'rgb(255, 99, 132)',
			'rgb(255, 159, 64)',
			'rgb(255, 205, 86)',
			'rgb(255, 205, 86)'
			
			],
			borderWidth: 1
		}]
	};
	var config = {
		type: 'bar',
		data: chartData,
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Last 7 Days Emergency'
				}
			}
		},
	};
	var sevenDay = new Chart(
		document.getElementById('lastSevenDay'),
		config
		);
	</script>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		setInterval(loadDashboard, 5000);
		function loadDashboard() {
			$.ajax({
				url: "reports/admin-dashboard.php",
				success: function (result) {
					$("#content1").html(result);
				}
			});
		}
	});
</script>