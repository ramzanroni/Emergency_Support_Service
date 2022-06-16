 <?php
 session_start();
 include "../../libs/db_conn.php";
$newEmergencyData=mysqli_query($conn, "SELECT emergency.id as 'id', emergency.status as 'status',emergency.message AS 'message', services.service_name AS 'service_name', users.userName AS 'userName', users.phoneNumber AS 'phoneNumber', emergency.optional_mobile AS 'optional_mobile', emergency.date AS 'date',emergency.lat AS 'lat', emergency.lon AS 'lon', supervisors.latitude AS 'latitude', supervisors.longitude AS 'longitude' FROM emergency JOIN users ON emergency.user_id = users.id JOIN services ON emergency.service_id = services.id JOIN supervisors ON emergency.supervisor_id = supervisors.id WHERE emergency.status='Action' AND emergency.supervisor_id='".$_SESSION['userId']."'");
 ?>

 <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Open Emergency</h3>
        </div>
        <div class="card-body">
          <table id="district" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Optional Phone</th>
                <th>Service Name</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
                <th>View Map</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              $sl=1;
              while ($newEmergencyRow=mysqli_fetch_assoc($newEmergencyData)) 
              {
              $url="https://www.openstreetmap.org/directions?engine=graphhopper_foot&route=".$newEmergencyRow['lat']."%2C".$newEmergencyRow['lon']."%3B".$newEmergencyRow['latitude']."%2C".$newEmergencyRow['longitude'];

                ?>
                <tr>
                  <td><?php echo $sl; ?></td>
                  <td><?php echo $newEmergencyRow['userName']; ?></td>
                  <td><?php echo $newEmergencyRow['phoneNumber']; ?></td>
                  <td><?php echo $newEmergencyRow['optional_mobile']; ?></td>
                  <td><?php echo $newEmergencyRow['service_name']; ?></td>
                  <td><?php echo $newEmergencyRow['message']; ?></td>
                  <td><p class="btn btn-danger btn-sm"><?php echo $newEmergencyRow['status']; ?></p></td>
                  <td><?php echo $newEmergencyRow['date']; ?></td>
                  <td>
                  <a class="btn btn-danger btn-sm"  href="<?php echo $url; ?>" target="_blank">View Map</a>
                  </td>
                  <td><i class="far fa-check-circle btn btn-danger text-white" onclick="completeEmergencyData('<?php echo $newEmergencyRow["id"]; ?>')"></i></td>
                </tr>
                <?php
                $sl++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="emergencyActionModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div id="emergencyInfo">
        
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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