<?php
//$status = file_get_contents("buttonStatus.txt");
//echo $status;


$con = new mysqli("localhost","root","root","smartswitch");

if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
 
//mysqli_select_db("smartswitch", $con);

$status = "SELECT on_off FROM lightStatus ORDERBY id desc LIMIT 1 //write here the value from which we need to print ";

echo $status;
?>