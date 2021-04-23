<?php

function initFormDisplay() {
    $debug="";
    $output="";
$form = <<<HTML

<main class="container">

      <h1>Add Names</h1>
       
      
      <form action="index.php?page=display" method="post">
      
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

HTML;


    $result = ["<p>You called initForm Display!!!!</p>",$form];
    return($result);
}

?>