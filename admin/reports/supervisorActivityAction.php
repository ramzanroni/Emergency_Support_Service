<?php
session_start();
include "../../libs/db_conn.php";
if ($_POST['check']=="userSearchActivity") 
{
	$userId=$_POST['users'];
	$date=$_POST['date'];
	$startDate=$date." 00:00:00";
	$endDate=$date." 23:59:59";
	?>
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
			$supervisorActivity=mysqli_query($conn, "SELECT * FROM `history_supervisor` WHERE `supervisor_id`='".$userId."' AND date >= '".$startDate."' AND date <= '".$endDate."' ORDER BY `id` DESC ");
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
		}

		?>