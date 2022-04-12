<?php
session_start();
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" id="district_area">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Live Supervisor List</h3>
				</div>
				<div class="card-body">
					<table id="supervisorTbl" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Phone Number</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email Address</th>
								<th>User Name</th>
								<th>Date of Birth</th>
								<th>NID/Passport No</th>
								<th>District</th>
								<th>Upazila</th>
								<th>Service Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$supervisorData="SELECT live_supervisors.*, district.district_name AS 'district',services.service_name as 'serviceName', upazila.upazila_name AS 'upazila' FROM live_supervisors INNER JOIN district ON live_supervisors.supervisorDistrict = district.id INNER JOIN upazila ON live_supervisors.superviorUpazila = upazila.id INNER JOIN services ON live_supervisors.serviceArea=services.id";
							$supervisorDataResult=mysqli_query($conn, $supervisorData);
							$sl=0;
							while($rowSupervisor=mysqli_fetch_assoc($supervisorDataResult))
							{
								?>
								<tr>
									<td><?php echo ++$sl; ?></td>
									<td><?php echo $rowSupervisor['phoneNumber']; ?></td>
									<td><?php echo $rowSupervisor['firstName']; ?></td>
									<td><?php echo $rowSupervisor['lastName']; ?></td>
									<td><?php echo $rowSupervisor['emailAddress']; ?></td>
									<td><?php echo $rowSupervisor['userName']; ?></td>
									<td><?php echo $rowSupervisor['dateOfBirth']; ?></td>
									<td><?php echo $rowSupervisor['nidPassport']; ?></td>
									<td><?php echo $rowSupervisor['district']; ?></td>
									<td><?php echo $rowSupervisor['upazila']; ?></td>
									<td><?php echo $rowSupervisor['serviceName']; ?></td>

									<td>
										<?php
										if($rowSupervisor['status']==1)
										{
											?>
											<a href="#" onclick="deactiveSupervisor(<?php echo $rowSupervisor['id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></a>
											<?php
										}
										else
										{
											?>
											<a href="#" onclick="activeSupervisor(<?php echo $rowSupervisor['id']; ?>)" class="btn btn-warning btn-sm"><i class="fas fa-check-circle"></i></a>
											<?php
										}
										?>
									</td>
								</tr>
								<?php
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
</script>