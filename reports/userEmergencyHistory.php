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
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
                         $emergencyData="SELECT emergency.id AS 'id', emergency.message AS 'message', emergency.optional_mobile AS 'optionalNumber', emergency.status AS 'status', emergency.date AS 'date', supervisors.firstName AS 'firstName', services.service_name AS 'serviceName', emergency.feedback AS 'feedback' FROM `emergency` INNER JOIN supervisors ON supervisors.id=emergency.supervisor_id INNER JOIN services ON services.id=emergency.service_id WHERE emergency.user_id='".$_SESSION['userId']."'";
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
                               <td><?php if ($historyRow['feedback']==0) {
                                ?>
                                <a href="#" class="btn btn-warning btn-sm" onclick="feedbackEmergency(<?php echo $historyRow['id']; ?>)">Feedback</a>
                                <?php
                            }
                            else{
                                ?>
                                <a href="#" class="btn btn-success btn-sm">Feedback Submited</a>
                                <?php
                            } ?></td>
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

<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="feedbackData">

    </div>
</div>
</div> 
<script>
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
    function feedbackEmergency(id){
        $("#feedbackModal").modal('show');
        var check="feedbackData";
        $.ajax({
            url: "reports/emergencyAction.php",
            type: "POST",
            data: {
                id: id,
                check: check
            },
            success: function (response) {
                $("#feedbackData").html(response);
            }
        });
    }

    function sendFeedback(id)
    {
        var emergencyID=id;
        var reactionValue=$("#reactionValue").val();
        var reactionMessage=$("#reactionMessage").val();
        var check="storeFeedback";
        if (reactionValue=='') {
            error_alert('Please Select Your Reaction From Click on Emoji Icon..!','error');
        }
        else{
            $.ajax({
                url: "reports/emergencyAction.php",
                type: "POST",
                data: {
                    emergencyID: emergencyID,
                    reactionValue: reactionValue,
                    reactionMessage: reactionMessage,
                    check: check
                },
                success: function (response) {
                    if (response=='success') {
                        error_alert("Successfully send your feedback..", 'success');
                        $("#feedbackModal").modal('hide');
                        $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
                        userEmergency();
                    }
                    else
                    {
                        error_alert(response, 'error');
                    }
                }
            });
        }
    }

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