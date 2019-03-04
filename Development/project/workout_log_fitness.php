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
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  </script>
        <link rel="stylesheet" href="post_login.css">
        <style>
            li{
                text-align: justify;
            }
            .scroll{
                margin-left: 5%;
                margin-top: 5%;
                height: 80%;
                width: 90%;
                overflow: auto;
            }
            #disp th,#disp td{
                font-size: 17px;
                font-family: sans-serif;
                border: 1px solid #ddd;
                padding: 8px;
            }
            #disp tr:nth-child(even){
                background-color: white;
                
            }
            b{
                color: white;
                font-family: sans-serif;
            }
            
        </style>
    </head>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
   <a href="<?php echo 'food_tracker_fitness.php"?'.SID;?> "><button class="tablinks">Food Tracker</button></a>
  <a href="<?php echo 'exercise_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>"><button class="tablinks">Body Tracker</button></a>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <button class="tablinks"  onclick="openContent(event, 'foodlog')" id="openDefault">Workout Log</button>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>"><button class="tablinks">Food Log</button></a>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
<div id="foodlog" class="tabcontent tabcontent-workoutlogcontent">
     <table>
         <tr><td class="reducewidth">
             <form action="workout_log_fitness.php" method="post">
        <table class="fix">
            <tr>
                <td>
                    <div class="minibox first opacity col1" >
                        <h3>Filter</h3>
                    <ul style="list-style-type:none">
                            <li><h4>From:</h4><input type="text" class="datepicker" name="from"> </li>
                            <li><h4>To:</h4><input type="text" class="datepicker" name="to"></li>
                            <li>&nbsp;</li>
                            <li><input type="radio" name="cat" value="cardio"><b>Cardio</b></li>
                            <li><input type="radio" name="cat" value="strength"><b>Strength</b></li>
                    </ul><br>
                        <input type="submit" value="Filter" name="s">
                    </div>
                    </td>
            </tr>
          </table>
             </form>
             </td>
    
                <td><table class="fix">
            <tr>
                <td><div class="minibox first opacity col2" >
                    <div class="scroll">
                          <table id="disp">
                            <?php 
                              
                              if(isset($_POST['s'])){
                                  $sql = "select user_id from user where user_name = '$u'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                
                                 }
                                $f=$_POST['from']; 
                                $t=$_POST['to'];  
                                
                                $from = date("Y/m/d", strtotime($f));
                                  
                                $to = date("Y/m/d", strtotime($t));
                                    if($_POST['cat']=='strength'){?>
                                        
                              
                            <tr><th>Date</th>
                                <th>Workout Category</th>
                                <th>Exercise Name</th>
                                <th>Weights</th>
                                <th>Sets</th>
                                <th>Reps</th>
                                <th>Calories Burnt</th>
                            </tr>
                             <?php
                               
                                 
//                                 $t = DateTime::createFromFormat("m/d/Y" , $t);
//                                 $to= $t->format('Y/m/d');    
                                        // 31.07.2012
//                                    echo $date->format('d-m-Y'); // 31-07-2012
//                                    $to = new DateTime($t);
//                                    $to->format('y.m.d');
                                  
                                $sql="select log_date, category_name, exercise_name, weights, sets, reps, calories_burnt from exercise_category_db as cdb, exercise_db as db, strength_exercise_log as log where db.exercise_id = log.exercise_id and cdb.category_id = db.exercise_category_id and user_id = '$uid' and log_date between '$from' and '$to'"; 
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo ' <tr><td>'.$row['log_date'].'</td><td>'.$row['category_name'].'</td><td>'.$row['exercise_name'].'</td><td>'.$row['weights'].' kg'.'</td><td>'.$row['sets'].'</td><td>'.$row['reps'].'</td><td>'.$row['calories_burnt'].'</td></tr>';
                                        
                                    }
                                   
                                        }
                                    }
                                elseif($_POST['cat']=='cardio'){?>
                                        
                              
                            <tr><th>Date</th>
                                <th>Workout Category</th>
                                <th>Exercise Name</th>
                                <th>Time</th>
                                <th>Distance</th>
                                <th>Calories Burnt</th>
                            </tr>
                             <?php
                                 
//                                 $t = DateTime::createFromFormat("m/d/Y" , $t);
//                                 $to= $t->format('Y/m/d');    
                                        // 31.07.2012
//                                    echo $date->format('d-m-Y'); // 31-07-2012
//                                    $to = new DateTime($t);
//                                    $to->format('y.m.d');
                                  
                                $sql="select log_date, category_name, exercise_name, time, distance, calories_burnt from exercise_category_db as cdb, exercise_db as db, cardio_exercise_log as log where db.exercise_id = log.exercise_id and cdb.category_id = db.exercise_category_id and user_id = '$uid' and log_date between '$from' and '$to'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo ' <tr><td>'.$row['log_date'].'</td><td>'.$row['category_name'].'</td><td>'.$row['exercise_name'].'</td><td>'.$row['time'].' minutes'.'</td><td>'.$row['distance'].' meters'.'</td><td>'.$row['calories_burnt'].'</td>';
                                        
                                    }
                                   
                                        }
                                    }
                                
                              }
                              
                              ?>
                        </table>
                    </div>    
                    </div>
                    </td>
            </tr>
          </table></td></tr></table>
    
                
    
      
</div>
        </div>
        <div class="top">
            <table>
                <tr>
                     <th><h4><a href="contactus.html">Contact Us</a></h4></th>
                    <th><h4><a href="aboutus.html">About Us</a></h4></th>
                </tr>
            </table>
        </div>
    </body>
<script>
    document.getElementById("openDefault").click();
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