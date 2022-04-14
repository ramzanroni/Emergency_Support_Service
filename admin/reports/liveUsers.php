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
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $usersData=mysqli_query($conn, "SELECT live_users.id as 'id', live_users.phoneNumber AS 'phone', live_users.firstName AS 'firstName', live_users.lastName AS 'lastName', live_users.emailAddress as 'email', live_users.userName AS 'userName', live_users.dateOfBirth AS 'dateOfBirth', live_users.nidPassport AS 'nid', district.district_name AS 'districtName', upazila.upazila_name AS 'upazila'  FROM `live_users` INNER JOIN district ON district.id=live_users.userDistrict INNER JOIN upazila ON upazila.id=live_users.userUpazila");

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