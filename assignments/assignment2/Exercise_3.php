<?php

$title = "Assignment 3 : Exercise 3";

function writeTable($numRows,$numCols) {
    $tabStr = '<table border="1" >';
    for ($i=1;$i<=$numRows;$i++) {
        $tabStr .= "<tr>";
        for($j=1;$j<=$numCols;$j++) {
            $tabStr .= "<td> Row " . (string)$i . " Cell " . (string) $j . "</td>";       
        }
  
        $tabStr .= "</tr>";
    }
    $tabStr .= "</table>";
    return($tabStr);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo($title); ?></title>
</head>
<body>



<?php
echo (writeTable(15,5));
?>


</body>
</html>