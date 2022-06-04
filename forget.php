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
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center" id="forgetArea">
        <a href="index.php" class="h1"><b>Emergency</b> Support Service</a>
      </div>
      <div class="card-body">
       
        <div id="inputArea">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
          <!-- <form action="recover-password.html" method="post"> -->
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="phoneNumber" onkeyup="checkPhone(this.value)" placeholder="Phone">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-mobile-alt"></span>
                </div>
              </div>
            </div>
            <small class="text-danger" id="errorPhone"></small>
            <div id="userID">

            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block" onclick="changePassword()">Request new password</button>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- </form> -->
          <p class="mt-3 mb-1">
            <a href="index.php">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>

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
  <script type="text/javascript">
    $( document ).ready(function() {
      // $("#messageIns").hide();
    });


  </script>