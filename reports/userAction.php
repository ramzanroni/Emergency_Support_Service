<?php
session_start();
include "../libs/db_conn.php";
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
  }
  $client  = @$_SERVER['HTTP_CLIENT_IP'];
  $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
  $remote  = $_SERVER['REMOTE_ADDR'];

  if(filter_var($client, FILTER_VALIDATE_IP))
  {
    $ip = $client;
}
elseif(filter_var($forward, FILTER_VALIDATE_IP))
{
    $ip = $forward;
}
else
{
    $ip = $remote;
}

return $ip;
}
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
    if ($otp=="" && $phoneNumber=="") 
    {
        echo "Please Provide Required Data...";
    }
    else
    {
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
}

if($_POST['check']=="findUpazila")
{
    $districtId=$_POST['district'];
    $upazilaResult=mysqli_query($conn, "SELECT * FROM `upazila` WHERE `district_code`='$districtId'");
    ?>
    <select class="form-control" id="userUpazila">
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

    // insertUser
if($_POST['check']=="insertUser")
{
    $phoneNumber=$_POST['phoneNumber'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $emailAddress=$_POST['emailAddress'];
    $userName=$_POST['userName'];
    $password=$_POST['password'];
    $dateOfBirth=$_POST['dateOfBirth'];
    $nidPassport=$_POST['nidPassport'];
    $userDistrict=$_POST['userDistrict'];
    $userUpazila=$_POST['userUpazila'];
    $latitudeVal=$_POST['latitudeVal'];
    $longitudeVal=$_POST['longitudeVal'];

    $passwordEncrypt= md5($password);

    $userInsertResult=mysqli_query($conn, "INSERT INTO `users`(`phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `userDistrict`, `userUpazila`, `latitude`, `longitude`) VALUES ('$phoneNumber','$firstName','$lastName','$emailAddress', '$userName', '$passwordEncrypt', '$dateOfBirth', '$nidPassport','$userDistrict','$userUpazila','$latitudeVal','$longitudeVal')");
    if($userInsertResult)
    {
        $getUserID=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `password`='$passwordEncrypt' AND `userName`='$userName'"));
        $_SESSION['user_name']=$userName;
        $_SESSION['emailAddress']=$emailAddress;
        $_SESSION['userId']=$getUserID['id'];
        $_SESSION['userPhone']=$getUserID['phoneNumber'];
        $ip_address=getUserIP();
        $liveUserInsertResult=mysqli_query($conn, "INSERT INTO `live_users`(`id`,`phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `userDistrict`, `userUpazila`, `latitude`, `longitude`, `ip_address`) VALUES ('".$getUserID['id']."','$phoneNumber','$firstName','$lastName','$emailAddress', '$userName', '$passwordEncrypt', '$dateOfBirth', '$nidPassport','$userDistrict','$userUpazila','$latitudeVal','$longitudeVal', '$ip_address')");
        if($liveUserInsertResult)
        {
            echo "success";
        }

    }
    else
    {
        echo "Something is wrong...!";
    }
}

    // userLogin
if ($_POST['check']=="userLogin") 
{
    $userName=$_POST['userName'];
    $userPassword=$_POST['userPassword'];
    $latitudeVal=$_POST['latitudeVal'];
    $longitudeVal=$_POST['longitudeVal'];
    $userPasswordEncrypt= md5($userPassword);

    $checkUser=mysqli_query($conn, "SELECT * FROM `users` WHERE (`userName`='$userName' OR `emailAddress`='$userName') AND `password`='$userPasswordEncrypt' AND `status`=1");
    if (mysqli_num_rows($checkUser)>0) 
    {
        $userData=mysqli_fetch_assoc($checkUser);
        $_SESSION['user_name']=$userName;
        $_SESSION['emailAddress']=$userData['emailAddress'];
        $_SESSION['userId']=$userData['id'];
        $_SESSION['userPhone']=$userData['phoneNumber'];
        $userUpdate=mysqli_query($conn, "UPDATE `users` SET `latitude`='$latitudeVal',`longitude`='$longitudeVal' WHERE `id`='".$userData['id']."'");
        $ip_address=getUserIP();
        $liveUserInsertResult=mysqli_query($conn, "INSERT INTO `live_users`(`id`,`phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `userDistrict`, `userUpazila`, `latitude`, `longitude`, `ip_address`) VALUES ('".$userData['id']."','".$userData['phoneNumber']."','".$userData['firstName']."','".$userData['lastName']."','".$userData['emailAddress']."', '".$userData['userName']."', '".$userData['password']."', '".$userData['dateOfBirth']."', '".$userData['nidPassport']."','".$userData['userDistrict']."','".$userData['userUpazila']."','".$userData['latitude']."','".$userData['longitude']."', '".$ip_address."')");
        if ($liveUserInsertResult) 
        {
            echo "success";
        }

    }
    else
    {
        echo "Something is Wrong";
    }
}
// autoUpdateLocation
if ($_POST['check']=="autoUpdateLocation") 
{
   $userId=$_SESSION['userId'];
   $latitudeVal=$_POST['latitudeVal'];
   $longitudeVal=$_POST['longitudeVal'];
   $updateLocation=mysqli_query($conn, "UPDATE `users` SET `latitude`='".$latitudeVal."',`longitude`='".$longitudeVal."' WHERE `id`='".$userId."'");
   if ($updateLocation) 
   {
       echo "success";
   }
   else
   {
    echo "Something error from server side..!";
}
}


// checkPassword
if ($_POST['check']=="checkPassword") 
{
    $userId=$_POST['userId'];
    $oldPassword=md5($_POST['oldPassword']);
    $passwordDate=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `password` FROM `users` WHERE `id`='$userId'"));
    if($oldPassword!=$passwordDate['password'])
    {
        echo "Password Doesn't Match...!";
    }
}


// changePassword
if($_POST['check']=="changePassword")
{
    $userId=$_POST['userId'];
    $newPassword=md5($_POST['newPassword']);
    $updatePassword=mysqli_query($conn, "UPDATE `users` SET `password`='$newPassword' WHERE `id`='$userId'");
    if($updatePassword)
    {
        echo "success";
    }
    else
    {
        echo "Something is Wrong..!";
    }

}

// userInfoUpdate
if($_POST['check']=="userInfoUpdate")
{
    $phoneUp=$_POST['phoneUp'];
    $emailUp=$_POST['emailUp'];
    $lastNameUp=$_POST['lastNameUp'];
    $firstNameUp=$_POST['firstNameUp'];
    $userIdUp=$_POST['userIdUp'];

    $userInfoUpdate=mysqli_query($conn, "UPDATE `users` SET `phoneNumber`='$phoneUp',`firstName`='$firstNameUp',`lastName`='$lastNameUp',`emailAddress`='$emailUp' WHERE id='$userIdUp'");
    if($userInfoUpdate)
    {
        echo "success";
    }
    else
    {
        echo "Something is wrong..!";
    }
}
?>