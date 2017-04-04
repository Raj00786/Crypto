<?php include '../database.php';?>
<?php session_start(); ?>
<?php
    $num = $_POST['num'];
    $ans = $_POST["ans"];
    $name = $_SESSION['name'];

    $correct_query ="SELECT * FROM choices WHERE question_number = $num AND is_correct = 1";
    $correct = mysqli_query($conn,$correct_query); 
    while($row = mysqli_fetch_assoc($correct)){
         $json[] = $row['text'];
    }

    $ques_query ="SELECT * FROM questions WHERE id = '$num'";
    $ques_result = mysqli_query($conn,$ques_query); 
    $question= mysqli_fetch_assoc($ques_result);   
    $marks = $question['marks'];

    $ans  = json_decode(stripslashes($ans));
    sort($ans);
    sort($json);
//skip ques
    $select_query ="SELECT * FROM leader WHERE name='$name'";  
    $select_result = mysqli_query($conn,$select_query); 
    $select  = mysqli_fetch_assoc($select_result);
    $skip = $select['skip'];
    $pieces = explode(",", $skip);
    $skip1 = $pieces[0]; 
    $skip2 = $pieces[1]; 

    $phint = $select['phint'];
    
    $hint_num = $select['hint'];
       $counter=0;
    $hint_num1=explode(',',$hint_num);
    for($i=0;$i<sizeof($hint_num1);$i++)
    {
      if($num==$hint_num1[$i])
      {
        $counter=1;
        break;
      }
    }



  if(($num==$skip1)||($num==$skip2)){   
    if($num==$skip1){
      $skip1='';
      $correct_query ="SELECT * FROM choices WHERE question_number = '$skip1' AND is_correct = 1";
    }
    else if($num==$skip2){
      $skip2='';
      $correct_query ="SELECT * FROM choices WHERE question_number = '$skip2' AND is_correct = 1";
    }
    if($ans===$json) {
      
      if($counter==1){
        $phint = $phint+($marks*0.6);

        $points_query ="UPDATE leader SET phint ='$phint'  WHERE name ='$name'";
        $points_result = mysqli_query($conn,$points_query); 
        mysqli_fetch_assoc($points_result);
      }


      $time=date("H:i:s"); 
      $insert_query = "UPDATE leader SET end_time='$time' WHERE name ='$name'";      
      mysqli_query($conn,$insert_query); 

      $points_query ="UPDATE leader SET score = score+marks WHERE name ='$name'";
      mysqli_query($conn,$points_query); 
      echo "go";
    }
    else
    {
      echo "stop";
    }
    $pieces = $skip1.','.$skip2;
    $skip_query ="UPDATE leader SET skip = '$pieces' WHERE name ='$name'";
    mysqli_query($conn,$skip_query);    
    die();
  }
//skip ques end

    if($ans===$json) {

      if($counter==1){
        $phint = $phint+($marks*0.6);

        $points_query ="UPDATE leader SET phint ='$phint'  WHERE name ='$name'";
        $points_result = mysqli_query($conn,$points_query); 
        mysqli_fetch_assoc($points_result);
      }

      $time=date("H:i:s"); 
      $insert_query = "UPDATE leader SET end_time='$time' WHERE name ='$name'";      
      mysqli_query($conn,$insert_query); 
      
      $points_query ="UPDATE leader SET score = score+'$marks' WHERE name ='$name'";
      mysqli_query($conn,$points_query); 
      $update_query = "UPDATE leader SET points = points+1 WHERE name ='$name'";
      mysqli_query($conn,$update_query); 
      echo "go";
    }
    else
    {
      $update_query = "UPDATE leader SET points = points+1 WHERE name ='$name'";
      mysqli_query($conn,$update_query); 
      echo "stop";
    }

    die();

?>
