<?php
    session_start();
    include "../../libs/db_conn.php";
?>
<div class="container-fluid">
    <div class="row">
    <!-- Services -->
        <div class="col-md-12" id="services_area">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Services</h3>
                <button type="button" class="btn btn-info float-right btn-sm" onclick="servicesData()">
                  Add Services
                </button>
              </div>
              <div class="card-body">
              <table id="district" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Service Name</th>
                    <th>Service Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $servicesData="SELECT * FROM `services`";
                        $servicesDataResult=mysqli_query($conn, $servicesData);
                        $sl=0;
                        while($rowService=mysqli_fetch_assoc($servicesDataResult))
                        {
                            ?>
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td><?php echo $rowService['service_name']; ?></td>
                                <td><img width="5%" src="../<?php echo $rowService['serviceImg']; ?>"></td>
                                <td>
                                    <a href="#" onclick="serviceEdit(<?php echo $rowService['id']; ?>)" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <?php if($rowService['status']==1){
                                        ?>
                                        <a href="#" onclick="deactiveService(<?php echo $rowService['id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <a href="#" onclick="activeService(<?php echo $rowService['id']; ?>)" class="btn btn-warning btn-sm"><i class="fas fa-check-circle"></i></a>
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