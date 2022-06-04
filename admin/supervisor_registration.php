<?php
include "../libs/db_conn.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emergency Support Service</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">



	<!-- javascript function -->
	<script src="js/admin.js"></script> 
</head>
<body class="hold-transition login-page">
	<div class="container">
		<?php
		if(isset($_GET['token']))
		{
			date_default_timezone_set("Asia/Dhaka");
			$currentDate =date("Y-m-d h:i:s");
			$token=$_GET['token'];
			$supervisorID=$_GET['id'];
			$tokenData=mysqli_query($conn, "SELECT * FROM `supervisor_token` WHERE `token`='$token' AND `supervisor_id`='$supervisorID'");
			$tokenCount=mysqli_num_rows($tokenData);
			if($tokenCount<1)
			{
				?>
				<div class="col-md-12 align-self-center justify-content-center">
					<div class="alert alert-danger pt-3 pb-3 align-self-center h3" style="position" role="alert">
						Your provided token not Valid therefore you can not access our system!!!! Please go out from our system...!
					</div>
				</div>
				<?php
			}
			else
			{
				$tokenRow=mysqli_fetch_assoc($tokenData);
				$tokenCreateDate=$tokenRow['date'];
				$minutes = (strtotime($currentDate)-strtotime($tokenCreateDate)) / (60*60);

				$time = new DateTime($tokenCreateDate);
				$diff = $time->diff(new DateTime());
				$minutes = ($diff->days * 24 * 60) +($diff->h * 60) + $diff->i;
				if($minutes<=500)
				{
					?>
					<div class="col-md-12">
						<div class="card card-outline card-primary">
							<div class="card-header text-center">
								<a href="index.php" class="h1">Emergency Support Service</a>
							</div>
							<div class="card-body">
								<p class="login-box-msg">Supervisor Registration</p>

								<!-- <form method="post"> -->
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
                                                <select class="form-control" id="supervisorDistrict" onchange="upazilaFind(this.value)">
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
											<div class="input-group mb-3" id="supervisorUpazilaArea">
                                                <select class="form-control" id="superviorUpazila">
                                                    <option vlaue="">Select Upazila</option>
                                                </select>
											</div>
										</div>
                                        <div class="col-md-12 float-left">
                                            <label for="exampleInputEmail1">Service Type</label>
											<div class="input-group mb-3">
                                                <select class="form-control" id="serviceArea">
                                                    <option selected value="">Select Service Area</option>
                                                    <?php
                                                        $services=mysqli_query($conn, "SELECT * FROM `services` WHERE `status`='1' AND `id`='$supervisorID'");
                                                        while($serviceRow=mysqli_fetch_assoc($services))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $serviceRow['id']; ?>"><?php echo $serviceRow['service_name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
											</div>
										</div>
                                        <button class="btn btn-primary float-right" onclick="supervisorInfo()">Send<i class="far fa-paper-plane"></i></button>
									</div>
                                    <input type="hidden" id="latitudeVal">
                                    <input type="hidden" id="longitudeVal">
                                    
								<?php
							}
							else
							{
								?>
								<div class="col-md-12 align-self-center justify-content-center">
									<div class="alert alert-danger pt-3 pb-3 align-self-center h3" style="position" role="alert">
										Your Session time up!! therefore you can not access our system!!!! Please go out from our system...!
									</div>
								</div>
								<?php
							}
						}
					}
					else
					{
						?>
						<div class="col-md-12 align-self-center justify-content-center">
							<div class="alert alert-danger pt-3 pb-3 align-self-center h3" style="position" role="alert">
								Your are not Valid person to access our system!!!! Please go out from our system...!
							</div>
						</div>

						<?php
					}
					?>
				</div>

				<!-- jQuery -->
				<script src="../plugins/jquery/jquery.min.js"></script>
				<!-- Bootstrap 4 -->
				<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
				<!-- AdminLTE App -->
				<script src="../dist/js/adminlte.min.js"></script>
				<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
				<script src="../plugins/toastr/toastr.min.js"></script>
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
function error_alert(title, type) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
    Toast.fire({
        icon: type,
        title: title
    })
};
function verifyPhone()
{
    var phoneNumber=$("#phoneNumber").val();
    var check="checkPhoneOTP";
    $.ajax({
        url: "reports/supervisorAction.php",
        type: "POST",
        data: {
            phoneNumber: phoneNumber,
            check: check
        },
        success: function (response) {
            if(response=='success')
            {
                error_alert("OTP Send Successfully..","success");
            }
            else
            {
                error_alert("Something is wrong..!","error"); 
            }
        }
    });
}
function otpValidation(otp)
{
    var phoneNumber=$("#phoneNumber").val();
    var check="otpCheck";
    $.ajax({
        url: "reports/supervisorAction.php",
        type: "POST",
        data: {
            otp: otp,
            phoneNumber:phoneNumber,
            check: check
        },
        success: function (response) {
            if(response=='success')
            {
                error_alert("Valid OTP..","success");
                $("#otpError").html('')
                $("#verifyBtn").hide();
                $("#informationSection").show();
            }
            else
            {
                $("#otpError").html(response); 
                $("#verifyBtn").show();
                $("#informationSection").hide();
            }
        }
    });
}

function passwordValidation(rePassword)
{
    var password=$("#password").val();
    if(rePassword!=password)
    {
        $("#passwordError").html("Invalid Password");
    }
    else
    {
        $("#passwordError").html('');
    }
}


function upazilaFind(district)
{
    var check="findUpazila";
    $.ajax({
        url: "reports/supervisorAction.php",
        type: "POST",
        data: {
            district: district,
            check: check
        },
        success: function (response) {
            $("#supervisorUpazilaArea").html(response);
        }
    });
}


// supervisorInfo
function supervisorInfo()
{
    var phoneNumber=$("#phoneNumber").val();
    var firstName=$("#firstName").val();
    var lastName=$("#lastName").val();
    var emailAddress=$("#emailAddress").val();
    var nidPassport=$("#nidPassport").val();
    var supervisorDistrict=$("#supervisorDistrict").val();
    var superviorUpazila=$("#superviorUpazila").val();
    var serviceArea=$("#serviceArea").val();
    var latitudeVal=$("#latitudeVal").val();
    var longitudeVal=$("#longitudeVal").val();
    var userName=$("#userName").val();
    var password=$("#password").val();
    var rePassword=$("#rePassword").val();
    var dateOfBirth=$("#dateOfBirth").val();
    var passwordError=$("#passwordError").text();
    var flag=1;
    if(phoneNumber=="")
    {
        $("#phoneNumber").css({"border": "1px solid red"});
        flag=0;
    }
    if(firstName=="")
    {
        $("#firstName").css({"border": "1px solid red"});
        flag=0;
    }
    if(lastName=="")
    {
        $("#lastName").css({"border": "1px solid red"});
        flag=0;
    }
    if(emailAddress=="")
    {
        $("#emailAddress").css({"border": "1px solid red"});
        flag=0;
    }
    if(nidPassport=="")
    {
        $("#nidPassport").css({"border": "1px solid red"});
        flag=0;
    }
    if(supervisorDistrict=="")
    {
        $("#supervisorDistrict").css({"border": "1px solid red"});
        flag=0;
    }
    if(superviorUpazila=="")
    {
        $("#superviorUpazila").css({"border": "1px solid red"});
        flag=0;
    }
    if(serviceArea=="")
    {
        $("#serviceArea").css({"border": "1px solid red"});
        flag=0;
    }
    if(userName=="")
    {
        $("#userName").css({"border": "1px solid red"});
        flag=0;
    }
    if(password=="")
    {
        $("#password").css({"border": "1px solid red"});
        flag=0;
    }
    if(rePassword=="")
    {
        $("#rePassword").css({"border": "1px solid red"});
        flag=0;
    }
    if(dateOfBirth=="")
    {
        $("#dateOfBirth").css({"border": "1px solid red"});
        flag=0;
    }
    if(passwordError != "")
    {
        flag=0;
    }
    if(flag==1)
    {
        var check="insertSupervisor";
        $.ajax({
            url: "reports/supervisorAction.php",
            type: "POST",
            data: {
                phoneNumber: phoneNumber,
                firstName:firstName,
                lastName:lastName,
                emailAddress:emailAddress,
                userName:userName,
                password:password,
                dateOfBirth:dateOfBirth,
                nidPassport:nidPassport,
                supervisorDistrict:supervisorDistrict,
                superviorUpazila:superviorUpazila,
                serviceArea:serviceArea,
                latitudeVal:latitudeVal,
                longitudeVal:longitudeVal,
                check: check
            },
            success: function (response) {
                if(response=="success")
                {
                    error_alert("Supervisor Registration Success..","success");
                    $("#phoneNumber").val('');
                    $("#firstName").val('');
                    $("#lastName").val('');
                    $("#emailAddress").val('');
                    $("#nidPassport").val('');
                    $("#supervisorDistrict").val('');
                    $("#superviorUpazila").val('');
                    $("#serviceArea").val('');
                    $("#latitudeVal").val('');
                    $("#longitudeVal").val('');
                    $("#userName").val('');
                    $("#password").val('');
                    $("#rePassword").val('');
                    $("#dateOfBirth").val('');
                }
                else
                {
                    error_alert("Something is wrong..!","error");
                }
            }
        });
    }    
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    $("#latitudeVal").val(position.coords.latitude);
    $("#longitudeVal").val(position.coords.longitude);
}

</script>
