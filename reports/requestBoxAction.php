<?php
session_start();
error_reporting(0);
include "../libs/db_conn.php";

function callApi($sendernumber, $mysms) {
	$sender_id = '8809612117722';
	$url = "http://sms.viatech.com.bd/smsapi?api_key=C200129761e80403eea316.03567292&type=text&contacts=".$sendernumber."&senderid=".$sender_id."&msg=".urlencode($mysms);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return true;
}


if ($_POST['check']=="makeRequest") 
{
	$latValue=$_POST['latValue'];
	$lonValue=$_POST['lonValue'];
	if ($_POST['message']!='') {
		$message=$_POST['message'];
	}
	else
	{
		$message=' ';
	}
	if ($_POST['addPhone']!='') {
		$addPhone=$_POST['addPhone'];
	}
	else
	{
		$addPhone=' ';
	}
	$serviceID=$_POST['serviceID'];
	// echo $file1=$_FILES['file1']['name'];
	// echo $file2=$_FILES['file2']['name'];
	// echo $file3=$_FILES['file3']['name'];
	
	// $ext_file2 = pathinfo($file2, PATHINFO_EXTENSION);
	// $ext_file3 = pathinfo($file3, PATHINFO_EXTENSION);
	
	if ($_FILES['file1']['name']!='') {
		$file1=$_FILES['file1']['name'];
		$ext_file1 = pathinfo($file1, PATHINFO_EXTENSION);
		$allwoed_extention = array('png', 'jpg','JPEG','PNG','GIF','jpeg','JPG');
		if(in_array($ext_file1, $allwoed_extention)){
			
			if ($_FILES['file1']['size'] < 104857600) {
				$newfilename1 = round(microtime(true)) . '.' . $ext_file1;
				$upload = move_uploaded_file($_FILES['file1']['tmp_name'], "../images/".$newfilename1);
				$imageName1="images/".$newfilename1;
			}
		}
	}
	else
	{
		$imageName1=' ';
	}

	//distance calculator

	$distanceArray=array();
	$serviceUser=mysqli_query($conn, "SELECT * FROM `supervisors` WHERE `serviceArea`='$serviceID'");
	while ($rowServiceUser=mysqli_fetch_assoc($serviceUser)) 
	{
		$latitude1=$rowServiceUser['latitude'];
		$longitude1=$rowServiceUser['longitude'];
		$latitude2 = $latValue; 
		$longitude2 = $lonValue;  

      //Converting to radians
		$longi1 = deg2rad($longitude1); 
		$longi2 = deg2rad($longitude2); 
		$lati1 = deg2rad($latitude1); 
		$lati2 = deg2rad($latitude2); 

      //Haversine Formula 
		$difflong = $longi2 - $longi1; 
		$difflat = $lati2 - $lati1; 

		$val = pow(sin($difflat/2),2)+cos($lati1)*cos($lati2)*pow(sin($difflong/2),2); 

      	$res1 =3936* (2 * asin(sqrt($val))); //for miles
    	$res2 =6378.8 * (2 * asin(sqrt($val))); //for kilometers
    	$distanceData=array(
    		"user_id"=>$rowServiceUser['id'],
    		"distance"=>$res2
    	);
    	array_push($distanceArray, $distanceData); 
    }
    $minDistance = min(array_column($distanceArray, 'distance'));
    foreach ($distanceArray as $key => $value) {
    	if ($value['distance']==$minDistance) {
    		$SupervisorUserId=$value['user_id'];
    	}
    }
    $addEmergency=mysqli_query($conn, "INSERT INTO `emergency`( `user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`) VALUES ('".$_SESSION['userId']."','".$latValue."','".$lonValue."','".$SupervisorUserId."','".$serviceID."','".$message."','".$addPhone."','".$imageName1."','New')");
    $last_id = $conn->insert_id;


    $addEmergencyHistory=mysqli_query($conn, "INSERT INTO `emergency_history`(`emergency_id`,`user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`) VALUES ('$last_id','".$_SESSION['userId']."','".$latValue."','".$lonValue."','".$SupervisorUserId."','".$serviceID."','".$message."','".$addPhone."','".$imageName1."','New')");
    $supervisorPhone=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `phoneNumber`, `firstName` FROM `supervisors` WHERE `id`='$SupervisorUserId'"));
    if ($addEmergency && $addEmergencyHistory) {
    	$msg="Your emergency successfully send the assigned person. Your emergency ID: ".$last_id;

    	// $msg="route=".$latitude1."%2C".$longitude1;
    	$send = callApi($_SESSION['userPhone'], $msg);
    	if ($send==true) 
    	{
    		echo "success";    
    	}
    }
    else
    {
    	echo "Something is wrong..!";
    }

}


?>