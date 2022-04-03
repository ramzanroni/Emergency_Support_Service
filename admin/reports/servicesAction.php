<?php
session_start();
include "../../libs/db_conn.php";
if($_POST['check']=="servicesModalData")
{
    ?>
    <div class="modal-body">
        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Services Name</label>
                <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Enter Service Name">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="serviceImg" name="serviceImg">
                    <label class="custom-file-label" for="serviceImg">Choose file</label>
                </div>
            </div>
        </div>
    </form>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="addService()">Save</button>
    <!-- <button type="button" class="btn btn-primary" id="addService">Save</button> -->
</div>
<?php
}
    // addService
if($_POST['check']=="addService")
{
    // echo $_POST['check'];

    if ($_POST['serviceName']!=null) {
        $file_info = $_FILES['serviceImg']['name'];
        $serviceName=$_POST['serviceName'];
        $ext = pathinfo($file_info, PATHINFO_EXTENSION);
        $allwoed_extention = array('png', 'jpg','JPEG','PNG','GIF','jpeg','JPG');
        $checkService=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `services` WHERE `service_name`='$serviceName'"));
        if($checkService>0)
        {
            echo $serviceName." Already added in our database.";
        }
        else
        {
            if(in_array($ext, $allwoed_extention)){
                if ($_FILES['serviceImg']['size'] < 104857600) {
                    $newfilename = round(microtime(true)) . '.' . $ext;
                    $upload = move_uploaded_file($_FILES['serviceImg']['tmp_name'], "../images/".$newfilename);
                    $imageName="admin/images/".$newfilename;
                    $serviceAddResult=mysqli_query($conn, "INSERT INTO `services`(`service_name`, `serviceImg`) VALUES ('$serviceName', '$imageName')");
                    if($serviceAddResult)
                    {
                        echo "success";
                    }
                    else
                    {
                        echo "Something is wrong.";
                    }
                }
                else
                {
                    echo "File Size Is Extra large";
                }
            }
            else
            {
                echo "This file does not support.";
            }
        }
    }
    else
    {
        echo "Please Provide Required Data.";
    }
    
    // if($_POST['serviceName']!=null)
    // {
    //     $serviceName=$_POST['serviceName'];
    //     $checkService=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `services` WHERE `service_name`='$serviceName'"));
    //     if($checkService>0)
    //     {
    //         echo $serviceName." Already added in our database.";
    //     }
    //     else
    //     {
    //         $serviceAddResult=mysqli_query($conn, "INSERT INTO `services`(`service_name`) VALUES ('$serviceName')");
    //         if($serviceAddResult)
    //         {
    //             echo "success";
    //         }
    //         else
    //         {
    //             echo "Something is wrong.";
    //         }
    //     }
    // }
    // else
    // {
    //     echo "Please Provide Required Data.";
    // }
}

    // deactiveService
if($_POST['check']=="deactiveService")
{
    $serviceId=$_POST['id'];
    $serviceDeactiveResult=mysqli_query($conn, "UPDATE `services` SET`status`=0 WHERE `id`='$serviceId'");
    if($serviceDeactiveResult)
    {
        echo "success";
    }
    else{
        echo "Something is wrong";
    }
}
    // activeService
if($_POST['check']=="activeService")
{
    $serviceId=$_POST['id'];
    $serviceDeactiveResult=mysqli_query($conn, "UPDATE `services` SET`status`=1 WHERE `id`='$serviceId'");
    if($serviceDeactiveResult)
    {
        echo "success";
    }
    else{
        echo "Something is wrong";
    }
}

    // serviceEdit
if($_POST['check']=="serviceEdit")
{
    $servideId=$_POST['id'];
    $serviceUpData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `services` WHERE `id`='$servideId'"));
    ?>
    <div class="modal-body">
        <div class="form-group">
            <label>Services Name</label>
            <input type="text" class="form-control" id="serviceNameUp" value="<?php echo $serviceUpData['service_name']; ?>">
            <input type="hidden" value="<?php echo $serviceUpData['id']; ?>" id="serviceId">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateService()">Update</button>
    </div>
    <?php
}

    // updateService
if($_POST['check']=="updateService")
{
    if($_POST['serviceNameUp']!=null)
    {
        $serviceId=$_POST['serviceId'];
        $serviceNameUp=$_POST['serviceNameUp'];
        $checkServiceData=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `services` WHERE `service_name`='$serviceNameUp'"));
        if($checkServiceData>0)
        {
            echo $serviceNameUp." Already added in our database.";
        }
        else
        {
            $serviceUpdateResult=mysqli_query($conn, "UPDATE `services` SET `service_name`='$serviceNameUp' WHERE `id`='$serviceId'");
            if($serviceUpdateResult)
            {
                echo 'success';
            }
            else{
                echo "Something is wrong.!";
            }
        }

    }
    else
    {
        echo "Please Provide Required Data.";
    }
}
?>