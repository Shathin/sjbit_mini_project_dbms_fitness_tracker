<!DOCTYPE html>
<html>
<title>Sign up</title>
    <head>
    <link rel = "stylesheet" href = "signup.css">
    </head>
    <body>
        <div class="header">
            <a href="login.php"><h1>Fitness.<i>com</i></h1></a>
        </div>
        <div class="content">
            <div class="box">
                <h2>Welcome to Fitness.<i>com</i></h2>
                <form action="signup.php" method="post">                
                    <table>
                        <tr>
                            <td>First Name</td>
                            <td><input type="text" name="firstname" placeholder="Enter your first name" required></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type="text" name="lastname" placeholder="Enter your last name" required></td>
                        </tr>
                         <tr>
                            <td>Age</td>
                            <td><input type="number" name="age" placeholder="Enter your age" required></td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><input type="text" name="email" placeholder="Enter your Email-id" required></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td><input type="text" name="username" placeholder="Enter your username" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="pwd" placeholder="Enter your Password" required></td>
                        </tr>
                        <tr><td></td>
                            <td><input type="submit" name="signup" value="Sign Up">&nbsp;&nbsp;
                        </tr>
                    </table>
                </form>
<?php
        if(isset($_POST['signup'])){
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $email=$_POST['email'];
            $uname=$_POST['username'];
            $pwd=$_POST['pwd'];
            $age=$_POST['age'];
            $servername="localhost";
                                $username = "root";
                                $password = "";
                                $db = "fitness";
                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $db);
                                // Check connection
            $sql ="select user_name from user where user_name='$uname'";
            if($conn->query($sql)==TRUE){
                echo "This username is already taken.";
            }
            else{
                
            $sql = "insert into user (user_name,password,first_name,last_name,email,age) values('$uname','$pwd','$firstname','$lastname','$email','$age')";
            if ($conn->query($sql) === TRUE) {
                echo "Account created successfully";
                header ("location: /project/login.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }

        }        
     if(isset($_POST['login'])){
        header ("location: /project/login.php");
        }
?>
            </div>    
        </div>
        <div class="header">
            <table class="footer">
                <tr>
                    <th><h4><a href="contactus.php">Contact Us</a></h4></th>
                    <th><h4><a href="aboutus.php">About Us</a></h4></th>
                </tr>
            </table>
        </div>

    </body>
</html>