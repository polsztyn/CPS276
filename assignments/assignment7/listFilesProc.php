<?php
require './classes/Pdo_methods.php';
$output = getFiles();


function getFiles(){
		
    /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
    $pdo = new PdoMethods();

    /* CREATE THE SQL */
    $sql = "SELECT * FROM files";

    //PROCESS THE SQL AND GET THE RESULTS
    $records = $pdo->selectNotBinded($sql);

    /* IF THERE WAS AN ERROR DISPLAY MESSAGE */
    if($records == 'error'){
        return 'There has been and error processing your request';
    }
    else {
        if(count($records) != 0){
          return(createList($records));
        }
        else {
            return 'no names found';
        }
    }
}

function createList($records){
    $list = '<ul>';
    foreach ($records as $row){
        /*$list .= "<li>Name: {$row['file_id']} {$row['file_path']} </li>";*/

        $list .= "<li><a target='_blank' href='{$row['file_path']}'>{$row['file_path']}</a></li>";
    }
    $list .= '</ul>';
    return $list;
}

?>  