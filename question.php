<?php session_start(); ?>
<?php include 'database.php'; ?>
<?php
//set question number
$number = (int) $_GET['n'];

//Get question
$query = "SELECT * FROM questions WHERE question_number = '$number'";
//Get result
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$question = $result->fetch_assoc();


//Get choices
$querys = "SELECT * FROM choices WHERE question_number = '$number'";
//Get results
$choices = $mysqli->query($querys) or die($mysqli->error.__LINE__);

$questions = $result->fetch_assoc();

//Get total question
$query = "SELECT * FROM questions";

//Get result
$results = $mysqli->query($query) or die($mysqli->error.__LINE__);
$total = $results->num_rows;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP QUIZZER</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <header>
      <div class="container">
        <h1>PHP QUIZZER</h1>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="current"><b>Question <?php echo $question['question_number']; ?> of <?php echo $total; ?></b></div>
        <p class="question">
          <?php echo $question['text']; ?>
        </p>
        <form action="process.php" method="post">
          <ul class="choices">
            <?php while ($row = $choices->fetch_assoc()):?>
              <li><input type="radio" name="choice" value="<?php echo $row['is_correct']; ?>"/><?php echo $row['text']; ?></li>
            <?php endwhile; ?>
          </ul>
          <input type="submit" name="" value="Submit">
          <input type="hidden" name="number" value="<?php echo $number; ?>">
        </form>
      </div>
    </main>
    <footer>
      <div class="container">
        copyright &copy; 2018, PHP Quizzer
      </div>
    </footer>
  </body>
</html>
