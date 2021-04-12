<?php
$output = "";
$debug1 = "debug it is";
if(count($_POST) > 0){
    require_once 'noteProc.php';
    $noteProc = new noteProc();
    $output = $noteProc->getNotes();
    $debug1 =$noteProc->debug;
    //$output = "Goodbye Word!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Display Notes</title>

</head>

<body>
<main class="container">
  <h1>Display Notes</h1>

  <a href="addNote.php">Add Note</a><br>  
  
  <form action="displayNotes.php" method="post">

  <div class="form-group">
    <label for="begDate">Beginning Date</label>
    <input type="date" class="form-control" id="begDate" name="begDate">
  </div>

  <div class="form-group">
    <label for="endDate">Ending Date</label>
    <input type="date" class="form-control" id="endDate" name="endDate"> 
  </div>   
  
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="getNotes" id="s1" value="Get Notes" >
  </div>     
  
  <?php echo $output ?>

  <!--
  <div class="form-group">
    <label for="debugArea">debugArea</label>
    <textarea name="debugArea"  class="form-control" id="debugArea" rows="4" cols="50"><?php echo $debug1?></textarea>

  </div>
  -->
  

  </form>
</main>
</body>
</html>