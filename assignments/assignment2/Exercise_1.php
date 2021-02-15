<?php

$title = "Assignment 2 : Exercise 1";

function nestLoop($outerLoopBound,$innerLoopBound) {
    $listStr = "<ul> ";
    for ($i=1;$i<=$outerLoopBound;$i++) {
        $listStr .= "<li>" . (string)$i . "</li> ";
        $listStr .= "<ul>" ;
        for($j=1;$j<=$innerLoopBound;$j++) {
            $listStr .= "<li>" . (string)$j . "</li>";

        }
        $listStr .= "</ul>" ;  
    }
    $listStr .= "</ul>";
    return($listStr);
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
echo (nestLoop(4,5));
?>

</body>
</html>