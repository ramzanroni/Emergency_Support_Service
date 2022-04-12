<?php
session_start();
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" id="district_area">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Supervisor Activity</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Supervisor Name</th>
								<th>Event Name</th>
								<th>Event Time</th>
								<th>Last Active Time</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$supervisorActivity=mysqli_query($conn, "SELECT * FROM `history_supervisor` ORDER BY `id` DESC ");
							while ($supervisorActivityRow=mysqli_fetch_assoc($supervisorActivity)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $supervisorActivityRow['super_name']; ?></td>
									<td><?php 
									if ($supervisorActivityRow['login_status']=='login') {
										?>
										<p class="btn btn-success btn-sm">Login</p>
										<?php
									}
									else{
										?>
										<p class="btn btn-danger btn-sm">Logout</p>
										<?php
									}

									?></td>
									<td><?php echo $supervisorActivityRow['date']; ?></td>
									<td>
										<?php
										if ($supervisorActivityRow['login_status']=='login') {
											echo "---";
										}
										else
										{
											$lastLogin=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `date` FROM `history_supervisor` WHERE `login_status`='login' AND `sessionID`='".$supervisorActivityRow['sessionID']."' ORDER BY date ASC LIMIT 1"));
											$lastLoginTime=strtotime($lastLogin['date']);
											$lastLogout=strtotime($supervisorActivityRow['date']);
											$difference = abs($lastLogout - $lastLoginTime);
											echo gmdate('H:i:s',$difference);
										}
										?>
									</td>
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