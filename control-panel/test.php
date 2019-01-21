<?php
include_once(dirname(__FILE__) . '/../class/include.php');

//Create
$ACTIVITY = new Activities(NULL);
$activities = $ACTIVITY->all();

foreach ($activities as $activity) {
    
    echo "<td>" . $activity['id'] ."----".$activity['title'] ."----".$activity['short_description']."----".$activity['description']. "</td><br/>\n";
//     echo $value['short_description']."<br />\n";
//      echo $value['description']."<br />\n";
    // echo"<td>".$value[title]."</td>";
//    echo"<td>".$value[short_description]."</td>";
//    echo"<td>".$value[description]."</td>";
}
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
// put your code here
?>
    </body>
</html>
