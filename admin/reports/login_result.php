<?php  
    session_start();
    include "../../libs/db_conn.php";
    if(isset($_POST['admin_username']) && !empty($_POST['admin_username']) && isset($_POST['admin_password']))
    {
       $admin_username=$_POST['admin_username'];
       $admin_password=$_POST['admin_password'];
       $check_admin="SELECT * FROM `admin` WHERE `user_name`='$admin_username' AND `password`='$admin_password' AND`status`='1'";
       $check_admin_result=mysqli_num_rows(mysqli_query($conn, $check_admin));
       if($check_admin_result==1)
       {
           $_SESSION['admin_username']=$admin_username;
           echo "success";
       }
    }
    else
    {
        echo "Please Provide Valid Data";
    }
?>