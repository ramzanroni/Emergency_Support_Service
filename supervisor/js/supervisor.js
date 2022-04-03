
// alerts (alert will be error, success, info, warning, question)

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


// supervisor_login
function supervisor_login() {
    var supervisor_username = $("#supervisor_username").val();
    var supervisor_password = $("#supervisor_password").val();
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();
    var check = "supervisorLogin";
    $.ajax({
        url: "reports/supervisorLoginAction.php",
        type: "POST",
        data: {
            supervisor_username: supervisor_username,
            supervisor_password: supervisor_password,
            latitude: latitude,
            longitude: longitude,
            check: check
        },
        success: function (response) {
            var data = response;
            if (data == "success") {
                window.location.replace("http://localhost/Emergency_Support_Service/supervisor/supervisor_home.php");
            }
            else {
                error_alert(data, "error");
            }
        }
    });
}


// page loading
function supervisorProfile() {
    $.ajax({
        url: "reports/supervisorProfile.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}
// newEmergency

function newEmergency()
{
    $.ajax({
        url: "reports/newEmergency.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}
// openEmergency
function actionEmergency(){
    $.ajax({
        url: "reports/openEmergency.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}
function completeEmergency(){
    $.ajax({
        url: "reports/completeEmergency.php",
        success: function (result) {
            $("#content").html(result);
        }
    });
}
// updateSupervisorInfo
function updateSupervisorInfo() {
    var supervisorIdUp = $("#supervisorIdUp").val();
    var firstNameUp = $("#firstNameUp").val();
    var lastNameUp = $("#lastNameUp").val();
    var emailUp = $("#emailUp").val();
    var phoneUp = $("#phoneUp").val();
    var flag = 1;
    var check = "supervisorInfoUpdate";
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
    if (supervisorIdUp == "") {
        $("#supervisorIdUp").css({ "border": "1px solid red" });
        flag = 0;
    }
    if (flag == 1) {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/supervisorLoginAction.php",
            type: "POST",
            data: {
                phoneUp: phoneUp,
                emailUp: emailUp,
                lastNameUp: lastNameUp,
                firstNameUp: firstNameUp,
                supervisorIdUp: supervisorIdUp,
                check: check
            },
            success: function (response) {
                swal.close();
                var data = response;
                if (data == "success") {
                    error_alert("Information Update Successfully..", "success");
                }
                else {
                    error_alert(data, "error");
                }
            }
        });
    }
}

// checkPassword

function checkPassword(oldPassword) {
    var supervisorId = $("#supervisorId").val();
    var oldPassword = oldPassword;
    var check = "checkPassword";
    $.ajax({
        url: "reports/supervisorLoginAction.php",
        type: "POST",
        data: {
            supervisorId: supervisorId,
            oldPassword: oldPassword,
            check: check
        },
        success: function (response) {
            $("#passError").html(response);
        }
    });
}

// reCheckPass
function reCheckPass(rePassword) {
    var newPassword = $("#newPassword").val();
    if (rePassword != newPassword) {
        $("#rePassError").html("New & Re-new Password Doesn't Match.");
    }
    else {
        $("#rePassError").html('');
    }
}

// changePassword
function changePassword() {
    var supervisorId = $("#supervisorId").val();
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
            url: "reports/supervisorLoginAction.php",
            type: "POST",
            data: {
                supervisorId: supervisorId,
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

function viewEmergency(id)
{
    var check='emergencyActionData';
    $('#emergencyActionModal').modal('show');
    $.ajax({
        url: "reports/emegencyAction.php",
        type: "POST",
        data: {
            id: id,
            check: check
        },
        success: function (response) {
         $("#emergencyInfo").html(response);
     }
 });
}

// getAction

function getAction(id, status)
{
   var check='acceptEmergency';
   Swal.fire('Please Wait. Data Loading.');
   Swal.showLoading();
   $.ajax({
    url: "reports/emegencyAction.php",
    type: "POST",
    data: {
        id: id,
        status:status,
        check: check
    },
    success: function (response) {
        swal.close();
        console.log(response);
        if (response=="success") {
            $('#emergencyActionModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            error_alert('Emergency Accept Successfully..', 'success');
            newEmergency();
        }
        else
        {
            error_alert(response, 'error');
        }
    }
});
}

// completeEmergencyData
function completeEmergencyData(id)
{
    var check='completeEmergency';
    $.ajax({
        url: "reports/emegencyAction.php",
        type: "POST",
        data: {
            id: id,
            check: check
        },
        success: function (response) {
           if (response=="success") {
            error_alert('Emergency Solved Successfully..', 'success');
            completeEmergency();
        }
        else
        {
            error_alert(response, 'error');
        }
     }
 });
}

// viewEmergencyNoti
function viewEmergencyNoti(id)
{
    viewEmergency(id);
}
// admin sign in function

// function admin_sign_in() {
//     var admin_username = $("#admin_username").val();
//     var admin_password = $("#admin_password").val();
//     $.ajax({
//         url: "reports/login_result.php",
//         type: "POST",
//         data: {
//             admin_username: admin_username,
//             admin_password: admin_password
//         },
//         success: function (response) {
//             var data = response;
//             if (data == "success") {
//                 window.location.replace("http://localhost/Emergency_Support_Service/admin/admin_home.php");
//             }
//             else {
//                 error_alert("Please Provide Right Information..", "error");
//             }
//         }
//     });
// }


// // page load
// function addSupervisor() {
//     $.ajax({
//         url: "reports/addSupervisor.php",
//         success: function (result) {
//             $("#content").html(result);
//         }
//     });
// }

// function addArea() {
//     $.ajax({
//         url: "reports/addArea.php",
//         success: function (result) {
//             $("#content").html(result);
//         }
//     });
// }

// function addSevices() {
//     $.ajax({
//         url: "reports/addServices.php",
//         success: function (result) {
//             $("#content").html(result);
//         }
//     });
// }

// function supervisorList() {
//     $.ajax({
//         url: "reports/supervisorList.php",
//         success: function (result) {
//             $("#content").html(result);
//         }
//     });
// }


// // send email for new user
// function sendEmailForNewUser() {
//     var receiverEmail = $("#receiver_email").val();
//     var subject = $("#subject").val();
//     var message_body = $("#message_body").val();
//     var check = "sendEmailForNewUser";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/sendEmail.php",
//         type: "POST",
//         data: {
//             receiverEmail: receiverEmail,
//             subject: subject,
//             message_body: message_body,
//             check: check
//         },
//         success: function (response) {
//             var data = response;
//             if (data == "success") {
//                 swal.close();
//                 error_alert("Email Send Successfully...", "success");
//                 $("#receiver_email").val('');
//                 $("#subject").val('');
//                 $("#message_body").val('');
//             }
//             else {
//                 error_alert("Please Provide Right Information..", "error");
//             }
//         }
//     });
// }

// // district Data
// function districtData() {
//     $('#areaModal').modal('show');
//     var check = "districtModalData";
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check
//         },
//         success: function (response) {
//             $("#modalData").html(response);
//         }
//     });
// }
// // add district
// function addDistrict() {
//     var district_name = $("#district_name").val();
//     var check = "addDistrict";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             district_name: district_name,
//             check: check
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 $('#areaModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addArea();
//                 error_alert("District added success...", "success");
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // edit district
// function districtEdit(id) {
//     var check = "editDistrict";
//     $('#areaModal').modal('show');
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             $("#modalData").html(response);
//         }
//     });
// }

// // delete district
// function districtDelete(id) {
//     var check = "districDelete";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("Delete District Success...", "success");
//                 addArea();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// function updateDistrict() {
//     var district_id = $("#district_id").val();
//     var district_name_up = $("#district_name_up").val();
//     var check = "updateDistrict";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             district_id: district_id,
//             district_name_up: district_name_up
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("District Update Success...", "success");
//                 $('#areaModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addArea();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // upazilaData
// function upazilaData() {
//     var check = "upazilaData";
//     $('#areaModal').modal('show');
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check
//         },
//         success: function (response) {
//             $('#districtName').select2();
//             $("#modalData").html(response);
//         }
//     });
// }
// // addUpazila
// function upazilaAdd() {
//     var districtName = $("#districtName").val();
//     var upazilaName = $("#upazilaName").val();
//     var check = "addUpazila";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             districtName: districtName,
//             upazilaName: upazilaName
//         },
//         success: function (response) {
//             swal.close();
//             console.log(response);
//             if (response == "success") {
//                 error_alert("Upazila Update Success...", "success");
//                 $('#areaModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addArea();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }
// // upazilaEdit
// function upazilaEdit(id) {
//     var check = "editUpazila";
//     $('#areaModal').modal('show');
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             $("#modalData").html(response);
//         }
//     });
// }

// // upazilaDelete
// function upazilaDelete(id) {
//     var check = "upazilaDelete";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("Delete District Success...", "success");
//                 addArea();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // upazilaUpdate
// function upazilaUpdate() {
//     var upazilaIdUp = $("#upazilaIdUp").val();
//     var districtNameUp = $("#districtNameUp").val();
//     var upazilaNameUp = $("#upazilaNameUp").val();
//     var check = "updateUpazila";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/areaAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             upazilaIdUp: upazilaIdUp,
//             districtNameUp: districtNameUp,
//             upazilaNameUp: upazilaNameUp
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("District Update Success...", "success");
//                 $('#areaModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addArea();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // servicesData
// function servicesData() {
//     $('#servicesModal').modal('show');
//     var check = "servicesModalData";
//     $.ajax({
//         url: "reports/servicesAction.php",
//         type: "POST",
//         data: {
//             check: check
//         },
//         success: function (response) {
//             $("#serviceData").html(response);
//         }
//     });
// }

// // addService
// function addService() {
//     var serviceName = $("#serviceName").val();
//     var check = "addService";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/servicesAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             serviceName: serviceName
//         },
//         success: function (response) {
//             swal.close();
//             console.log(response);
//             if (response == "success") {
//                 error_alert("Service Added Success...", "success");
//                 $('#servicesModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addSevices();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // deactiveService
// function deactiveService(id) {
//     var check = "deactiveService";
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be deactive this service!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, deactive it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Swal.fire('Please Wait. Data Loading.');
//             Swal.showLoading();
//             $.ajax({
//                 url: "reports/servicesAction.php",
//                 type: "POST",
//                 data: {
//                     check: check,
//                     id: id
//                 },
//                 success: function (response) {
//                     swal.close();
//                     if (response == "success") {
//                         error_alert("Service Deactived Success...", "success");
//                         addSevices();
//                     }
//                     else {
//                         error_alert(response, "error");
//                     }
//                 }
//             });
//         }
//     });
// }

// function activeService(id) {
//     var check = "activeService";
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be active this service!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, active it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Swal.fire('Please Wait. Data Loading.');
//             Swal.showLoading();
//             $.ajax({
//                 url: "reports/servicesAction.php",
//                 type: "POST",
//                 data: {
//                     check: check,
//                     id: id
//                 },
//                 success: function (response) {
//                     swal.close();
//                     if (response == "success") {
//                         error_alert("Service Actived Success...", "success");
//                         addSevices();
//                     }
//                     else {
//                         error_alert(response, "error");
//                     }
//                 }
//             });
//         }
//     });
// }

// // serviceEdit
// function serviceEdit(id) {
//     var check = "serviceEdit";
//     $('#servicesModal').modal('show');
//     $.ajax({
//         url: "reports/servicesAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             $("#serviceData").html(response);
//         }
//     });
// }

// // updateService
// function updateService() {
//     var serviceId = $("#serviceId").val();
//     var serviceNameUp = $("#serviceNameUp").val();
//     var check = "updateService";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/servicesAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             serviceId: serviceId,
//             serviceNameUp: serviceNameUp
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("Service Update Success...", "success");
//                 $('#servicesModal').modal('hide');
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//                 addSevices();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // supervisorRegistrationLinkGenerate
// function supervisorRegistrationLinkGenerate() {
//     var check = "supervisorRegistrationLinkGenerate";
//     $.ajax({
//         url: "reports/sendEmail.php",
//         type: "POST",
//         data: {
//             check: check
//         },
//         success: function (response) {
//             $('#message_body').summernote('code', response);
//         }
//     });
// }

// // deactiveSupervisor
// function deactiveSupervisor(id) {
//     var check = "supervisorDeactive";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/supervisorAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("Supervisor Deactive Successfully...", "success");
//                 supervisorList();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }

// // activeSupervisor
// function activeSupervisor(id) {
//     var check = "supervisorActive";
//     Swal.fire('Please Wait. Data Loading.');
//     Swal.showLoading();
//     $.ajax({
//         url: "reports/supervisorAction.php",
//         type: "POST",
//         data: {
//             check: check,
//             id: id
//         },
//         success: function (response) {
//             swal.close();
//             if (response == "success") {
//                 error_alert("Supervisor Active Successfully...", "success");
//                 supervisorList();
//             }
//             else {
//                 error_alert(response, "error");
//             }
//         }
//     });
// }