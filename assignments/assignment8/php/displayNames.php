<?php
require_once '../classes/Pdo_methods.php';



/* GET A PDO OBJECT */
$pdo = new PdoMethods();

/* CONSTRUCT OUR SQL AND BIND OUR VARIABLES */
$sql = "select * from names order by name";

/* EXECUTE OUR SELECT STATEMENT */
$records = $pdo->selectNotBinded($sql);

if ($records === "error") {
    $response = (object) ['masterstatus' => 'error', 'msg'=>'Could not select records from database.'];
    echo json_encode($response);
}
else {
    $response = (object) ['masterstatus' => 'success', 'names'=> createList($records)];
    //$response = (object) ['masterstatus' => 'success', 'names'=> '<p>hello world</p>'];
    echo json_encode($response);
}

/*
$response = (object) ['masterstatus' => 'success', 'msg'=>$name];
echo json_encode($response);
*/

function createList($records){
    $list = "";
    foreach ($records as $row){


        $list .= "<p>{$row['name']}</p>";
    }
    return $list;
}

?>