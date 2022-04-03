
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

// page loading

function userProfile() {
    $.ajax({
        url: "reports/userProfile.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}
function userEmergency() {
    $.ajax({
        url: "reports/userEmergencyHistory.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}


// check password

function checkPassword(oldPassword) {
    var userId = $("#userId").val();
    var oldPassword = oldPassword;
    var check = "checkPassword";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            userId: userId,
            oldPassword: oldPassword,
            check: check
        },
        success: function (response) {
            $("#passError").html(response);
        }
    });
}


// changePassword
function changePassword() {
    var userId = $("#userId").val();
    var reNewPassword = $("#reNewPassword").val();
    var newPassword = $("#newPassword").val();
    var oldPassword = $("#oldPassword").val();
    var oldPasswordError = $("#passError").text();
    var rePassError = $("#rePassError").text();
    var flag = 1;
    var check = "changePassword";
    if (reNewPassword == "") {
        $("#reNewPassword").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (newPassword == "") {
        $("#newPassword").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (oldPassword == "") {
        $("#oldPassword").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (oldPasswordError != "") {
        flag = 0;
    }
    if (rePassError != "") {
        flag = 0;
    }
    if (flag == 1) {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/userAction.php",
            type: "POST",
            data: {
                userId: userId,
                newPassword: newPassword,
                check: check
            },
            success: function (response) {
                if (response == "success") {
                    swal.close();
                    error_alert("Password Update Successfully..", "success");
                    $("#reNewPassword").val('');
                    $("#newPassword").val('');
                    $("#oldPassword").val('');
                }
                else {
                    error_alert(response, "error");
                }
            }
        });
    }
}

// updateUserInfo
function updateUserInfo() {
    var userIdUp = $("#userIdUp").val();
    var firstNameUp = $("#firstNameUp").val();
    var lastNameUp = $("#lastNameUp").val();
    var emailUp = $("#emailUp").val();
    var phoneUp = $("#phoneUp").val();
    var flag = 1;
    var check = "userInfoUpdate";
    if (phoneUp == "") {
        $("#phoneUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (emailUp == "") {
        $("#emailUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (lastNameUp == "") {
        $("#lastNameUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (firstNameUp == "") {
        $("#firstNameUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (userIdUp == "") {
        $("#userIdUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (flag == 1) {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/userAction.php",
            type: "POST",
            data: {
                phoneUp: phoneUp,
                emailUp: emailUp,
                lastNameUp: lastNameUp,
                firstNameUp: firstNameUp,
                userIdUp: userIdUp,
                check: check
            },
            success: function (response) {
                swal.close();
                var data = response;
                if (data == "success") {
                    error_alert("Information Update Successfully..", "success");
                    userProfile();
                }
                else {
                    error_alert(data, "error");
                    
                }
            }
        });
    }
}

function verifyPhone() {
    var phoneNumber = $("#phoneNumber").val();
    var check = "checkPhoneOTP";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            phoneNumber: phoneNumber,
            check: check
        },
        success: function (response) {
            if (response == 'success') {
                error_alert("OTP Send Successfully..", "success");
            }
            else {
                error_alert("Something is wrong..!", "error");
            }
        }
    });
}
function otpValidation(otp) {
    var phoneNumber = $("#phoneNumber").val();
    var check = "otpCheck";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            otp: otp,
            phoneNumber: phoneNumber,
            check: check
        },
        success: function (response) {
            if (response == 'success') {
                error_alert("Valid OTP..", "success");
                $("#otpError").html('')
                $("#verifyBtn").hide();
                $("#informationSection").show();
            }
            else {
                $("#otpError").html(response);
                $("#verifyBtn").show();
                $("#informationSection").hide();
            }
        }
    });
}

function passwordValidation(rePassword) {
    var password = $("#password").val();
    if (rePassword != password) {
        $("#passwordError").html("Invalid Password");
    }
    else {
        $("#passwordError").html('');
    }
}


function upazilaFind(district) {
    var check = "findUpazila";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            district: district,
            check: check
        },
        success: function (response) {
            $("#userUpazilaArea").html(response);
        }
    });
}


// userInfo
function userInfo() {
    var phoneNumber = $("#phoneNumber").val();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var emailAddress = $("#emailAddress").val();
    var nidPassport = $("#nidPassport").val();
    var userDistrict = $("#userDistrict").val();
    var userUpazila = $("#userUpazila").val();
    var serviceArea = $("#serviceArea").val();
    var latitudeVal = $("#latitudeVal").val();
    var longitudeVal = $("#longitudeVal").val();
    var userName = $("#userName").val();
    var password = $("#password").val();
    var rePassword = $("#rePassword").val();
    var dateOfBirth = $("#dateOfBirth").val();
    var passwordError = $("#passwordError").text();
    var flag = 1;
    if (phoneNumber == "") {
        $("#phoneNumber").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (firstName == "") {
        $("#firstName").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (lastName == "") {
        $("#lastName").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (emailAddress == "") {
        $("#emailAddress").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (nidPassport == "") {
        $("#nidPassport").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (userDistrict == "") {
        $("#userDistrict").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (userUpazila == "") {
        $("#userUpazila").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (serviceArea == "") {
        $("#serviceArea").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (userName == "") {
        $("#userName").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (password == "") {
        $("#password").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (rePassword == "") {
        $("#rePassword").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (dateOfBirth == "") {
        $("#dateOfBirth").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (passwordError != "") {
        flag = 0;
    }
    if (flag == 1) {
        var check = "insertUser";
        $.ajax({
            url: "reports/userAction.php",
            type: "POST",
            data: {
                phoneNumber: phoneNumber,
                firstName: firstName,
                lastName: lastName,
                emailAddress: emailAddress,
                userName: userName,
                password: password,
                dateOfBirth: dateOfBirth,
                nidPassport: nidPassport,
                userDistrict: userDistrict,
                userUpazila: userUpazila,
                latitudeVal: latitudeVal,
                longitudeVal: longitudeVal,
                check: check
            },
            success: function (response) {
                if (response == "success") {
                    error_alert("User Registration Success..", "success");
                    window.location.replace("http://localhost/Emergency_Support_Service/user_home.php");
                }
                else {
                    error_alert("Something is wrong..!", "error");
                }
            }
        });
    }
}

// latitude and longitude
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

// user login
function userSignIn()
{
    var userName=$("#userName").val();
    var userPassword=$("#userPassword").val();
    var latitudeVal=$("#latitudeVal").val();
    var longitudeVal=$("#longitudeVal").val();
    var check="userLogin";
    if (userName=='' || userPassword=='') {
        error_alert("Please Provide Required Data..!","error");
    }
    else
    {
        $.ajax({
            url: "reports/userAction.php",
            type: "POST",
            data: {
                userName: userName,
                userPassword: userPassword,
                latitudeVal: latitudeVal,
                longitudeVal: longitudeVal,
                check: check
            },
            success: function (response) {
                if (response=="success") {
                    window.location.replace("http://localhost/Emergency_Support_Service/user_home.php");
                }
                else
                {
                    console.log(response);
                    error_alert("Wrong Information! Please Provide Valid Information..","error");
                }
            }
        });
    }
}

function loactionUpdate()
{
    var latitudeVal=$("#latitudeVal").val();
    var longitudeVal=$("#longitudeVal").val();
    var check="autoUpdateLocation";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            latitudeVal: latitudeVal,
            longitudeVal: longitudeVal,
            check: check
        },
        success: function (response) {
            if (response!="success") 
            {
                alert(response);
            }
        }
    });
}

// openEmergencyBox
function openEmergencyBox(serviceID)
{
    var check="openEmergencyBoxData";
    var latitudeVal=$("#latitudeVal").val();
    var longitudeVal=$("#longitudeVal").val();
    $('#comBox').modal('show');

    $.ajax({
        url: "reports/emergencyAction.php",
        type: "POST",
        data: {
            latitudeVal: latitudeVal,
            longitudeVal: longitudeVal,
            serviceID: serviceID,
            check: check
        },
        success: function (response) {
         $("#modalInfo").html(response);
     }
 });
}
function requestSupport() {
   var latValue=$("#latValue").val();
   var lonValue=$("#lonValue").val();
   var message=$("#message").val();
   var addPhone=$("#addPhone").val();
   var serviceID=$("#serviceID").val();
   var file1 = $("#file1").prop("files")[0];  

   // var file2 = $("#file2").prop("files")[0];  
   // var file2 = $("#file3").prop("files")[0];
   var check="makeRequest";
   // if (message=='')
   // {
   //      $("#message").css({ "border": "1px solid red" });
   // }
   if (addPhone!='' && addPhone.length<11) 
   {
    $("#addPhone").css({ "border": "1px solid red" });
   }
   else
   {
    var form_data = new FormData();
    form_data.append("latValue", latValue);
    form_data.append("lonValue", lonValue);
    form_data.append("message", message);
    form_data.append("addPhone", addPhone);
    form_data.append("serviceID", serviceID);
    form_data.append("file1", file1);
    // form_data.append("file2", file2);
    // form_data.append("file3", file3);
    form_data.append("check", check);

    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
    $.ajax({
       url: "reports/requestBoxAction.php",
       dataType: 'script',
       cache: false,
       contentType: false,
       processData: false,
       data: form_data,                         
       type: 'post',
       success: function(response){
           swal.close();
             if (response=="success") {
                console.log(response);
              error_alert("Emergency Send Added Success..", "success");
              $('#comBox').modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
             } 
             else
             {
              error_alert(response, "error");
             }
         }
     });
}

}




