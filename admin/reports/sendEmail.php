<?php 
require '../../PHPMailer/PHPMailerAutoload.php';
session_start();
include "../../libs/db_conn.php";
function send_email($receiver_mail, $subject, $message_body)
{
    $mail = new PHPMailer;
	$mail->SMTPDebug = 0;
	$mail->isHTML(true);
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->Username = "mdramzanroni76@gmail.com";
	$mail->Password = "gbdhatvhokzseifh";  
	$mail->setFrom("mdramzanroni76@gmail.com", "Emergency Support Service");
	$mail->addAddress($receiver_mail);
    // if ($_FILES['file']) {
	// 	$mail->addAttachment($uploadfile, $file);
	// }
	$mail->Subject = $subject;
	$mail->Body =  stripslashes($message_body);
    if($mail->Send()) {
        return "success";
     }
     else
     {
         return $mail->ErrorInfo;
         // return "Email Not Send";
     }
}
if($_POST['check']=="sendEmailForNewUser")
{
    if($_POST['receiverEmail']!=null && $_POST['subject']!=null && $_POST['message_body']!=null)
    {
        $receiver_mail=$_POST['receiverEmail'];
        $subject=$_POST['subject'];
        $message_body=$_POST['message_body'];
        echo $sendingResult=send_email($receiver_mail, $subject,  $message_body);
    }
    else
    {
        echo "Please Provide All Input Data...";
    }
}

if($_POST['check']=="supervisorRegistrationLinkGenerate")
{
    $uniqueId=uniqid();
    $supervisorID=$_POST['supervisorID'];
    // $ipaddress = getenv("REMOTE_ADDR") ;
    // $ipaddress = $_SERVER['REQUEST_URI'];
    $tokenInsert=mysqli_query($conn, "INSERT INTO `supervisor_token`(`token`,`supervisor_id`) VALUES ('$uniqueId', '$supervisorID')");
    if($tokenInsert)
    {
        echo $userLink="http://localhost/Emergency_Support_Service/admin/supervisor_registration.php?token=".$uniqueId."&&id=".$supervisorID;
    }
    
}
?>