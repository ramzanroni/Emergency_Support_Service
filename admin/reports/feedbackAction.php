<?php
session_start();
include "../../libs/db_conn.php";
if ($_POST['check']=="feedbackView") 
{
	$feedbackID=$_POST['feedbackId'];
	$feedbacks=mysqli_query($conn, "SELECT * FROM `emergency_feedback` WHERE `emergency_id`='".$feedbackID."'");
	while ($feedbackRow=mysqli_fetch_assoc($feedbacks)) 
	{
		$emergencyData=mysqli_query($conn, "SELECT users.firstName AS 'userName', emergency.message AS 'message', emergency.image as 'file', supervisors.firstName AS 'supervisorName', users.phoneNumber AS 'userPhone', supervisors.phoneNumber AS 'supervisorPhone', services.service_name AS 'serviceName' FROM `emergency` INNER JOIN users ON emergency.user_id=users.id INNER JOIN supervisors ON supervisors.id=emergency.supervisor_id INNER JOIN services ON services.id=emergency.service_id WHERE emergency.id='".$feedbackID."'");
		while ($emergencyDataRow=mysqli_fetch_assoc($emergencyData)) 
		{
			?>
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead class="bg-danger">
						<tr>
							<th>Service Name</th>
							<th>Reaction</th>
							<th>Message</th>
							<th>Feedback</th>
							<th>File</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $emergencyDataRow['serviceName']; ?></td>
							<td><?php echo $feedbackRow['reaction']; ?></td>
							<td><?php echo $emergencyDataRow['message']; ?></td>
							<td><?php echo $feedbackRow['feedback']; ?></td>
							<td>
								<?php
								if ($emergencyDataRow['file']!='') 
								{
									?>
									<a href="../<?php echo $emergencyDataRow['file']; ?>" download>
										<i class="fas fa-cloud-download-alt "></i>
									</a>
									<?php
								}
								?>
							</td>

						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			<?php
		}
	}
}
?>