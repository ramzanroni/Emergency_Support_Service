<?php
session_start();
unset($_SESSION['admin_username']);
if (!isset($_SESSION['admin_username'])) 
{
	header("Location: http://localhost/Emergency_Support_Service/admin");
}
else
{
	echo "Seeion don't destroy";
}

?>