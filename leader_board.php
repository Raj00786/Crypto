<?php include 'database.php';?>
<?php
 $ques_query ="UPDATE leader SET final_score=score-phint";
 $ques_result = mysqli_query($conn,$ques_query); 
 $total = mysqli_num_rows($ques_result);



 $ques_query ="SELECT * FROM leader ORDER BY final_score DESC,end_time ASC";
 $ques_result = mysqli_query($conn,$ques_query); 
 $total = mysqli_num_rows($ques_result);
  


?>
<!DOCTYPE html>
<html>
    <head>
    <title>Crypto | Techkriti 17</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="jquery.js"></script>
        <style type="text/css">
            body{
                background-color: #fafafa
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 60%;
                margin: auto;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            main{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <h1><a href="index.php">Crypto 17</a></h1>
            </div>
        </header>
        <main> 
           <marquee style="color: red">Leader board will be updated after completion of events</marquee>
 

            <table>
              <tr>
                <th>Rank</th>
               <th>Total Score(Max Marks - 215)</th>
              </tr>
                          <?php
                    $i=1;
                if (mysqli_num_rows($ques_result) > 0) {
                    while ($row = mysqli_fetch_assoc($ques_result)) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>'; 
                        // echo '<td>'.$row['techid'].'</td>'; 
                        // echo '<td>'.$row['name'].'</td>'; 
                        echo '<td>'.$row['final_score'].'</td>'; 
                        echo '</tr>';
                        $i++;
                    }
                }
            ?> 

            </table>            
        </main>
    </body>
</html>
