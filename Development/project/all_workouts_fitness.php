<!doctype html>
<html>
<title>Welcome</title>
    <head>
        <link rel="stylesheet" href="post_login.css">
        
    </head>
    <body>
        <div class="top">
            <span><h1>Fitness.<i>com</i></h1></span><div class="tab">
                
   <a href="food_tracker_fitness.php" ><button class="tablinks">Food Tracker</button></a>
  <a href="exercise_tracker_fitness.php" ><button class="tablinks">Exercise Tracker</button></a>
  <a href="body_tracker_fitness.php"><button class="tablinks">Body Tracker</button></a>
  <a href="analysis_fitness.php" ><button class="tablinks">Analysis</button></a>
  <a href="workout_log_fitness.php"><button class="tablinks">Workout Log</button></a>
  <a href="workout_log_fitness.php"><button class="tablinks">Food Log</button></a>
  <button class="tablinks"  onclick="openContent(event, 'foodlog')" id="openDefault">All Workouts</button>
  <a href="profile_fitness.php" ><button class="tablinks">Profile</button></a>
            
</div>
<div id="foodlog" class="tabcontent tabcontent-foodlogcontent">
     <table>
         <tr><td class="reducewidth">
        <table class="fix">
            <tr>
                <td><div class="minibox first opacity col1" >
                    <form action="all_workouts_fitness.php" method="post">
                    <ul style="list-style-type:none">
                        <li><h2>Filter</h2></li>
                                <?php
                                $servername="localhost";
                                $username = "root";
                                $password = "";
                                $db = "db3";
                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $db);
                                // Check connection
                                $sql = "SELECT day FROM tb1";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                       echo '<li><input type="checkbox" value="'.row['day'].'" name="'.row['day'].'">'.$row['day'].'<li>';
                                    }
                                }
                            ?>
                        <li><input type="submit" value="Go" name="filter"></li>
                        </ul></form></div>
                    
                    </td>
            </tr>
          </table></td>
    
                <td><table class="fix">
            <tr>
                <td><div class="minibox first opacity col2" >
                    <ul style="list-style-type:none">
                        <li><h2>Food</h2></li>
                    </ul>    
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
</html>