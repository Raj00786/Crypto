<?php include 'database.php';?>
<?php session_start(); ?>
<?php
  
  $name  =  $_SESSION['name'];
  $num = $_POST['num'];

$user_query ="SELECT * FROM leader WHERE name ='$name'";
$user_result = mysqli_query($conn,$user_query); 
$user= mysqli_fetch_assoc($user_result);
$hint_num = $user['hint'];
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

if($counter==1){
	$ques_query ="SELECT * FROM questions WHERE id = '$num'";
	$ques_result = mysqli_query($conn,$ques_query); 
	$question= mysqli_fetch_assoc($ques_result);    
	$hint = $question['hint'];
	echo $hint;
	die();
}


$ques_query ="SELECT * FROM questions WHERE id = '$num'";
$ques_result = mysqli_query($conn,$ques_query); 
$question= mysqli_fetch_assoc($ques_result);    

$marks = $question['marks'];
$hint = $question['hint'];

$hint_num = $hint_num.','.$num;
$hint_query ="UPDATE leader SET hint ='$hint_num'  WHERE name ='$name'";
$hint_result = mysqli_query($conn,$hint_query); 
mysqli_fetch_assoc($hint_result);

echo $hint;