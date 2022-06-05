<?php
session_start();
include "../../libs/db_conn.php";
$selectEmergency=mysqli_query($conn, "SELECT * FROM emergency WHERE date < (NOW() - INTERVAL 1 MINUTE) AND status='New'");
while ($emergencyRow=mysqli_fetch_assoc($selectEmergency)) 
{
	echo $latValue=$emergencyRow['lat'];
	echo $lonValue=$emergencyRow['lon'];
	$distanceArray=array();
	$serviceUser=mysqli_query($conn, "SELECT * FROM `supervisors` WHERE `serviceArea`='".$emergencyRow['service_id']."' AND `id` != '".$emergencyRow['supervisor_id']."'  AND status=1");
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

  //     //Haversine Formula 
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
   $updateAssign=mysqli_query($conn, "UPDATE `emergency` SET `supervisor_id`='$SupervisorUserId', `date`=NOW() WHERE `id`='".$emergencyRow['id']."'");
   if ($updateAssign) 
   {
   	# code...
   }
}
?>
