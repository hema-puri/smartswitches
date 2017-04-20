<?php
//$status = file_get_contents("buttonStatus.txt");
//echo $status;


$con = new mysqli("localhost","root","root","smartswitch");

if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
 
//mysqli_select_db("smartswitch", $con);

$status = "
SELECT on_off FROM lightStatus ORDER BY id desc LIMIT 1 " ;//write here the value from which we need to print ";
$bla = $con->query($status);
if ($bla->num_rows > 0) {
    // output data of each row
    while($row = $bla>fetch_assoc()) {
        echo $row["on_off"];
    }
} else {
    echo "0 results";
}
echo $bla;
$con->close ();
?>
