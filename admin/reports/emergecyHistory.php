<?php
session_start();
include "../../libs/db_conn.php";

if ($_POST['check']=="emergencyHistory") 
{
	$emergencyID=$_POST['emergencyID'];
	$emergencyMessage=$_POST['emergencyMessage'];
	$emergencyHistoryData=mysqli_query($conn, "SELECT emergency_history.status AS 'status', emergency_history.date AS 'actionDate', users.firstName AS 'senderName', supervisors.firstName AS 'supervisorName', services.service_name AS 'serviceName'  FROM `emergency_history` INNER JOIN users ON users.id=emergency_history.user_id INNER JOIN supervisors ON supervisors.id=emergency_history.supervisor_id INNER JOIN services ON emergency_history.service_id=services.id WHERE emergency_history.emergency_id='".$emergencyID."' ORDER BY emergency_history.date DESC ");
	?>
	<div class="col-md-12">
		<div>
			
		</div>
		<div class="timeline timeline-inverse">
			
			

			<?php
			while ($emergencyHistoryRow=mysqli_fetch_assoc($emergencyHistoryData)) 
			{
				?>
				<div class="time-label">
					<span class="bg-danger">
						<?php 
						$date= date_create($emergencyHistoryRow['actionDate']);
						echo date_format($date,"d M, Y");
						 ?>
					</span>
				</div>
				<div>
					<i class="fas fa-envelope bg-primary"></i>

					<div class="timeline-item">
						<span class="time"><i class="far fa-clock"></i> <?php echo date_format($date,"Y-M-d H:i"); ?></span>

						<h3 class="timeline-header"><a href="#"><?php echo $emergencyHistoryRow['status']; ?></a> is your current emergency status.</h3>

						<div class="timeline-body">
							<p>Sender service name: <?php echo $emergencyHistoryRow['serviceName']; ?></p>
							<p>Received by: <?php echo $emergencyHistoryRow['supervisorName']; ?></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	</div>
	<?php
}

?>