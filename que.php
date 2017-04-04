<?php include 'database.php';?>
<?php session_start(); 
  if($_SESSION["name"]==''){
    header('Location: index.php');
  }

  $date = date("H:i:s");
  if($date<="22:00:00"){
    $_SESSION["name"]='';
    header('Location: index.php');
  } 
    header('Location: logout.php');
// access at time only
  $name=$_SESSION["name"];
  $skipnum=$_GET["skip"];
  $select_query ="SELECT * FROM leader WHERE name='$name'";  
  $select_result = mysqli_query($conn,$select_query); 
  $select  = mysqli_fetch_assoc($select_result);
  $skip = $select['skip'];
  $penalty = $select['penalty'];
  $skip = explode(",", $skip);
  if((!$skipnum)&&($penalty==2)){
     $disp = 0;
  }
  else{
      $disp=1;
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
        textarea {
          width: 100%;
          height: 250px;
          border: 3px solid #cccccc;
          padding: 5px;
          font-family: Tahoma, sans-serif;
          background-position: bottom right;
          background-repeat: no-repeat;
        }
        #time{
          width: 200px;
          background-color: blue;
          text-align: center;
          padding: 10px;
          color: white;
          font-size: 30px;
          position: absolute;
        }
        #time strong{
          font-size: 20px;
          display: block;
          padding: 10px 0px;

        }
        #time p{
          font-size: 10px
        }
        .danger{
            color: red;
        }
        .right{
          background-color: green;
          padding: 12px;
          width: 100%;
        }
        .questions li{ 
         cursor:pointer;
         }
        .wrong{
          background-color: red;
          width: 100%;
          font-size: 20px;
          padding: 12px;
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
        .top{
          display: block;
          margin: auto;
        }
        .questions{
          padding: 15px;
          min-height: 300px;
        }
        .questions ul{
              margin-top: 30px;
        }
        .questions h3{
          font-weight: initial;
        }
        .questions strong{
          font-size: 20px;
        }
        .checked{
          background-color: green !important;
        }
        #on_click{
          width: 60%;
          margin: auto;
          text-align: -webkit-center;
        }
        #on_click input{
          pointer-events: initial;
          width: 40%;
          padding: 5px;
          font-size: 20px;
          cursor: pointer;
        }
        #skipped li{
      width: 100px;
    text-align: center;
    background-color: white;
        }
        #skipped{
           display: -webkit-inline-box;
        }
        .questions img{
              margin: auto;
    display: -webkit-box;
        }
        #hint{
          width: 100px;
          height: 40px;
          font-size: 20px;
          cursor: pointer;
        }


    </style>
    <script type="text/javascript">
        $(document).ready(function(){
             
             var next_btn = '<?php echo $disp; ?>';
             if(next_btn==1){
                  $('#runn1').show();
             }
             if(next_btn==0){
                  $('#runn1').hide();
             }

             $('#runn').css('pointer-events','initial');
 
             $(document.body).on('click','.questions ul li' ,function(){
                    $(this).toggleClass('checked');
              });
             var skipped ='<?php echo $skipnum; ?>';
             var dataString = "skip="+skipped;
            var start_time ='';
    	      $.ajax({
                url: "process.php", 
                type: 'POST',
                data:dataString,
                success: function(result){
                        if(result=='done'){
                             window.location.assign("done.php");
                        }
                        result = JSON.parse(result);
                        // console.log(result);
                        var list='';
                        $.each(result, function(k, v){  
                           if(k=='hint'){
                               if(result.hint==''){
                                              $('#hintt').hide();
                               } 
                           }
                           else if(k=='mess1'){
                             $(".questions h2").html(result.mess1);
                           }
                           else if(k=='img'){
                             $(".questions img").attr('src',result.img);                            
                           }
                           else if(k=='mess2'){
                             $(".questions h3").html(result.mess2);
                           }
                           else if((k!='time')&&(k!='points')){
                             list += '<li data-value='+k+'>'+v+'</li>';
                           }
                        });
                       $(".questions ul").html(list);
                      
                        start_time = result.time;
                        var current = "<?php echo date("H:i:s") ?>";
                        // console.log(current);
                        var differnce = (current.substr(0,2)-start_time.substr(0,2))*3600+(current.substr(3,2)-start_time.substr(3,2))*60+(current.substr(6,2)-start_time.substr(6,2));
                      differnce=parseInt(differnce);
                                            console.log(differnce);

                      // console.log(differnce+1);

                        var sub_hours = Math.floor(differnce / 3600);
                        var sub_minutes =Math.floor((differnce-sub_hours*3600)/60);
                        var sub_seconds =differnce-sub_hours*3600-sub_minutes*60;
                        var hour =01;
                        var min = 59;
                        var sec=00;
                        var total_hour=(hour*3600+min*60+sec)-differnce;
                       if(total_hour<0)
                       {
                         window.location.href="logout.php";

                       }

                      hour = Math.floor(total_hour / 3600);
                      min =Math.floor((total_hour-hour*3600)/60);
                       sec =total_hour-hour*3600-min*60;

                        var interval = setInterval(function() {

                            if (sec===0){
                              if(min===0)
                                {
                                  min=60;
                                  hour--;
                                }
                                min --;
                                sec =60;

                            } 
                                sec --;

                                if((hour==0)&&(min==0)&&(sec==0))
                                {
                                  window.location.href='logout.php'

                                }
                                $('.sec').text(sec);
                                $('.min').text(min);
                                $('.hour').text(hour);
                            if((min===1)&&(hour===0)){$('#time span').toggleClass("danger");}
                        }, 1000);
                        
                  }
            });
           
        });
        function submit() {
          if($('.questions li').hasClass('checked')){
            $('#runn').css('pointer-events','none');
             var attr = $(this).attr('class');
             var num = $(".questions h2").text();
             var ans = new Array;
             $('.questions li.checked').each(function(i, obj) {
                  ans[i]=$(this).text();
              });
             console.log(JSON.stringify(ans));
             var dataString ="num="+num+"&ans="+JSON.stringify(ans);
             $.ajax({
                  url: "compiler/output.php", 
                  data:dataString,
                  type:'POST',
                  success: function(result){
                           window.location.assign('que.php');         

                     // if(result==='go'){
                     //    $('.result').html('<span class="right">correct</span>');
                     //      window.location.assign('que.php');         
                     //   }
                     //  if(result === 'stop'){
                     //    $('.result').html('<span class="wrong">Incorrect</span>');
                     //      window.location.assign('que.php');         
                     //  }
                  }
              }); 
          }
          else{
            alert('select from the given options to procced further');
          }
        }
        function next(){
            $('#runn').css('pointer-events','none');
            var retVal = confirm("Do you want to Skip This Ques.?");
               var num = $(".questions h2").text();
               var dataString="num="+num;
               if( retVal == true ){
                  $.ajax({
                        url: "next.php", 
                        type: 'POST',
                        data:dataString,
                        success: function(result){
                            console.log(result);
                            if(result){
                              window.location.assign("que.php");
                            }
                            else{
                            }
                          }
                   });
               }
               else{
                  $('#runn').css('pointer-events','initial');                
               }
        }

        function hint(){
            $('#hint').css('pointer-events','none');
            var retVal = confirm("Are you sure want to take hint for This Ques.?");
               var num = $(".questions h2").text();
               var dataString="num="+num;
               if( retVal == true ){
                  $.ajax({
                        url: "hint.php", 
                        type: 'POST',
                        data:dataString,
                        success: function(result){
                            console.log(result);
                            if(result){
                               $('#hintt').html('<h3 style="color:green">'+result+'</p>');
                            }
                            else{
                            }
                          }
                   });
               }
               else{
                  $('#runn').css('pointer-events','initial');                
               }
        }
    </script>
</head>
<body>
    <header>
        <div style="display: flex;" class="container">
                <h1 style="width: 70%">Crypto 17</h1>
            <a href="leader_board.php">Leader Board</a>
        </div>
    </header>
    <main>
        <div class="top">
          <div id="time">
            <strong>Time left</strong>
            <span class="hour">00</span>:<span class="min">00</span><span>:</span><span class="sec">00</span>
            <p>Hour &nbsp;&nbsp; Minutes &nbsp;&nbsp; Seconds</p>
          </div>
          <a id="logout" href="logout.php">LOG OUT</a>
        </div>
        <div class="container questions">
                <span>Question No.:</span><h2 style="display: inline-block;"></h2>
                <h3>Question.:</h3>
                <div id="hintt">
                   <p style="color: red">do not refresh page after taking hint</p>
                   <input id="hint" type="button" value="Hint" onclick="hint();"/>
                </div>
                <img src="">
                <ul>
                </ul>
        </div>
        <div id="on_click">
          <input id="runn" type="button" value="Submit" onclick="submit();"/>
          <input id="runn1" type="button" value="Next" onclick="next();"/>
        </div>
        <ul id="skipped">
            <span>Skipped Questions:</span>
            <?php
               if($skip[0]){
                  echo'<li><a href="que.php?skip='.$skip[0].'">Ques.'.$skip[0].'</a></li>'; 
               }
               if($skip[1]){                
                  echo'<li><a href="que.php?skip='.$skip[1].'">Ques.'.$skip[1].'</a></li>'; 
               }
             ?>
       </ul>
        <div class="result">
          
        </div>
    </main>
</body>
<script type="text/javascript">

</script>
</html>
