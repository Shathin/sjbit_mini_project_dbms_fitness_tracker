<!DOCTYPE html>
<html>
<title>Forgot password</title>
    <head>
    <link rel = "stylesheet" href = "login.css">
    </head>
    <body>
        <div class="header">
            <h1>Fitness.<i>com</i></h1>
        </div>
        <div class="content">
            <div class="box">
                <h2>Forgot your password?</h2>
                <form action="forgot_password.php" method="post">                
                    <table>
                        <tr>
                            <td>E-mail ID</td>
                            <td><input type="text" name="email" placeholder="Enter your registered E-mail ID"></td>
                        </tr>
                        <tr><td></td>
                            <td><input type="submit" name="sendmail" placeholder="submit">&nbsp;&nbsp;<input type="submit" name="login" value="Log In"></td>
                        </tr>
                        <tr><td></td>
                            <td>
                                <?php
                                    if(isset($_POST['sendmail'])){
                                        $email=$_POST['email'];
                                      $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "fitness";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                                        $sql="";
                                        $result=$conn->query($sql);
                                        if($result->num_rows > 0){
                                            $sql="";
                                        $r=$conn->query($sql);
                                        $row=$r->fetch_assoc();
                                        $p=$row['password'];
if(!class_exists('PHPMailer')) {
    require('class.phpmailer.php');
	require('class.smtp.php');
}


$mail = new PHPMailer();

$emailBody = "your Password is: ".$p;

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
//$mail->SMTPSecure = "tls";shathin.rao@gmail.com
$mail->Port     = '465';  
$mail->Username = 'sanjay.ts1997@gmail.com';
$mail->Password = 'viap4m8001009';
$mail->Host     = 'ssl://smtp.gmail.com';
//$mail->Mailer   = MAILER;

$mail->SetFrom('sanjay.ts1997@gmail.com', 'sanjay');
$mail->AddReplyTo('sanjay.ts1997@gmail.com', 'sanjay');
$mail->ReturnPath='sanjay.ts1997@gmail.com';	
$mail->AddAddress($email);
$mail->Subject = "Forgot Password Recovery";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	echo 'Problem in Sending Password Recovery Email';
} else {
	echo 'Please check your email to reset password!';
}


                                        }
                                        else{
                                            echo 'No account exists with this E-mail';
                                        }
                                    }
                                if(isset($_POST['login'])){
                                    header ("location: /project/login.php");
                                }
                                    
                                ?>
                            </td></tr>
                    </table>
                </form>
            </div>    
        </div>
        <div class="header">
            <table class="footer">
                <tr>
                     <th><td><h4><a href="contactus.php">Contact Us</a></h4></td></th>
                    <th><td><h4><a href="aboutus.php">About Us</a></h4></td></th>
                </tr>
            </table>
        </div>

    </body>

</html>