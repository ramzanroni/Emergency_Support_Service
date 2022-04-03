<?php 
session_start();
include "../../libs/db_conn.php";

?>
<div class="container-fluid">
    <div class="row">

    <!-- District -->
        <div class="col-md-6" id="district_area">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Districts</h3>
                <button type="button" class="btn btn-info float-right btn-sm" onclick="districtData()">
                  Add District
                </button>
              </div>
              <div class="card-body">
              <table id="district" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>District</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $districtData="SELECT * FROM `district`";
                        $districtDataResult=mysqli_query($conn, $districtData);
                        $sl=0;
                        while($rowDistrict=mysqli_fetch_assoc($districtDataResult))
                        {
                            ?>
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td><?php echo $rowDistrict['district_name']; ?></td>
                                <td>
                                    <a href="#" onclick="districtEdit(<?php echo $rowDistrict['id']; ?>)" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="districtDelete(<?php echo $rowDistrict['id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
          <!-- upzila -->
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Upazilas</h3>
                <button type="button" class="btn btn-info float-right btn-sm" onclick="upazilaData()">
                  Add Upazila
                </button>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped" id="upazilaTable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>District</th>
                      <th>Upazila</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      $upazilaData=mysqli_query($conn, "SELECT upazila.upazila_name AS 'upazila_name', district.district_name AS 'district_name', upazila.id AS 'upazila_id' FROM upazila INNER JOIN district ON upazila.district_code = district.id");
                      $sl=0;
                      while($upazilaRow=mysqli_fetch_assoc($upazilaData))
                      {
                        ?>
                        <tr>
                          <td><?php echo ++$sl; ?></td>
                          <td><?php echo $upazilaRow['upazila_name']; ?></td>
                          <td><?php echo $upazilaRow['district_name']; ?></td>
                          <td>
                              <a href="#" onclick="upazilaEdit(<?php echo $upazilaRow['upazila_id']; ?>)" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              <a href="#" onclick="upazilaDelete(<?php echo $upazilaRow['upazila_id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="areaModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Area</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modalData">
            
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