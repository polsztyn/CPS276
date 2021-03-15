<?php

$output = "";
$debug = "";
$error = "";
$fileHREF = "";

/*if(count($_POST) > 0){*/
if(isset($_POST['submit'])){
    require_once 'directories.php';
    $myDir = new directories();
    $myDir->createDirectoryAndFile();
    $debug =$myDir->getDebug();
    $error = $myDir->getError();
    $fileURL = $myDir->getFileURL();

    if ($fileURL!="") {
        $fileHREF = "<a href=\"".$fileURL."\">".$fileURL."</a>";
    }
    else {
        $fileHREF = "";
    }
}





$aLink = <<<HTML
<a href="http://www.facebook.com">Another Link</a>
HTML;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>File and Directory Assignment</title> 

  </head>
<body>
<main class="container">
<h1>File and Directory Assignment </h1>

<?php echo ($fileHREF); ?>
<p>Enter a folder name and contents of a file.  Folder name should contain alpha numeric characters only.</p>
<?php echo ("<p>".$error."</p>"); ?>
<form action="directoriesAndFiles.php" method="post">
<div class="form-group">
        <label for="directoryName">Folder Name</label>
        <input type="text" class="form-control" name="directoryName" id="directoryName" value="">
</div>

<div class="form-group">
        <label for="fileContents">File Content</label>
        <textarea name="fileContents" type="password" class="form-control" id="fileContents" rows="4" cols="50"><?php echo $output?></textarea>
</div>

<div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" id="s1" value="Submit" >
</div>  

<!--<div class="form-group">
        <label for="debugArea">debugArea</label>
        <textarea name="debugArea"  class="form-control" id="debugArea" rows="4" cols="50"><?php echo $debug ?></textarea>
 
      </div> -->

</form>
</main>
</body>
</html>