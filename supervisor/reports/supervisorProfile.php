<?php
session_start();
include "../../libs/db_conn.php";
$supervisorData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT supervisors.*, district.district_name as 'district', upazila.upazila_name AS 'upazila', services.service_name AS 'serviceName' FROM supervisors INNER JOIN district ON district.id =supervisors.supervisorDistrict INNER JOIN upazila ON upazila.id=supervisors.superviorUpazila INNER JOIN services ON services.id=supervisors.serviceArea WHERE supervisors.id='".$_SESSION['userId']."'"));
?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/supervisor.png"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $supervisorData['firstName']." ,".$supervisorData['lastName']; ?></h3>
                <p class="text-muted text-center">System Supervisor</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-envelope-open-text"></i> Email</strong>

                <p class="text-muted">
                  <?php echo $supervisorData['emailAddress']; ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $supervisorData['upazila']." ".$supervisorData['district']; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <?php echo $supervisorData['serviceName']; ?>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#changePass" data-toggle="tab">Change Password</a></li>
                  <li class="nav-item"><a class="nav-link" href="#infoUpdate" data-toggle="tab">Information Update</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="timeline">
                    <!-- Post -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="changePass">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="oldPassword" onkeyup="checkPassword(this.value)" placeholder="Please Enter Your Old Password">
                          <small id="passError" class="text-danger"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="newPassword" placeholder="Please Enter Your New Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Re Enter New Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="reNewPassword" onkeyup="reCheckPass(this.value)" placeholder="Please Re-Enter Your New Password">
                          <small class="text-danger" id="rePassError"></small>
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo $supervisorData['id']; ?>" id="supervisorId">
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <input type="button" class="btn btn-danger" onclick="changePassword()" value="Submit"></input>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="infoUpdate">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="firstNameUp" value="<?php echo $supervisorData['firstName']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="lastNameUp" value="<?php echo $supervisorData['lastName']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="emailUp" value="<?php echo $supervisorData['emailAddress']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phoneUp" value="<?php echo $supervisorData['phoneNumber']; ?>">
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo $supervisorData['id']; ?>" id="supervisorIdUp">
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <input type="button" class="btn btn-danger" onclick="updateSupervisorInfo()" value="Submit"></input>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>