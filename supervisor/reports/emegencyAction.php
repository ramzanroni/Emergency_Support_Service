<?php 
session_start();
include "../../libs/db_conn.php";
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
if ($_POST['check']=='countEmergency') 
{
	$userId=$_SESSION['userId'];
	$countEmergency=mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'totalempergency' FROM `emergency` WHERE status='New' AND `supervisor_id`='".$_SESSION['userId']."'"));
	echo $countEmergency['totalempergency'];
}

if ($_POST['check']=="emergencyActionData") {
	$id=$_POST['id'];
	$newEmergencyData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT emergency.id as 'id', services.service_name AS 'service_name', users.userName AS 'userName', users.phoneNumber AS 'phoneNumber',emergency.message AS 'message', emergency.optional_mobile AS 'optional_mobile', emergency.image AS 'image', emergency.lat AS 'lat', emergency.lon AS 'lon', emergency.date AS 'date' FROM emergency JOIN users ON emergency.user_id = users.id JOIN services ON emergency.service_id = services.id JOIN supervisors ON emergency.supervisor_id = supervisors.id WHERE emergency.id='$id'"));
	?>
	<style type="text/css">
		#map {
			width: 100%;
			height: 200px;
		}
	</style>
	<div class="card card-danger">
		<div class="card-header">
			<h3 class="card-title">Emergency</h3>
		</div>
		<div class="card-body">
			<div id="map"></div>
			<input type="hidden" name="latValue" id="latValue" value="<?php echo $newEmergencyData['lat']; ?>">
			<input type="hidden" name="lonValue" id="lonValue" value="<?php echo $newEmergencyData['lon']; ?>">
			<div class="row mt-3" >
				<div class="col-md-12">
					<p class="text-center text-white pt-2 pb-2 bg-danger">Emergency Info</p>
					<table id="district" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Phone</th>
								<th>Optional Phone</th>
								<th>Service Name</th>
								<th>Message</th>
								<th>Date</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $newEmergencyData['userName']; ?></td>
								<td><?php echo $newEmergencyData['phoneNumber']; ?></td>
								<td><?php echo $newEmergencyData['optional_mobile']; ?></td>
								<td><?php echo $newEmergencyData['service_name']; ?></td>
								<td><?php echo $newEmergencyData['message']; ?></td>
								<td><?php echo $newEmergencyData['date']; ?></td>
								<td><a href="../<?php echo $newEmergencyData['image']; ?>" download>
									<i class="fas fa-cloud-download-alt "></i>
								</a></td>
								<td><p class="btn btn-primary btn-sm" onclick="getAction('<?php echo $newEmergencyData["id"]; ?>', 'Action')">Accept</p></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	function initMap() {
		var latValue=$("#latValue").val();
		var lonValue=$("#lonValue").val();
		const myLatLng = {
			lat : Number(latValue),
			lng  : Number(lonValue)
		};
		var map = new google.maps.Map(document.getElementById('map'), {
			center: myLatLng,
			zoom: 15
		});
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Hello World!',
			draggable: true
		});
		google.maps.event.addListener(marker, 'dragend', function(marker) {
			var latLng = marker.latLng;
			$("#latValue").val(latLng.lat());
			$("#lonValue").val(latLng.lng());
		});
	}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAjbn_rb7xcavM74VhIUOLjnBFbURiZXc&callback=initMap&v=weekly" async></script>
<?php

}


if ($_POST['check']=="acceptEmergency") 
{
	$emergencyId=$_POST['id'];
	$ststus=$_POST['status'];

	$updateEmergency=mysqli_query($conn, "UPDATE `emergency` SET `status`='Action'WHERE id='$emergencyId'");
	if ($updateEmergency) 
	{
		$lastUpdateData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `emergency` WHERE `id`='$emergencyId'"));
		$insertEmergencyHistory=mysqli_query($conn, "INSERT INTO `emergency_history`(`emergency_id`, `user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`) VALUES ('".$lastUpdateData['id']."','".$lastUpdateData['user_id']."','".$lastUpdateData['lat']."','".$lastUpdateData['lon']."','".$lastUpdateData['supervisor_id']."','".$lastUpdateData['service_id']."','".$lastUpdateData['message']."','".$lastUpdateData['optional_mobile']."','".$lastUpdateData['image']."','".$lastUpdateData['status']."')");
		if ($insertEmergencyHistory) 
		{
			$emergencyInfo=mysqli_fetch_assoc(mysqli_query($conn, "SELECT emergency.id as 'id', emergency.lat as 'lat', emergency.lon as 'lon', supervisors.latitude as 'latitude',  supervisors.longitude as 'longitude', supervisors.userName AS 'userName', supervisors.phoneNumber as 'superphoneNumber', users.phoneNumber AS 'phoneNumber' FROM emergency JOIN supervisors ON emergency.supervisor_id = supervisors.id  JOIN users ON emergency.user_id = users.id WHERE emergency.id='".$lastUpdateData['id']."'"));

			$msg="Your emergency Issue accept by- ".$emergencyInfo['userName'].". Supervisor phone number- ".$emergencyInfo['superphoneNumber'].".  Please visit this URL for view the direction: https://www.openstreetmap.org/directions?engine=graphhopper_foot&route=".$emergencyInfo['lat']."%2C".$emergencyInfo['lon']."%3B".$emergencyInfo['latitude']."%2C".$emergencyInfo['longitude'];
    		$send = callApi($emergencyInfo['phoneNumber'], $msg);
    		if ($send==true) 
    		{
    			echo "success";
    		}
    		else
    		{
    			echo "Something is wrong..!";
    		}
		}
	}
	else
	{
		echo "Something is wrong...";
	}
}

if ($_POST['check']=="completeEmergency") 
{
	$emergencyId=$_POST['id'];
	$updateEmergency=mysqli_query($conn, "UPDATE `emergency` SET `status`='Complete' WHERE id='$emergencyId'");
	if ($updateEmergency) 
	{
		$lastUpdateData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `emergency` WHERE `id`='$emergencyId'"));
		$insertEmergencyHistory=mysqli_query($conn, "INSERT INTO `emergency_history`(`emergency_id`, `user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`) VALUES ('".$lastUpdateData['id']."','".$lastUpdateData['user_id']."','".$lastUpdateData['lat']."','".$lastUpdateData['lon']."','".$lastUpdateData['supervisor_id']."','".$lastUpdateData['service_id']."','".$lastUpdateData['message']."','".$lastUpdateData['optional_mobile']."','".$lastUpdateData['image']."','".$lastUpdateData['status']."')");
		if ($insertEmergencyHistory) 
		{
			$emergencyInfo=mysqli_fetch_assoc(mysqli_query($conn, "SELECT emergency.id as 'id', supervisors.userName AS 'userName', users.phoneNumber AS 'phoneNumber' FROM emergency JOIN supervisors ON emergency.supervisor_id = supervisors.id  JOIN users ON emergency.user_id = users.id WHERE emergency.id='".$lastUpdateData['id']."'"));

			$msg="Thank you for your beliveness. Stay with our system..";
    		$send = callApi($emergencyInfo['phoneNumber'], $msg);
    		if ($send==true) 
    		{
    			echo "success";
    		}
    		else
    		{
    			echo "Something is wrong..!";
    		}
		}
	}
	else
	{
		echo "Something is wrong...";
	}
}
?>