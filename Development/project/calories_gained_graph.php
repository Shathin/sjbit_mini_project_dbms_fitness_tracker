<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel = "stylesheet" href = "login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <title>Login</title>
  
    <style>
        .graph{
            padding-left: 20%;
            width: 40%;
            height: 600%;
        }
        .content{
            background-image: none;
            height: 100%;
        }
        
    </style>
    <?php
        $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $db = "fitness";
                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $db);
                                // Check connection
                                    session_start();
                                $u=$_SESSION["user"];
                                $sql = "select user_id from user where user_name = '$u'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $uid=$row['user_id'];
                                    }
                                   
                                        }
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
       //$array=array("day 1","day 2","day 3","day 4","day 5","day 6");
        //$array1=array(40,45,50,55,60,30);

//    $arrlength = count($array);
//    $array1 = array();
//    foreach($array as $x) {
//    echo $x;
//}
    ?>
  <title>Graph</title>
</head>
<body>
    <div class="header">
            <h1>Fitness.<i>com</i></h1>
        </div>
        <div class="content">
            <div class="graph">
                <canvas id="myChart"></canvas>
            </div>

  <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 12;
    Chart.defaults.global.defaultFontColor = '#777';
      var array = <?php echo json_encode($array); ?>;
      var array1 = <?php echo json_encode($array1); ?>;
    let massPopChart = new Chart(myChart, {
      type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:array,
        datasets:[{
          label:'Calories(Kcal)',
          data:array1,
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Calories Gained Graph',
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
</body>
</html>
