<?php 
session_start();
include "../../libs/db_conn.php";

if ($_POST['check']=="deactiveUser") 
{
	$status=$_POST['status'];
	$id=$_POST['id'];
	$deactiveUser=mysqli_query($conn, "UPDATE `users` SET `status`='$status' WHERE `id`='$id'");
	if ($deactiveUser) 
	{
		echo "success";
	}
	else
	{
		echo "Something is wrong...!";
	}
}

?>