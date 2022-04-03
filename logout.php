<?php
include "libs/db_conn.php";
session_start();
$deleteLiveUser=mysqli_query($conn, "DELETE FROM `live_users` WHERE `id`='".$_SESSION['userId']."' AND `userName`='".$_SESSION['user_name']."'");
if($deleteLiveUser)
{
	unset($_SESSION['user_name'], $_SESSION['firstName'], $_SESSION['emailAddress'], $_SESSION['userId']);
	if(!isset($_SESSION['user_name']))
	{
		header("Location: http://localhost/Emergency_Support_Service");
	}
	else
	{
		echo "Session don't destroy..!";
	}
}

?>