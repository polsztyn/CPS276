<?php
require './classes/Pdo_methods.php';

if (isset( $_POST["sendFile"])){
	processFile();
}
else {
	$output = "";
}

function processFile(){
	// I PUT THE FILE INTO A DIRECTORY NAMED FILES WHICH IS ALREADY ON THE SERVER AND HAS 777 FILE PERMISSIONS
	
	//I HAD TO MAKE $OUTPUT A GLOBAL VARIBLE SO IT COULD BE USED INSIDE AND OUTSIDE THIS FUNCTION
	global $output;
	
	//CHECK TO SEE IF A FILE WAS UPLOADED.  ERROR EQUALS 4 MEANS THERE WAS NO FILE UPLOADED
	if ($_FILES["file"]["error"] == 4){
		$output = "No file was uploaded. Make sure you choose a file to upload.";
	}

	/*MAKE SURE THE FILE SIZE IS LESS THAN 1000000 BYTES.  THE ERROR EQUALS ONE MEANS THE FILE WAS TOO BIG ACCORDING TO THE SETINGS IN
	post_max_size LOCATED IN THE PHP INI FILE.*/
	elseif($_FILES["file"]["size"] > 100000 || $_FILES["file"]["error"] == 1){
		$output = "The file is too large";
	}

	//CHECK TO MAKE SURE IT IS THE CORRECT FILE TYPE IN THIS CASE PDF
	elseif ($_FILES["file"]["type"] != "application/pdf" ) {

		$output = "<p>PDF files only, thanks!</p>";
	}

	//IF ALL GOES WELL MOVE FILE FROM TEMP LCOATION TO THE names DIRECTORY 
	elseif (!move_uploaded_file( $_FILES["file"]["tmp_name"], "./files/" . $_FILES["file"]["name"])){
			$output = "<p>Sorry, there was a problem uploading that file.</p>";
	}
	else {
		//IF ALL GOES WELL CALL DISPLAY THANKS METHOD	
        addFile();
		$output = "<p>File has been added</p>";
	}

}

function displayThanks() {

/*
NOTICE I USE THE POST SUPERGLOBAL ARRAY TO GET THE NAME AND NOT
THE FLES SUPERGLOBAL ARRAY.  ALL FILES USE $_FILES ALL TEXT ENTERIES USE $_POST
*/

return <<<HTML
	<h1>Thank You So Much!</h1>
	
	<p>Thanks  {$_POST['visitorName']} for uploading your file!</p>
	<p>Here's your file:</p>
	<p><img src="file/{$_FILES['file']['name']}" alt="FILE"></p>
HTML;
	
}

function addFile(){
	
    $pdo = new PdoMethods();

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "INSERT INTO files (file_id, file_path) VALUES (:fileID, :filePath)";

         
    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    /*
    $bindings = [
        [':fileID',$_POST['fname'],'str'],
        [':filePath',$_POST['lname'],'str']
    ];
    */

    $f=$_POST['fileName'];
    $fp = "files/{$_FILES['file']['name']}";
    $bindings = [
        [':fileID',$f,'str'],
        [':filePath',$fp,'str']
    ];


    /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
    $result = $pdo->otherBinded($sql, $bindings);

    /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
    if($result === 'error'){
        return 'There was an error adding the name';
    }
    else {
        return 'File has been added';
    }
}



?>
