<?php include 'database.php';?>
<?php session_start(); ?>
<?php
 $number = (int) $_GET['n'];
 if($number==1){
  $_SESSION['score']=0;
 }
 // echo $number;
 $sql = "SELECT * FROM questions WHERE question_number = $number";
 $result=$conn->query($sql);
 $question = $result->fetch_assoc();
 // print_r($question);
 // echo $question['text'];


 $sql = "SELECT * FROM choices WHERE question_number = $number";
 $choices=$conn->query($sql);

 $query = "SELECT * FROM questions";
 $results = $conn->query($query);
 $total = $results->num_rows;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Quizzer</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="container">
                <h1>PHP Quizzer</h1>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="current">Question <?php echo $question['question_number']; ?> Out Of <?php echo $total; ?>
                </div>
                <p class="question"><?php echo $question['text']; ?></p>
                <form action="process.php" method="post">
                    <ul class="choices">
                      <?php while($row = $choices->fetch_assoc()){ ?>
                       <li><input type="radio" name="choices" value="<?php echo $row['id']?>"><?php echo $row['text']; ?>
                      <?php }?>
                    </ul>
                    <input type="submit" value="submit"/>
                    <input type="hidden" name="number" value="<?php echo $number; ?>">
                </form>
            </div>
        </main>
    </body>
</html>