<?php
session_start();
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" id="district_area">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Emergencies Feedback</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Service Name</th>
								<th>User Name</th>
								<th>User Phone</th>
								<th>Supervisor Name</th>
								<th>Supervisor Phone</th>
								<th>Reaction</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$feedbacks=mysqli_query($conn, "SELECT * FROM `emergency_feedback`");
							while ($feedbackRow=mysqli_fetch_assoc($feedbacks)) 
							{
								$emergencyData=mysqli_query($conn, "SELECT users.firstName AS 'userName', supervisors.firstName AS 'supervisorName', users.phoneNumber AS 'userPhone', supervisors.phoneNumber AS 'supervisorPhone', services.service_name AS 'serviceName' FROM `emergency` INNER JOIN users ON emergency.user_id=users.id INNER JOIN supervisors ON supervisors.id=emergency.supervisor_id INNER JOIN services ON services.id=emergency.service_id WHERE emergency.id='".$feedbackRow['emergency_id']."'");
								while ($emergencyDataRow=mysqli_fetch_assoc($emergencyData)) 
								{
									?>
									<tr>
										<td><?php echo $sl; ?></td>
										<td><?php echo $emergencyDataRow['serviceName']; ?></td>
										<td><?php echo $emergencyDataRow['userName']; ?></td>
										<td><?php echo $emergencyDataRow['userPhone']; ?></td>
										<td><?php echo $emergencyDataRow['supervisorName']; ?></td>
										<td><?php echo $emergencyDataRow['supervisorPhone']; ?></td>
										<td><?php echo $feedbackRow['reaction']; ?></td>
										<td><?php 
										if ($feedbackRow['reaction']=="Highly Satisfied" || $feedbackRow['reaction']=="Satisfied" || $feedbackRow['reaction']=="Avarage") {
											?>
											<a href="#" onclick="viewFeedback(<?php echo $feedbackRow['emergency_id']; ?>)" class="btn btn-success btn-sm">View</a>
											<?php
										}
										else
										{
											?>
											<a href="#" onclick="viewFeedback(<?php echo $feedbackRow['emergency_id']; ?>)" class="btn btn-danger btn-sm">View</a>
											<?php
										}
										?></td>
										
									</tr>
									<?php
								}
								$sl++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="feedbackModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Feedback</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="feedbackData">

			</div> 
		</div>
	</div>
</div>
<script>
	$(function () {
		$("table").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
	function viewFeedback(feedbackId)
	{
		$('#feedbackModal').modal('show');
		var check="feedbackView";
		$.ajax({
        url: "reports/feedbackAction.php",
        type: "POST",
        data: {
            check: check,
            feedbackId: feedbackId
        },
        success: function (response) {
            $("#feedbackData").html(response);
        }
    });
	}
</script>