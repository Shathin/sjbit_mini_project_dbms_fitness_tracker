<!DOCTYPE html>
<html>
   
    <?php session_start();
    $_SESSION["flag"] = 0;
    $_SESSION["flag1"] = 0;
    ?>
<title>Login</title>
    <head>
    <link rel = "stylesheet" href = "login.css">
    </head>
    <body>
        <div class="header">
            <h1>Fitness.<i>com</i></h1>
        </div>
        <div class="content">
            <div class="box">
                <h2>Login</h2>
                <form action="login.php" method="post">                
                    <table>
                        <tr>
                            <td>User Name</td>
                            <td><input type="text" name="username" placeholder="Enter username"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr><td></td>
                            <td><input type="submit" name="login" value="Log in"></td>
                        </tr>
                        <tr><td><a href="forgot_password.php">Forgot password</a></td>
                            <td>New User? <a href="signup.php">Sign Up</a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                            <?php
            if(isset($_POST['login'])){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "fitness";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                $uname = $_POST['username'];
                $pwd = $_POST['password'];
                $sql = "select user_name, password from user where user_name='$uname' and password='$pwd'";
                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    
                                    $_SESSION["flag"] = 1;
                                    $_SESSION["flag1"] = 1;
                                    $_SESSION["user"] = $uname;
                                    header ("location: /project/food_tracker_fitness.php?".SID);
                                    }
                                else{
                                    echo 'Invalid Username or password';
                                }
                }
                 
            
        ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>    
        </div>
        
        <div class="header">
            <table class="footer">
                <tr>
                    <td><h4><a href="contactus.php">Contact Us</a></h4></td>
                    <td><h4><a href="aboutus.php">About Us</a></h4></td>
                </tr>
            </table>
        </div>

    </body>
</html>