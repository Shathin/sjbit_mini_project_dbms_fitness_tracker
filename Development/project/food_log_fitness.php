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
                font-size: 20px;
                font-family: sans-serif;
                border: 1px solid #ddd;
                padding: 8px;
            }
            #disp tr:nth-child(even){
                background-color: white;
                
            }
        </style>
    </head>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
  <a href="<?php echo 'food_tracker_fitness.php"?'.SID;?> "> <button class="tablinks">Food Tracker</button></a>
  <a href="<?php echo 'exercise_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>"><button class="tablinks">Body Tracker</button></a>
  <a href="<?php echo 'analysis_fitness.php?'.SID;?>" ><button class="tablinks">Analysis</button></a>
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>"><button class="tablinks">Workout Log</button></a>
  <button class="tablinks" onclick="openContent(event, 'foodlog')" id="openDefault">Food Log</button>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
<div id="foodlog" class="tabcontent tabcontent-foodlogcontent">
     <table>
         <tr><td class="reducewidth">
             <form action="food_log_fitness.php" method="post">
        <table class="fix">
            <tr>
                <td>
                    <div class="minibox first opacity col1" >
                        <h3>Filter</h3>
                    <ul style="list-style-type:none">
                            <li><h4>From:</h4></li>
                            <li><input type="text" class="datepicker" name="from"></li>
                            <li><h4>To:</h4></li>
                            <li><input type="text" class="datepicker" name="to"></li>
                    </ul><br>
                        <input type="submit" value="Filter" name="s">
                    </div>
                    </td>
            </tr>
          </table></form></td>
    
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
                                  
                                $to = date("Y/m/d", strtotime($t));?>
                                        
                              
                            <tr><th>Date</th>
                                <th>Food Category</th>
                                <th>Food Name</th>
                                <th>Quantity</th>
                                <th>Calories Gained</th>
                            </tr>
                             <?php
                               
                                 
//                                 $t = DateTime::createFromFormat("m/d/Y" , $t);
//                                 $to= $t->format('Y/m/d');    
                                        // 31.07.2012
//                                    echo $date->format('d-m-Y'); // 31-07-2012
//                                    $to = new DateTime($t);
//                                    $to->format('y.m.d');
                                  
                                $sql="select log_date, category_name, food_name, amount_g, calories_consumed from food_category_db as cdb, food_db as db, food_log as log where db.food_id = log.food_id and cdb.category_id = db.food_category_id and user_id = '$uid' and log_date between '$from' and '$to'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo ' <tr><td>'.$row['log_date'].'</td><td>'.$row['category_name'].'</td><td>'.$row['food_name'].'</td><td>'.$row['amount_g'].' g'.'</td><td>'.$row['calories_consumed'].'</td></tr> ';
                                        
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