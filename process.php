<?php include 'database.php';?>
<?php session_start(); ?>
<?php
    
  $points = 0;
  $time = "00:00:00";
mysqli_set_charset($conn, 'utf8');  $name  =  $_SESSION['name'];
  $user_query ="SELECT * FROM leader WHERE name ='$name'";
  $user_result = mysqli_query($conn,$user_query); 
  $user= mysqli_fetch_assoc($user_result);
 
  if(!$user){
    $id=$_SESSION["id"];
    $insert_query = "INSERT INTO leader (name) VALUES ('$name')";      
    mysqli_query($conn,$insert_query);

    $sql="UPDATE `leader` SET techid='$id' WHERE name='$name'";    
    mysqli_query($conn,$sql); 
  }
  else{
    $select_query ="SELECT * FROM leader WHERE name='$name'";  
    $select_result = mysqli_query($conn,$select_query); 
    $select  = mysqli_fetch_assoc($select_result);
    $points = $select['points'];
    $score = $select['score'];
    $time = $select['start_time'];
  }
   
  if($score=='8'){
    echo "done";
    die();
  }
//skip ques
  if($_POST['skip']){   
    $num = $_POST['skip'];
    $select_query ="SELECT * FROM leader WHERE name='$name'";  
    $select_result = mysqli_query($conn,$select_query); 
    $select  = mysqli_fetch_assoc($select_result);
    $skip = $select['skip'];
    $pieces = explode(",", $skip);
    $skip1 = $pieces[0]; 
    $skip2 = $pieces[1]; 
    if($num==$skip1){
      $points=$skip1-1;
    }
    else if($num==$skip2){
      $points=$skip2-1;
    }
  }
  else{
      if($points=='8'){
        echo "done";
        die();
      }
  }
//skip ques end

  
  $ques_query ="SELECT * FROM questions WHERE id = $points+1";
	$ques_result = mysqli_query($conn,$ques_query); 
	$question= mysqli_fetch_assoc($ques_result);    

  $choice_query ="SELECT * FROM choices WHERE question_number = $points+1";
  $choices = mysqli_query($conn,$choice_query); 
 
  $choices_list['time'] =  $time; 
  $choices_list['points'] =  $points; 


  $i=1;
  $choices_list["mess1"] = $points+1;  
  $choices_list["hint"] = $question['hint'];  
  $choices_list["mess2"] = $question['text'];
  $choices_list["img"] = $question['img'];

  while($ques_text = mysqli_fetch_assoc($choices)){
      $choices_list[$i] = $ques_text['text']; 
      $i++;
  }
  echo json_encode($choices_list);

?>