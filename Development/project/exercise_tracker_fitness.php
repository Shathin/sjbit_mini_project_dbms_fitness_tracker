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
                $ecat="";
    $u=$_SESSION["user"];
    ?>
<title>Welcome</title>
    <head>
        <link rel="stylesheet" href="post_login.css">
        
    </head>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
  <a href="<?php echo 'food_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Food Tracker</button></a>
  <button class="tablinks" onclick="openContent(event, 'etracker')" id="openDefault">Exercise Tracker</button>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Body Tracker</button></a>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>"><button class="tablinks">Workout Log</button></a>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>"><button class="tablinks">Food Log</button></a>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
</div>
<div id="etracker" class="tabcontent tabcontent-etrackercontent">
      <div class="box">
         <form action="exercise_tracker_fitness.php" method="post">   
              <table>
                      <tr><td></td><td>Choose Exercise Category</td><td></td></tr>
                      <tr><td><input type="submit" value="Cardio" name="cardio" onClick="opencardio()"/></td><td><input type="submit" value="Back" name="back"/></td><td><input type="submit" value="Biceps" name="biceps"/></td></tr>
                      <tr><td><input type="submit" value="Abdominals" name="abdominals"/></td><td><input type="submit" value="Chest" name="Chest"/></td><td><input type="submit" value="Forearms" name="forearms"/></td></tr>
                      <tr><td><input type="submit" value="Shoulder" name="shoulder"/></td><td><input type="submit" value="Legs" name="legs"/></td><td><input type="submit" value="Triceps" name="triceps"/></td></tr>
             
                  <tr></tr>
                  <tr><td></td><td>Workout
                 <select name="exercise">
                
             
                  <?php 
                 if(isset($_POST['cardio'])){
                    $ecat="cardio";
                    $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Time <input type="text" name="time"></td><td></td><td>Distance <input type="text" name="dist"></td></tr>
                  <?php
}
             
             if(isset($_POST['back'])){
                    $ecat="back";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             if(isset($_POST['biceps'])){
                    $ecat="biceps";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             if(isset($_POST['abdominals'])){
                    $ecat="abdominals";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             if(isset($_POST['Chest'])){
                    $ecat="Chest";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             if(isset($_POST['forearms'])){
                    $ecat="forearms";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             if(isset($_POST['shoulder'])){
                    $ecat="shoulder";
               $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
                  if(isset($_POST['legs'])){
                    $ecat="legs";
                    $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
                  if(isset($_POST['triceps'])){
                    $ecat="triceps";
                    $_SESSION["e_cat"]=$ecat; 
                    $sql = "SELECT exercise_name FROM exercise_db where exercise_category_id in(select category_id from exercise_category_db where category_name='$ecat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["exercise_name"].'">'.$row["exercise_name"].'</option>';
                                    }
                                }?></select></td><td></td></tr><tr><td>Weights <input type="text" name="weight"></td><td>Sets <input type="text" name="sets"></td><td>Reps <input type="text" name="reps"></td></tr>
                  <?php
}
             ?>
                  
<?php
          
                      ?>

             
                 
                 <tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>
             </table>                  
          </form>
            <?php
                if(isset($_POST['submit'])){
                    $ecat=$_SESSION["e_cat"];
                     $sql = "select user_id from user where user_name = '$u'";
                        $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                   
                                        }
                    $exercise=$_POST['exercise'];
                    $sql = "select exercise_id from exercise_db where exercise_name = '$exercise'";
                        $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $exid=$row['exercise_id'];
                                        
                                    }
                                   
                                        }
                        
                    if($ecat=='cardio'){
                        $time=$_POST['time'];
                        $dist=$_POST['dist'];
                        $sql="insert into cardio_exercise_log (user_id,exercise_id,distance,time) values('$uid','$exid','$dist','$time')";
//INSERT INTO `exercise_log` (`log_entry_id`, `user_id`, `log_date`, `exercise_id`, `distance`, `time`, `weights`, `sets`, `reps`, `calories_burnt`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                           if ($conn->query($sql) === TRUE) {
                               echo "New record created successfully";
                           } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                           }
                        $sql="call cal_burnt_cardio";
                        $conn->query($sql);
                        $sql="call cal_burnt_graph('$uid',CURRENT_DATE())";
                        $conn->query($sql);
                                 }
                    else{
                        $weight=$_POST['weight'];
                        $sets=$_POST['sets'];
                        $reps=$_POST['reps'];
                        $sql="insert into strength_exercise_log (user_id,exercise_id,weights,sets,reps) values('$uid','$exid','$weight','$sets','$reps')";
                            if ($conn->query($sql) === TRUE) {
                               echo "New record created successfully";
                           } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                           }
                        $sql="call cal_burnt_strength";
                        $conn->query($sql);
                        $sql="call cal_burnt_graph('$uid',CURRENT_DATE())";
                        $conn->query($sql);
                    }
                }

            
                ?>
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