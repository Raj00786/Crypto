<?php session_start();


 if($_SESSION["name"]!=''){
   echo $_SESSION["name"];
   header('Location: que.php');
 }
 else{
   $_SESSION["name"]='';
   $_SESSION["score"]=0;
 }

  $date = date("H:i:s");
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Crypto | Techkriti 17</title>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8 ">
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
            right: 100px;
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
          #login{
            width: 100%!important;
            padding: 3px;
            cursor: pointer;
          }
          #time{
            width: 60%;
            margin:auto;
          }
        </style>
        <script type="text/javascript">
            $(function(){

                $('#login').on('click',function(){
                var username = $('#username').val();
                var password = $('#password').val();
                var dataString = "username="+username+"&pass="+password;
                $.ajax({
                      url: 'login.php',
                      data:dataString,   
                      type: 'POST',
                      dataType: "json",              
                      success: function(data){
                           if(data!='false'){
                               location.href = "que.php";
                           }
                           else{
                            console.log('not logged');
                           }
                      }
                });
            });
            })
        </script>
    </head>
    <body>
        <header>
            <div>
                <h1>Crypto 17</h1>
                <a href="leader_board.php">Leader Board</a>
            </div>
        </header>
        <main>
            <div class="container">
                <h2>Instruction:</h2>
                <ul>
                    <li><strong>Number of Questions: 8</strong></li>
                    <li><strong>Type: </strong>Multiple Choice</li>
                    <li><strong>Time: </strong>2 hours</li>
                </ul>
                <div style="font-size:20px;">Rules:</div>
                    <div>
                      <p>&rtrif;Read all the questions carefully.</p>
                    </div>
                     <div>
                      <p>&rtrif;Time alloted for competition is from 10:00pm to 00:00 am</p>
                    </div>
                     <div>
                      <p style='color:red;'>&rtrif;You can submit your answers only once so be careful while submitting you answer.You cannot go back.</p>
                    </div>
                     <div>
                      <p>&rtrif; You can skip maximum 2 questions and you are allowed to solve these skipped question later [within the alloted time]</p>
                    </div>
                     <div>
                      <p>&rtrif; Taking hint in question will reduce weightage of question to 40% of alloted marks</p>
                    </div>
                     <div>
                      <p>&rtrif;Contact us at software@techkriti.org</p>
                    </div>

                <form >
                    <div>
                      <label for="username">Username</label>
                      <input id="username" type="text" name="username">
                    </div>
                    <div>
                       <label for="password">Password</label>
                       <input id="password" type="password" name="password">
                    </div>
                    <div>
                      <input type="button" id="login" value="Login" name="login">
                    </div>
                </form>
            
            </div>
            <div id="time">

            </div>
        </main>
    </body>
</html>
