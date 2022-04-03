<?php
session_start();
include "../../libs/db_conn.php";
if($_POST['check']=="districtModalData")
{
    ?>
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">District Name</label>
            <input type="text" class="form-control" id="district_name" placeholder="Enter District Name">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addDistrict()">Save</button>
    </div>
    <?php
}

if($_POST['check']=="addDistrict")
{
   $districtName=$_POST['district_name'];
    if($districtName !=null)
    {
        $checkDistrict="SELECT * FROM `district` WHERE `district_name`='$districtName'";
        $countDistrict=mysqli_num_rows(mysqli_query($conn, $checkDistrict));
        if($countDistrict>0)
        {
            echo $districtName." already added in our database";
        }
        else{
            $addDistrictName="INSERT INTO `district`(`district_name`) VALUES ('$districtName')";
            $addDistrictResult=mysqli_query($conn, $addDistrictName);
            if($addDistrictResult)
            {
                echo "success";
            }
            else
            {
                echo "Something is wrong..!";
            }
        }
    }
    else
    {
        echo "Please provide valid data";
    }
}

if($_POST['check']=="districDelete")
{
   $districtId=$_POST['id'];
   $districtDeleteSQL="DELETE FROM `district` WHERE `id`='$districtId'";
   $districtDeleteResult=mysqli_query($conn, $districtDeleteSQL);
   if($districtDeleteResult)
   {
       echo "success";
   }
   else
   {
       echo "Something is wrong..!";
   }
}

if($_POST['check']=="editDistrict")
{
    $districtEditId=$_POST['id'];
    $districtEditData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `district` WHERE `id`='$districtEditId'"));
    ?>
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">District Name</label>
            <input type="text" class="form-control" id="district_name_up" placeholder="Enter District Name" value="<?php echo $districtEditData['district_name']; ?>">
            <input type="hidden" id="district_id" value="<?php echo $districtEditData['id']; ?>">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateDistrict()">Save</button>
    </div>
    <?php
}
if($_POST['check']=="updateDistrict")
{
    if($_POST['district_name_up']!=null)
    {
        $district_id=$_POST['district_id'];
        $district_name_up=$_POST['district_name_up'];
        $checkDistrict="SELECT * FROM `district` WHERE `district_name`='$district_name_up'";
        $countDistrict=mysqli_num_rows(mysqli_query($conn, $checkDistrict));
        if($countDistrict>0)
        {
            echo $district_name_up." already added in our database";
        }
        else
        {
            $districtUpdate=mysqli_query($conn, "UPDATE `district` SET `district_name`='$district_name_up' WHERE `id`='$district_id'");
            if($districtUpdate)
            {
                echo "success";
            }
            else
            {
                echo "Something is wrong";
            }
        }
    }
    else
    {
        echo "Please Provide Required Data";
    }    
}

if($_POST['check']=="upazilaData")
{
    ?>
    <div class="modal-body">
        <div class="form-group">
            <label>District Name</label>
            <select class="form-control" id="districtName">
                <option selected>Select District</option>
                <?php
                    $district=mysqli_query($conn, "SELECT * FROM `district`");
                    while($districtRow=mysqli_fetch_assoc($district))
                    {
                        ?>
                         <option value="<?php echo $districtRow['id']; ?>"><?php echo $districtRow['district_name']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
            
        <div class="form-group">
            <label>District Name</label>
            <input type="text" class="form-control" id="upazilaName" placeholder="Enter Upazila Name">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="upazilaAdd()">Save</button>
    </div>
    <script>
         $("#districtName").select2({
            theme: 'bootstrap4',
          allowClear: true,
          width: '100%'
      });
    </script>
    <?php
}

if($_POST['check']=="addUpazila")
{
    if($_POST['districtName']!=null && $_POST['upazilaName']!=null)
    {
        $districtId=$_POST['districtName'];
        $upazilaName=$_POST['upazilaName'];
        $districtCheck=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `upazila` WHERE `upazila_name`='$upazilaName'"));
        if($districtCheck>0)
        {
            echo $upazilaName." already add in our database";
        }
        else
        {
            $addUpazilaResult=mysqli_query($conn, "INSERT INTO `upazila`(`district_code`, `upazila_name`) VALUES ('$districtId','$upazilaName')");
            if($addUpazilaResult)
            {
                echo "success";
            }
            else
            {
                echo "Something is wrong";
            }
        }
    }
    else
    {
        echo "Please Provide Required Data.";
    }
}

if($_POST['check']=="upazilaDelete")
{
    $upazilaId=$_POST['id'];
    $upazilaDelete=mysqli_query($conn, "DELETE FROM `upazila` WHERE `id`='$upazilaId'");
    if($upazilaDelete)
    {
        echo "success";
    }
    else
    {
        echo "Something is wrong";
    }
}

if($_POST['check']=="editUpazila")
{
    $upazilaUpdateId=$_POST['id'];
    $upazilaUpdateData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `upazila` WHERE `id`='$upazilaUpdateId'"));
    ?>
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="upazilaIdUp" value="<?php echo $upazilaUpdateData['id']; ?>">
            <label>District Name</label>
            <select class="form-control" id="districtNameUp">
                <option selected>Select District</option>
                <?php
                    $district=mysqli_query($conn, "SELECT * FROM `district`");
                    while($districtRow=mysqli_fetch_assoc($district))
                    {
                        ?>
                         <option value="<?php echo $districtRow['id']; ?>" <?php if($districtRow['id']==$upazilaUpdateData['district_code']){echo "selected";} ?>><?php echo $districtRow['district_name']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
            
        <div class="form-group">
            <label>District Name</label>
            <input type="text" class="form-control" id="upazilaNameUp" value="<?php echo $upazilaUpdateData['upazila_name']; ?>">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="upazilaUpdate()">Save</button>
    </div>
    <script>
         $("#districtName").select2({
            theme: 'bootstrap4',
          allowClear: true,
          width: '100%'
      });
    </script>
    <?php
}

if($_POST['check']=="updateUpazila")
{
    if($_POST['districtNameUp']!=null && $_POST['upazilaNameUp']!=null)
    {
        $upazilaIdUp=$_POST['upazilaIdUp'];
        $districtNameUp=$_POST['districtNameUp'];
        $upazilaNameUp=$_POST['upazilaNameUp'];
        $checkUpazila=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `upazila` WHERE `upazila_name`='$upazilaNameUp'"));
        if($checkUpazila>0)
        {
            echo $upazilaNameUp." Already added in our database";
        }
        else
        {
            $updateUpazila=mysqli_query($conn, "UPDATE `upazila` SET `district_code`='$districtNameUp',`upazila_name`='$upazilaNameUp' WHERE id='$upazilaIdUp'");
            if($updateUpazila)
            {
                echo "success";
            }
            else
            {
                echo "Something is wrong";
            }
        }
    }
    else
    {
        echo "Please Provide Required Data";
    }
    
}
?>