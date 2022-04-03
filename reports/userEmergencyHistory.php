<?php 
session_start();
include "../libs/db_conn.php";

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="district_area">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Emergency History</h3>
                    </div>
                    <div class="card-body">
                        <table id="supervisorTbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Emergency Type</th>
                                <th>Responsible Person</th>
                                <th>Other Phone Number</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                               <?php 
                                    $emergencyData="SELECT emergency.id AS 'id', emergency.message AS 'message', emergency.optional_mobile AS 'optionalNumber', emergency.status AS 'status', emergency.date AS 'date', supervisors.firstName AS 'firstName', services.service_name AS 'serviceName' FROM `emergency` INNER JOIN supervisors ON supervisors.id=emergency.supervisor_id INNER JOIN services ON services.id=emergency.service_id WHERE emergency.user_id='".$_SESSION['userId']."'";
                                    $emergencyHistory=mysqli_query($conn, $emergencyData);
                                    $sl=0;
                                    while($historyRow=mysqli_fetch_assoc($emergencyHistory))
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo ++$sl; ?></td>
                                            <td><?php echo $historyRow['serviceName']; ?></td>
                                            <td><?php echo $historyRow['firstName']; ?></td>
                                            <td><?php echo $historyRow['optionalNumber']; ?></td>
                                            <td><?php 
                                            if ($historyRow['status']=='New') 
                                            {
                                            	?>
                                            	<p class="btn btn-danger btn-sm">New</p>
                                            	<?php
                                            }
                                            elseif ($historyRow['status']=="Action") 
                                            {
                                            	?>
                                            	<p class="btn btn-warning btn-sm">Action</p>
                                            	<?php
                                            }
                                            else
                                            {
                                            	?>
                                            	<p class="btn btn-success btn-sm">Action</p>
                                            	<?php
                                            }
                                            ?></td>
                                            <td><?php echo $historyRow['date']; ?></td>
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