<?php
include "../libs/db_conn.php";
session_start();
$deleteLiveSupervisor=mysqli_query($conn, "DELETE FROM `live_supervisors` WHERE `id`='".$_SESSION['userId']."' AND `userName`='".$_SESSION['supervisorUsername']."'");
$supervisorHistoryRecord=mysqli_query($conn, "INSERT INTO `history_supervisor`(`supervisor_id`, `super_name`, `login_status`) VALUES ('".$_SESSION['userId']."','".$_SESSION['firstName']."','logout')");
if($deleteLiveSupervisor && $supervisorHistoryRecord)
{
	unset($_SESSION['supervisorUsername'], $_SESSION['firstName'], $_SESSION['serviceArea'], $_SESSION['userId']);
	if(!isset($_SESSION['supervisorUsername']))
	{
		header("Location: http://localhost/Emergency_Support_Service/supervisor");
	}
	else
	{
		echo "Session don't destroy..!";
	}
}

?>