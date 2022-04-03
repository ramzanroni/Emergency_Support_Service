<?php
    include "libs/db_conn.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ESS</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="js/index.js"></script> 
</head>
<body class="hold-transition register-page">
	<div class="container">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="index.php" class="h1"><b>Emergency</b> Support Service</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Register a new membership</p>

				<form method="post" >
					<div class="row">
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Phone Number</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="phoneNumber" placeholder="Enter Your Phone Number">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-mobile"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">OTP</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="phoneOTP" onkeyup="otpValidation(this.value)" placeholder="Enter Verification Code">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-mobile-alt"></span>
									</div>
								</div>
							</div>
							<small id="otpError" class="form-text text-warning"></small>
						</div>
					</div>
					<a href="#" id="verifyBtn" type="button" class="btn btn-block btn-outline-info" onclick="verifyPhone()">Send Code</a>
					<div class="row" id="informationSection">
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">First Name</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user-check"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Last Name</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user-check"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Email</label>
							<div class="input-group mb-3">
								<input type="email" class="form-control" id="emailAddress" placeholder="Enter Email Address">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-envelope-open-text"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">User Name</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="userName" placeholder="Enter User Name">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user-check"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Password</label>
							<div class="input-group mb-3">
								<input type="password" class="form-control" id="password" placeholder="password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-key"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Re-Password</label>
							<div class="input-group mb-3">
								<input type="password" class="form-control" id="rePassword" onkeyup="passwordValidation(this.value)"  placeholder="password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-key"></span>
									</div>
								</div>
							</div>
							<small id="passwordError" class="form-text text-warning"></small>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Date of Birth</label>
							<div class="input-group mb-3">
								<input type="date" class="form-control" id="dateOfBirth" placeholder="">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-calendar-week"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">NID/Passport</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="nidPassport" placeholder="Enter NID/Passport Number">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-passport"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">District</label>
							<div class="input-group mb-3">
								<select class="form-control" id="userDistrict" onchange="upazilaFind(this.value)">
									<option selected value="">Select District</option>
									<?php
									$district=mysqli_query($conn, "SELECT * FROM `district`");
									while($districtRow=mysqli_fetch_assoc($district))
									{
										?>
										<option value="<?php echo $districtRow['id']; ?>"><?php echo $districtRow['district_name']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<label for="exampleInputEmail1">Upazila</label>
							<div class="input-group mb-3" id="userUpazilaArea">
								<select class="form-control" id="superviorUpazila">
									<option vlaue="">Select Upazila</option>
								</select>
							</div>
						</div>	
                        <input type="button" class="btn btn-primary float-right" onclick="userInfo()" value="Send">					
					</div>
                    
					<input type="hidden" id="latitudeVal">
					<input type="hidden" id="longitudeVal">
				</form>

				<a href="index.php" class="text-center">I already have a membership</a>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
</body>
</html>

<script>
$( document ).ready(function() {
    getLocation();
    $("#informationSection").hide();
    $("select").select2({
        theme: 'bootstrap4',
      allowClear: true,
      width: '100%'
  });
});
</script>
