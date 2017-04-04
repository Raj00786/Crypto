<?php include 'database.php';?>
<?php session_start(); 
  if($_SESSION["name"]==''){
    header('Location: index.php');
  }

  $name=$_SESSION["name"];
  $skipnum=$_GET["skip"];
  $select_query ="SELECT * FROM leader WHERE name='$name'";  
  $select_result = mysqli_query($conn,$select_query); 
  $select  = mysqli_fetch_assoc($select_result);
  $skip1 = $select['skip'];
  $score = $select['score'];
  $points = $select['points'];
  $penalty = $select['penalty'];
  $skip = explode(",", $skip1);
  if($points!='8'){
    header('Location: index.php');
  }

?>
</!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8 ">
    <title>Crypto | Techkriti 17</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="jquery.js"></script>
    <style type="text/css">
        body{
            background-color: #fafafa
        }
      header>div{
         width: 60%;
        display: flex;
        margin: auto;
      }
      ul{
        position: relative;
      }
      ul a{
        position: absolute;
        background-color: blue;
        padding: 10px;
        color: white;
        border-radius: 5px;
      }
      header a{
         width: 20%;
        margin: auto;
        width: 100px;
        background-color: blue;
        color: white;
        padding: 11px;
        text-align: center;
        border-radius: 4px;
      }
      header h1{
         width: 70%;
      }
      form input{
        width: 75%!important;
      }
      form label{
        width: 25%;
      }
      form>div{
        display: flex;
        padding: 10px;
      }
      form{
        width: 60%;
        background-color: white;
        margin: auto;
        border-radius: 5px;
        padding: 15px;
      }
      #logout{
          width: 100px;
          background-color: blue;
          color: white;
          padding: 11px;
          text-align: center;
          border-radius: 4px;
          position: absolute;
          right: 10px;
          top: 10px;
        }
       #skipped li{
        width: 100px;
        position: relative!important;
      text-align: center;
          }
          #skipped{
              width: 60%;
              display: -webkit-inline-box;
            margin: auto;
                left: 30%;
          }
          .questions img{
                margin: auto;
      display: -webkit-box;
          }
          .container h1{
                line-height: 1em;
          }
    </style>  
</head>
<body>
    <header>
        <div>
            <h1>Crypto 17</h1>
            <a href="leader_board.php">Leader Board</a>
        </div>
    </header>
    <main>
        <div class="top">
          <a id="logout" href="logout.php">LOG OUT</a>
        </div>
        <div class="container">
               <h1>Congrats '<?php echo $name;?>' you have Successfully completed Crypto</h1>
<!--                <h2>Your score is '<?php echo $score;?>' </h2> 
 -->

               <marquee style='padding:10px;color: red'>Results will be updated in leader board after complition of events.</marquee>
        </div>
        <ul id="skipped">
            <?php
               if($skip1!=','){
                  echo'<li style="width:auto">You can attempt skipped Questions:</li>';                                  
               }
               if($skip[0]){
                  echo'<li><a href="que.php?skip='.$skip[0].'">Ques.'.$skip[0].'</a></li>'; 
               }
               if($skip[1]){                
                  echo'<li><a href="que.php?skip='.$skip[1].'">Ques.'.$skip[1].'</a></li>'; 
               }
             ?>
       </ul>
    </main>
</body>
</html>           