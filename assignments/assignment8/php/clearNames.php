<?php
require_once '../classes/Pdo_methods.php';



/* GET A PDO OBJECT */
$pdo = new PdoMethods();

/* CONSTRUCT OUR SQL AND BIND OUR VARIABLES */
$sql = "TRUNCATE TABLE names";

/* EXECUTE OUR INSERT STATEMENT */
$records = $pdo->otherNotBinded($sql);

if ($records === "error") {
    $response = (object) ['masterstatus' => 'error', 'msg'=>'Could not delete records from database.'];
    echo json_encode($response);
}
else {
    $response = (object) ['masterstatus' => 'success', 'msg'=>"All names were deleted."];
    echo json_encode($response);
}

/*
$response = (object) ['masterstatus' => 'success', 'msg'=>$name];
echo json_encode($response);
*/

?>