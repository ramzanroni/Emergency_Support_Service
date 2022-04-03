<?php
    session_start();
    include "../../libs/db_conn.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="services_area">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Users List</h3>
              </div>
              <div class="card-body">
              <table id="district" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Upazila</th>
                    <th>District</th>
                    <th>Date of Birth</th>
                    <th>NID</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $usersData=mysqli_query($conn, "SELECT users.id as 'id', users.phoneNumber AS 'phone', users.firstName AS 'firstName', users.lastName AS 'lastName', users.emailAddress as 'email', users.userName AS 'userName', users.dateOfBirth AS 'dateOfBirth', users.nidPassport AS 'nid', users.status AS 'status', district.district_name AS 'districtName', upazila.upazila_name AS 'upazila'  FROM `users` INNER JOIN district ON district.id=users.userDistrict INNER JOIN upazila ON upazila.id=users.userUpazila");

                        $sl=0;
                        while($rowUser=mysqli_fetch_assoc($usersData))
                        {
                            ?>
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td><?php echo $rowUser['firstName']; ?></td>
                                <td><?php echo $rowUser['lastName']; ?></td>
                                <td><?php echo $rowUser['phone']; ?></td>
                                <td><?php echo $rowUser['email']; ?></td>
                                <td><?php echo $rowUser['userName']; ?></td>
                                <td><?php echo $rowUser['upazila']; ?></td>
                                <td><?php echo $rowUser['districtName']; ?></td>
                                <td><?php echo $rowUser['dateOfBirth']; ?></td>
                                <td><?php echo $rowUser['nid']; ?></td>
                                <td>
                                    <?php if($rowUser['status']==1){
                                        ?>
                                        <a href="#" onclick="deactiveUser(<?php echo $rowUser['id']; ?>, 0)" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <a href="#" onclick="deactiveUser(<?php echo $rowUser['id']; ?>, 1)" class="btn btn-warning btn-sm"><i class="fas fa-check-circle"></i></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>

<div class="modal fade" id="servicesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Services</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="serviceData">
            
            </div> 
        </div>
    </div>
</div>

      <script>
      
         
  $(function () {
    $("table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>