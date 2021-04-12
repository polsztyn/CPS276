<?php
$output = "<p></p>";
$debug = "debug init";
if(count($_POST) > 0){
    require_once 'noteProc.php';
    $noteProc = new noteProc();
    $output = $noteProc->addNote();
    $debug =$noteProc->debug;
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Add Note</title>

  </head>
  <body>
    <main class="container">
      <h1>Add Note</h1>

      <div class="form-group">
         <a href="displayNotes.php">Display Notes</a><br>  
      </div>
      
      <?php echo $output; ?>

      <form action="addNote.php" method="post">
      
      <div class="form-group">
        <label for="dateTime">Date and Time</label>
        <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
      </div>

     
      <div class="form-group">
        <label for="noteText">Note</label>
        <textarea name="noteText" type="password" class="form-control" id="noteText" rows="20" cols="50"></textarea>
      </div>
  
      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="addName" id="s1" value="Add Note" >
      </div>     
      
      <!--
      <div class="form-group">
        <label for="debugArea">debugArea</label>
        <textarea name="debugArea"  class="form-control" id="debugArea" rows="4" cols="50"><?php echo $debug?></textarea>
 
      </div>
      -->  
      

      </form>
    </main>
</body>