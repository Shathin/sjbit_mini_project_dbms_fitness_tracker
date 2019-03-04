<!doctype html>
<html>
    <?php
    session_start();
    if($_SESSION["flag1"]==1){
    $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "fitness";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                
    ?>
<title>Welcome</title>
    <head>
        <link rel="stylesheet" href="post_login.css">
        <style>
            ul{
                margin-top: 30%;
            }
        </style>
    </head>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
  <a href="<?php echo 'food_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Food Tracker</button></a>
  <a href="<?php echo 'food_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Body Tracker</button></a>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>" ><button class="tablinks">Workout Log</button></a>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>" ><button class="tablinks">Food Log</button></a>
  <button class="tablinks" onclick="openContent(event, 'uname')" id="openDefault">Profile</button> 
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
</div>
<div id="uname" class="tabcontent tabcontent-unamecontent">
    <table>
         <tr><td class="reducewidth">
        <table class="fix">
            <tr>
                <td><div class="minibox first opacity col1" >
                    <form action="profile_fitness.php" method="post">
                    <ul style="list-style-type:none">
                        <li class="left"><h3>Name: <?php echo $_SESSION['user']; ?></h3></li>
                        <li</li>
                        <li class="left"><h3>Username: <?php echo $_SESSION['user']; ?></h3></li>
                        <?php  
                        $u=$_SESSION['user'];
                            $sql = "SELECT age FROM user where user_name = '$u'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $age = $row['age']; 
                                    }
                                }
                        ?>
                        <li class="left"><h3>Age: <?php echo $age ?></h3></li>
                        <?php  
                            $sql = "SELECT email FROM user where user_name = '$u'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $email = $row['email']; 
                                    }
                                }
                        ?>                    
                        <li class="left"><h3>Email id: <?php echo $email; ?></h3></li>
                        <li class="left"><input type="submit" value="Delete Your Account" name="del"></li>
                    </ul></form></div>    
                    </td>
            </tr>
          </table>
             <?php
                        
                        if(isset($_POST['del'])){
//                           $sql ="SET FOREIGN_KEY_CHECKS=0";
//                           $conn->query($sql);
                           $sql="delete from user where user_name='$u'";
                           $conn->query($sql);
                           session_destroy();
                           header ("location: /project/login.php");
                        }
                    ?>
             </td>
        </tr></table>
    
      
</div>
<div class="footer">
            <table>
                <tr>
                    <td><h4><a href="contactus.php">Contact Us</a></h4></td>
                    <td><h4><a href="aboutus.php">About Us</a></h4></td>
                </tr>
            </table>
        </div>
    </body>
<script>
    document.getElementById("openDefault").click();
    document.getElementById("etracker").innerHTML = window.function(); 
    function openCardio(){
        document.getElementById("exercise").click();
    }
    function openContent(evt, contentName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(contentName).style.display = "block";
    evt.currentTarget.className += " active";
}
    
</script>
    <?php } ?>
</html>