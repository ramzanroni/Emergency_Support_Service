<?php
session_start();
include "../libs/db_conn.php";
if ($_POST['check']=="openEmergencyBoxData") 
{
	$serviceID=$_POST['serviceID'];
	$latitudeVal=$_POST['latitudeVal'];
	$longitudeVal=$_POST['longitudeVal'];
	?>
	
	<!DOCTYPE html>

	<html>

	<head>
		<title>Moveable Locator</title>
		<style type="text/css">
			#map {
				width: 100%;
				height: 200px;
			}
		</style>
		<!-- <script src="js/index.js"></script>  -->
	</head>
	<body> 
		<div id="map"></div>
		<input type="hidden" name="latValue" id="latValue" value="<?php echo $latitudeVal; ?>">
		<input type="hidden" name="lonValue" id="lonValue" value="<?php echo $longitudeVal; ?>">
		<input type="hidden" name="serviceID" id="serviceID" value="<?php echo $serviceID; ?>">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form enctype="multipart/form-data">
						<div class="card-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Message<span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" id="message" name="message" placeholder="Enter Your Message"></textarea>
							</div>
							<div class="form-group">
								<label>Additional Phone Number</label>
								<input type="text" class="form-control" name="addPhone" id="addPhone" placeholder="Enter Additional Phone Number">
							</div>
							<div class="form-group col-md-4 float-left">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="file1" name="file1">
										<label class="custom-file-label" for="exampleInputFile">Choose file</label>
									</div>
								</div>
							</div>
							<!-- <div class="form-group col-md-4 float-left">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="file2" name="file2">
										<label class="custom-file-label" for="exampleInputFile">Choose file</label>
									</div>
								</div>
							</div>
							<div class="form-group col-md-4 float-left">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="file3" name="file3">
										<label class="custom-file-label" for="exampleInputFile">Choose file</label>
									</div>
								</div>
							</div> -->
						</div>

						<div class="card-footer">
							<button type="button" onclick="requestSupport()" class="btn btn-primary">Submit</button>
						</div>
					</form>
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
</body>
</html>
<?php

}

if ($_POST['check']=="checkEmergencyExist") 
{
	$userID=$_POST['userID'];
            // $userID=1;
	$newEmergencySQL=mysqli_query($conn, "SELECT * FROM `emergency` WHERE `user_id`='$userID' AND `status` !='Complete'");
	$checkEmergency=mysqli_num_rows($newEmergencySQL);
	if ($checkEmergency>0) 
	{
		$newEmergencyInfo=mysqli_fetch_assoc($newEmergencySQL);
		// $checkStatus=mysqli_query($conn, "SELECT * FROM `emergency_history` WHERE `emergency_id`='".$newEmergencyInfo['id']."' AND `user_id`='$userID'");
		?>

		<div class="col-md-12">
			<style type="text/css">

				.card {
					z-index: 0;
					border: none;
					position: relative
				}
				.fs-title {
					font-size: 25px;
					color: #dc3545;
					margin-bottom: 15px;
					font-weight: normal;
					text-align: left
				}
				.purple-text {
					color: #dc3545;
					font-weight: normal
				}
				.steps {
					font-size: 25px;
					color: gray;
					margin-bottom: 10px;
					font-weight: normal;
					text-align: right
				}
				.fieldlabels {
					color: gray;
					text-align: left
				}
				#progressbar {
					margin-bottom: 30px;
					overflow: hidden;
					color: lightgrey
				}
				#progressbar .active {
					color: #dc3545
				}
				#progressbar li {
					list-style-type: none;
					font-size: 15px;
					width: 25%;
					float: left;
					position: relative;
					font-weight: 400
				}
				#progressbar #account:before {
					font-family: FontAwesome;
					content: "\f13e"
				}
				#progressbar #personal:before {
					font-family: FontAwesome;
					content: "\f110"
				}#progressbar #finish:before {
					font-family: FontAwesome;
					content: "\f058"
				}

				#progressbar li:before {
					width: 50px;
					height: 50px;
					line-height: 45px;
					display: block;
					font-size: 20px;
					color: #ffffff;
					background: lightgray;
					border-radius: 50%;
					margin: 0 auto 10px auto;
					padding: 2px
				}
				#progressbar li:after {
					content: '';
					width: 100%;
					height: 2px;
					background: lightgray;
					position: absolute;
					left: 0;
					top: 25px;
					z-index: -1
				}
				#progressbar li.active:before,
				#progressbar li.active:after {
					background: #dc3545
				}
				.progress {
					height: 20px
				}
				.progress-bar {
					background-color: #dc3545
				}
				.fit-image {
					width: 100%;
					object-fit: cover
				}
			</style>
			<?php
			// while ($emergencyData=mysqli_fetch_assoc($checkStatus)) 
			// {
				?>
				<input type="hidden" name="comStatus" id="comStatus" value="<?php echo $newEmergencyInfo['status']; ?>">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-1 mb-1">
							<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
								<!-- progressbar -->
								<ul id="progressbar">
									<li  class="active" id="account"><strong>New</strong></li>
									<li id="personal"><strong>Action</strong></li>
									<li id="finish"><strong>Finish</strong></li>
								</ul>                           
							</div>
						</div>
					</div>
				</div>

				<?php
			// }
			?>
		</div>
		<?php
	}
}
?>