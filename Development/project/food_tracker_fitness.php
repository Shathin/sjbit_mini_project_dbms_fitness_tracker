<!doctype html>
<html><?php 
    session_start();
    if($_SESSION["flag1"]==1){
    $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "fitness";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                 $fcat="";
     $u=$_SESSION["user"];
    ?>
<title>Welcome</title>
    <head>
        <link rel="stylesheet" href="post_login.css">
        
    </head>
    <body>
        <div class="top">
            <span><h1>Fitness.<i>com</i></h1></span><div class="tab">
                
  <button class="tablinks" onclick="openContent(event, 'ftracker')" id="openDefault" >Food Tracker</button>
  <a href="<?php echo 'exercise_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Body Tracker</button></a>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>"><button class="tablinks">Workout Log</button></a>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>"><button class="tablinks">Food Log</button></a>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
  <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
</div>
<div id="ftracker" class="tabcontent tabcontent-ftrackercontent">
      <div class="box">
         <form action="food_tracker_fitness.php" method="post">
                  <table>
                      <tr><td></td><td>Choose Food Category</td><td></td></tr>
                      <tr><td><input type="submit" value="Cereals" name="cereals"/></td><td><input type="submit" value="Chocolates" name="choco"/></td><td><input type="submit" value="Dry Fruits" name="dryf"/></td></tr>
                      <tr><td><input type="submit" value="Vegetables" name="veg"/></td><td><input type="submit" value="Fruits" name="fruits"/></td><td><input type="submit" value="Dairy" name="dairy"/></td></tr>
                      <tr><td></td><td><input type="submit" value="Meat" name="meat"/></td><td><td></td></tr>
             
             <tr><td>
                Food
                 <select name="food">
             <?php 
                    
                 if(isset($_POST['cereals'])){
                    $fcat="cereals";
                    $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['choco'])){
                    $fcat="Chocolate";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['dryf'])){
                    $fcat="Dry Fruits";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['veg'])){
                    $fcat="Vegetables";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['fruits'])){
                    $fcat="Fruits";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['dairy'])){
                    $fcat="Dairy";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             if(isset($_POST['meat'])){
                    $fcat="Meat";
                 $_SESSION["food_cat"]=$fcat;
                    $sql = "SELECT food_name FROM FOOD_db where food_category_id in(select category_id from food_category_db where category_name='$fcat')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["food_name"].'">'.$row["food_name"].'</option>';
                                    }
                                }
}
             ?>
             
                 </select><td>Amount <input type="text" name="amt" placeholder="Enter values in grams"></td>
                 <td><input type="submit" value="Submit" name="s"/></td>
                     <?php  
        if(isset($_POST['s'])){
                    
                     $sql = "select user_id from user where user_name = '$u'";
                     $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                   
                                        }
                    $food=$_POST['food'];
                    $sql = "select food_id from food_db where food_name = '$food'";
                        $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $fid=$row['food_id'];
                                        
                                    }
                                   
                                        }
                        $amt=$_POST['amt'];
                        $sql= "insert into food_log (user_id,food_id,amount_g) values ('$uid','$fid','$amt')";
                           if ($conn->query($sql) === TRUE) {
                               echo "New record created successfully";
                           } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                           }
                        $sql="call cal_gained";
                        $conn->query($sql);
                        $sql="call cal_gained_graph('$uid',CURRENT_DATE())";
                        $conn->query($sql);
        }
        
        ?>
             </table>
    
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