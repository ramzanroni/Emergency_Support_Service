<?php 
$conn= new mysqli("localhost", "root", "", "emergency_support_service");
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>