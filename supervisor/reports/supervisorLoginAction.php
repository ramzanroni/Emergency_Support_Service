<?php
session_start();
include "../../libs/db_conn.php";

    if($_POST['check']=="supervisorLogin")
    {
       $supervisor_username=$_POST['supervisor_username'];
       $supervisor_password=$_POST['supervisor_password'];
       $latitude=$_POST['latitude'];
       $longitude=$_POST['longitude'];
       if($supervisor_username=='')
       {
           echo "Please Provide Valid Login Information...!";
       }
       elseif ($supervisor_password=='') {
           echo "Please Provide Valid Login Information...!";
       }
       else
       {
           $decodePassword=md5($supervisor_password);
           $supervisorCheck=mysqli_query($conn, "SELECT * FROM `supervisors` WHERE `userName`='$supervisor_username' AND `password`='$decodePassword'");
           $supervisorCount=mysqli_num_rows($supervisorCheck);
           if($supervisorCount>0)
           {
               
                $supervisorData=mysqli_fetch_assoc($supervisorCheck);
                $_SESSION['supervisorUsername']=$supervisor_username;
                $_SESSION['firstName']=$supervisorData['firstName'];
                $_SESSION['serviceArea']=$supervisorData['serviceArea'];
                $_SESSION['userId']=$supervisorData['id'];
                $supervisorHistory=mysqli_query($conn, "INSERT INTO `live_supervisors`(`id`, `phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `supervisorDistrict`, `superviorUpazila`, `serviceArea`, `latitude`, `longitude`, `status`) VALUES ('".$supervisorData['id']."','".$supervisorData['phoneNumber']."','".$supervisorData['firstName']."','".$supervisorData['lastName']."','".$supervisorData['emailAddress']."','".$supervisorData['userName']."','".$supervisorData['password']."','".$supervisorData['dateOfBirth']."','".$supervisorData['nidPassport']."','".$supervisorData['supervisorDistrict']."','".$supervisorData['superviorUpazila']."','".$supervisorData['serviceArea']."','".$latitude."','".$longitude."','1')");
                $supervisorHistoryRecord=mysqli_query($conn, "INSERT INTO `history_supervisor`(`supervisor_id`, `super_name`, `login_status`) VALUES ('".$supervisorData['id']."','".$supervisorData['firstName']."','login')");
                if($supervisorHistory && $supervisorHistoryRecord)
                {
                    echo "success";
                }
                else
                {
                    echo "Somethig is wrong.";
                }
           }else{
               echo "Wrong Information..!";
           }

       }
    }

    if($_POST['check']=="supervisorInfoUpdate")
    {
        $phoneUp=$_POST['phoneUp'];
        $emailUp=$_POST['emailUp'];
        $lastNameUp=$_POST['lastNameUp'];
        $firstNameUp=$_POST['firstNameUp'];
        $supervisorIdUp=$_POST['supervisorIdUp'];

        $supervisorInfoUpdate=mysqli_query($conn, "UPDATE `supervisors` SET `phoneNumber`='$phoneUp',`firstName`='$firstNameUp',`lastName`='$lastNameUp',`emailAddress`='$emailUp' WHERE id='$supervisorIdUp'");
        if($supervisorInfoUpdate)
        {
            echo "success";
        }
        else
        {
            echo "Something is wrong..!";
        }
    }

    // checkPassword
    if($_POST['check']=="checkPassword")
    {
        $supervisorId=$_POST['supervisorId'];
        $oldPassword=md5($_POST['oldPassword']);
        $passwordDate=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `password` FROM `supervisors` WHERE `id`='$supervisorId'"));
        if($oldPassword!=$passwordDate['password'])
        {
            echo "Password Doesn't Match...!";
        }
    }

    // changePassword
    if($_POST['check']=="changePassword")
    {
        $supervisorId=$_POST['supervisorId'];
        $newPassword=md5($_POST['newPassword']);
        $updatePassword=mysqli_query($conn, "UPDATE `supervisors` SET `password`='$newPassword' WHERE `id`='$supervisorId'");
        if($updatePassword)
        {
            echo "success";
        }
        else
        {
            echo "Something is Wrong..!";
        }

    }
?>