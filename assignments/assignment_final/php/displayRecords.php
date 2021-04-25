<?php

function initFormDisplay() {
    $debug="";
    $output="";

    require_once('classes/contactProcess.php');
    $contactProcess = new contactProcess();


    $deleteStatus = "";
    if(isset($_POST['delete'])){
        $deleteStatus = $contactProcess->deleteContacts();
    }
    else {
        $deleteStatus = "";
    }

    $output = $contactProcess->getContacts();

$form = <<<HTML

<main class="container">
       
      
      <form action="index.php?page=display" method="post">
      
      <div class="form-group">
        <input type="submit" class="btn btn-danger" name="delete" id="s1" value="Delete" >
      </div>     
      

     
      <div class="form-group">
        {$output}
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


    $result = [$deleteStatus,$form];
    return($result);
}

?>