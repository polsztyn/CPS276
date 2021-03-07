<?php
$output = "";
$debug = "";
if(count($_POST) > 0){
    require_once 'addNameProc.php';
    $addName = new AddNamesProc();
    $output = $addName->addClearNames();
    $debug =$addName->debug;
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

    <title>Name List</title>

  </head>
  <body>
    <main class="container">
      <h1>Add Names</h1>
       
      
      <form action="nameList.php" method="post">
      
      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="addName" id="s1" value="Add Name" >
        <input type="submit" class="btn btn-primary" name="clearNames" id="s2" value="Clear Names" >
      </div>     
      
      
      <div class="form-group">
        <label for="fullName">Enter Name</label>
        <input type="text" class="form-control" name="fullName" id="fullName" value="">
      </div>

     
      <div class="form-group">
        <label for="listOfNames">List of Names</label>
        <textarea name="listOfNames" type="password" class="form-control" id="listOfNames" rows="4" cols="50"><?php echo $output?></textarea>
      </div>

      <!--
      <div class="form-group">
        <label for="debugArea">debugArea</label>
        <textarea name="debugArea"  class="form-control" id="debugArea" rows="4" cols="50"><?php echo $debug?></textarea>
 
      </div>
      -->
      

      </form>
    </main>