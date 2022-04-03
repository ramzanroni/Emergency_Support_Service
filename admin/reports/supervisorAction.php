<?php
session_start();
include "../../libs/db_conn.php";
    if($_POST['check']=="checkPhoneOTP")
    {
       $phone_number=$_POST['phoneNumber'];
       $otpNumber = mt_rand(100000,999999); 
        $msg="Your OTP: - ".$otpNumber;

        function callApi($sendernumber, $mysms) {
            $sender_id = '8809612117722';
            $url = "http://sms.viatech.com.bd/smsapi?api_key=C200129761e80403eea316.03567292&type=text&contacts=".$sendernumber."&senderid=".$sender_id."&msg=".$mysms;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        }
        $send = callApi($phone_number, $msg);
        if($send==true)
        {
            $otpInsert=mysqli_query($conn, "INSERT INTO `message_otp`(`phone_number`,`otp_code`) VALUES ('$phone_number','$otpNumber')");
            echo "success";
        }
        else
        {
            echo "Something is wrong..!";
        }
    }

    if($_POST['check']=="otpCheck")
    {
        $otp=$_POST['otp'];
        $phoneNumber=$_POST['phoneNumber'];
        $otpCheckResult=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `otp_code`,`phone_number` FROM `message_otp` WHERE `phone_number`='$phoneNumber' ORDER BY id DESC LIMIT 1"));   
        if($otpCheckResult['otp_code']==$otp)
        {
            echo "success";
        }
        else
        {
            echo "Wrong OTP";
        }
    }

    if($_POST['check']=="findUpazila")
    {
        $districtId=$_POST['district'];
        $upazilaResult=mysqli_query($conn, "SELECT * FROM `upazila` WHERE `district_code`='$districtId'");
        ?>
        <select class="form-control" id="superviorUpazila">
            <option selected>Select District</option>
        <?php
        while($upazilaRow=mysqli_fetch_assoc($upazilaResult))
        {
            ?>
                <option value="<?php echo $upazilaRow['id']; ?>"><?php echo $upazilaRow['upazila_name']; ?></option>
            <?php
        }
        ?>
        </select>
        <script>
            $("select").select2({
                theme: 'bootstrap4',
                allowClear: true,
                width: '100%'
            });
        </script>
        <?php
    }

    // insertSupervisor
    if($_POST['check']=="insertSupervisor")
    {
        
        $phoneNumber=$_POST['phoneNumber'];
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $emailAddress=$_POST['emailAddress'];
        $userName=$_POST['userName'];
        $password=$_POST['password'];
        $dateOfBirth=$_POST['dateOfBirth'];
        $nidPassport=$_POST['nidPassport'];
        $supervisorDistrict=$_POST['supervisorDistrict'];
        $superviorUpazila=$_POST['superviorUpazila'];
        $serviceArea=$_POST['serviceArea'];
        $latitudeVal=$_POST['latitudeVal'];
        $longitudeVal=$_POST['longitudeVal'];

        $passwordEncrypt= md5($password);

        $supervisorInsertResult=mysqli_query($conn, "INSERT INTO `supervisors`(`phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `supervisorDistrict`, `superviorUpazila`, `serviceArea`, `latitude`, `longitude`) VALUES ('$phoneNumber','$firstName','$lastName','$emailAddress', '$userName', '$passwordEncrypt', '$dateOfBirth', '$nidPassport','$supervisorDistrict','$superviorUpazila','$serviceArea','$latitudeVal','$longitudeVal')");
        if($supervisorInsertResult)
        {
            echo "success";
        }
        else
        {
            echo "Something is wrong...!";
        }
    }

    // supervisorDeactive
    if($_POST['check']=="supervisorDeactive")
    {
        $supervisorId=$_POST['id'];
        $deactiveSupervisor=mysqli_query($conn, "UPDATE `supervisors` SET status='0' WHERE id='$supervisorId'");
        if($deactiveSupervisor)
        {
            echo "success";
        }
        else
        {
            echo "Something is wrong";
        }
    }

    // supervisorActive
    if($_POST['check']=="supervisorActive")
    {
        $supervisorId=$_POST['id'];
        $activeSupervisor=mysqli_query($conn, "UPDATE `supervisors` SET status='1' WHERE id='$supervisorId'");
        if($activeSupervisor)
        {
            echo "success";
        }
        else
        {
            echo "Something is wrong";
        }
    }
?>