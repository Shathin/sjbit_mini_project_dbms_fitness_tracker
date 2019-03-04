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
                //session_start();
    //$u=$_SESSION["user"];
    ?>
<title>Welcome</title>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel = "stylesheet" href = "post_login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  </script>
        <link rel="stylesheet" href="post_login.css">
        <style>
            .graph{
            padding-left: 1%;
            width: 90%;
            height: 700%;
        }
        .content{
            background-image: none;
            height: 100%;
        }
            .tabl{
                margin-left: -4%;
                width: 100%;
            }    
        </style>
    </head>
    <?php
       
                                // Check connection
                                $u=$_SESSION["user"];
                                $sql = "select user_id from user where user_name = '$u'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                   
                                        }
                            if(isset($_POST['c_b'])){
                                $txt="Calories Burnt";
                                $label ="Calories";
                                $sql = "select c_date from CALORIES_BURNT_GRAPH where user_id='$uid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $array[] = explode(", ", $row['c_date']);
                                    }
                                }
                                $sql = "select total_burnt_calories from CALORIES_BURNT_GRAPH where user_id='$uid'";
                                $result = $conn->query($sql);
  
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_array(MYSQLI_NUM)) {
                                       //$a1[$x] = $row[$x++];
                                        $array1[] = $row[0];
                                    }
                                }
                            }
    
    if(isset($_POST['c_g'])){
        $label ="Calories";
        $txt="Calories Gained";
                                $sql = "select c_date from CALORIES_GAINED_GRAPH where user_id='$uid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $array[] = explode(", ", $row['c_date']);
                                    }
                                }
                                $sql = "select total_gained_calories from CALORIES_GAINED_GRAPH where user_id='$uid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_array(MYSQLI_NUM)) {
                                       //$a1[$x] = $row[$x++];
                                        $array1[] = $row[0];
                                    }
                                }
                            }
    
    if(isset($_POST['w_c'])){
        $label ="Weight";
        $txt="Weight Change";
                                $sql = "select log_date from weight_log where user_id='$uid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $array[] = explode(", ", $row['log_date']);
                                    }
                                }
                                $sql = "select weight_kg from weight_log where user_id='$uid'";
                                $result = $conn->query($sql);
  
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_array(MYSQLI_NUM)) {
                                       //$a1[$x] = $row[$x++];
                                        $array1[] = $row[0];
                                    }
                                }
       //$array=array("day 1","day
                            }
    
    if(isset($_POST['f_p'])){
        $label ="Fat %";
        $txt="Fat Percentage";
                                $sql = "select log_date from fat_log where user_id='$uid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       $array[] = explode(", ", $row['log_date']);
                                    }
                                }
                                $sql = "select fat_p from fat_log where user_id='$uid'";
                                $result = $conn->query($sql);
  
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_array(MYSQLI_NUM)) {
                                       //$a1[$x] = $row[$x++];
                                        $array1[] = $row[0];
                                    }
                                }
                            }
    
    
       //$array=array("day 1","day 2","day 3","day 4","day 5","day 6");
        //$array1=array(40,45,50,55,60,30);

//    $arrlength = count($array);
//    $array1 = array();
//    foreach($array as $x) {
//    echo $x;
//}
    ?>
    <body>
        <div class="top">
            <span><a href="food_tracker_fitness.php"><h1>Fitness.<i>com</i></h1></a></span><div class="tab">
                
   <a href="<?php echo 'food_tracker_fitness.php"?'.SID;?> "><button class="tablinks">Food Tracker</button></a>
  <a href="<?php echo 'exercise_tracker_fitness.php?'.SID;?>" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="<?php echo 'body_tracker_fitness.php?'.SID;?>"><button class="tablinks">Body Tracker</button></a>
  <button class="tablinks"  onclick="openContent(event, 'foodlog')" id="openDefault">Analysis</button>        
  <a href="<?php echo 'workout_log_fitness.php?'.SID;?>" ><button class="tablinks">Workout Log</button></a>
  <a href="<?php echo 'food_log_fitness.php?'.SID;?>"><button class="tablinks">Food Log</button></a>
  <a href="<?php echo 'profile_fitness.php?'.SID;?>" ><button class="tablinks">Profile</button></a>
            <a href="<?php echo 'logout_fitness.php?'.SID;?>"><button>Logout</button></a>
</div>
<div id="foodlog" class="tabcontent tabcontent-analysiscontent">
     <table>
         <tr><td class="reducewidth">
             <form action="analysis_fitness.php" method="post">
        <table class="fix">
            <tr>
                <td>
                    <div class="minibox first opacity col1" >
                        <table class="tabl">
                            <th><h3>Graphs</h3></th>
                            <tr><td><input type="submit" value="Calories Burnt" name="c_b"></td></tr>
                            <tr><td><input type="submit" value="Calories Gained" name="c_g"></td></tr>
                            <tr><td><input type="submit" value="Fat Percentage" name="f_p"></td></tr>
                            <tr><td><input type="submit" value="Weight Change" name="w_c"></td></tr>
                        </table>
                    </div>
                    </td>
            </tr>
          </table>
             </form>
             </td>
    
                <td><table class="fix">
            <tr>
                <td><div class="minibox first opacity col2" >
                   <div class="scroll"> <div class="graph">
                <canvas id="myChart"></canvas>
                       </div></div>
                    </div>
                    </td>
            </tr>
          </table></td></tr></table>
    
                
    <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 13;
    Chart.defaults.global.defaultFontColor = '#FFF';
      var array = <?php echo json_encode($array); ?>;
      var array1 = <?php echo json_encode($array1); ?>;
    let massPopChart = new Chart(myChart, {
      type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:array,
        datasets:[{
          label:<?php echo json_encode($label); ?>,
         fontColor:'white',
          data:array1,
          //backgroundColor:'green',
          
          borderWidth:2,
          borderColor:'#FFF',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:<?php echo json_encode($txt);?>,
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
  </script>
      
</div>
        </div>
        <div class="footer">
            <table>
                <tr>
                     <th><h4><a href="contactus.php">Contact Us</a></h4></th>
                    <th><h4><a href="aboutus.php">About Us</a></h4></th>
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