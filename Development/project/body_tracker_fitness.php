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
             
                $u=$_SESSION["user"];
    ?>
<title>Welcome</title>
    <head>
        <link rel="stylesheet" href="post_login.css">
        <style>
            .padtop{
                margin-top: 10%;
            }
        </style>
    </head>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
  <a href="<?php echo 'food_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Food Tracker</button></a>
  <a href="<?php echo 'exercise_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <button class="tablinks" onclick="openContent(event, 'btracker')" id="openDefault">Body Tracker</button>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>"><button class="tablinks">Workout Log</button></a>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>"><button class="tablinks">Food Log</button></a>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
        </div>
<div id="btracker" class="tabcontent tabcontent-btrackercontent">
      <div class="box">
         <form action="body_tracker_fitness.php" method="post">
                    <table class="padtop">
                        <tr>
                            <td class="t">Weight</td><td class="t"><input type="text" name="weight" placeholder="Enter weight in kilograms"></td>
                            
                          <td class="t">Body Fat Percentage</td><td class="t"><input type="text" name="fpercentage" placeholder="Enter in percentage"></td></tr>
                    </table>
                    <table class="row1">
                      <tr><td class="space"><input type="submit" name="submit" value="Submit"></td></tr>
                    </table>
                    
          <?php
            if(isset($_POST['submit'])){
            $weight=$_POST['weight'];
            $fat=$_POST['fpercentage'];
                $sql = "select user_id from user where user_name = '$u'";
                        $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                   
                                        }
                $sql = "insert into fat_log (user_id,fat_p) values('$uid','$fat')";
                $x=$conn->query($sql);
                 $sql = "insert into weight_log (user_id,weight_kg) values ('$uid','$weight')";
                if ($conn->query($sql) && $x === TRUE) {
                    echo "Logged successfully";
                }
            }
          ?>
                </form>
      </div>
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