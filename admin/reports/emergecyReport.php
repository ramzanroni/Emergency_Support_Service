<?php
session_start();
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" id="district_area">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Supervisors</h3>
				</div>
				<div class="card-body">
					<table id="supervisorTbl" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Service Name</th>
								<th>User Name</th>
								<th>User Phone</th>
								<th>Optional Phone</th>
								<th>Supervisor Name</th>
								<th>Supervisor Phone</th>
								<th>Status</th>
								<th>Date</th>
								<th>History</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$emergencyData=mysqli_query($conn, "SELECT emergency.id AS 'emergencyID', emergency.message AS 'message', emergency.optional_mobile AS 'otherPhone', emergency.image AS 'image', emergency.status AS 'status', emergency.date AS 'date', users.firstName AS 'name', users.phoneNumber AS 'userPhone', supervisors.firstName AS 'supervisorName', supervisors.phoneNumber AS 'supervisorPhone', services.service_name AS 'serviceName' FROM `emergency` INNER JOIN users ON users.id=emergency.user_id INNER JOIN supervisors ON supervisors.id=emergency.supervisor_id INNER JOIN services ON services.id=emergency.service_id ORDER BY emergency.id DESC");
							while ($emergencyRow=mysqli_fetch_assoc($emergencyData)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $emergencyRow['serviceName']; ?></td>
									<td><?php echo $emergencyRow['name']; ?></td>
									<td><?php echo $emergencyRow['userPhone']; ?></td>
									<td><?php echo $emergencyRow['otherPhone']; ?></td>
									<td><?php echo $emergencyRow['supervisorName']; ?></td>
									<td><?php echo $emergencyRow['supervisorPhone']; ?></td>
									<td><?php echo $emergencyRow['status']; ?></td>
									<td><?php echo $emergencyRow['date']; ?></td>
									<td><a href="#" class="btn btn-success btn-sm" onclick="emergencyHisotoryView(<?php echo $emergencyRow['emergencyID']; ?>,'<?php echo $emergencyRow['message']; ?>')">History</a></td>
								</tr>
								<?php
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

<div class="modal fade" id="emergencyHistoryView">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Emergency History</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="emergencyHistoryData">

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
	
</script>