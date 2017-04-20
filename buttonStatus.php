<?php
//$status = file_get_contents("buttonStatus.txt");
//echo $status;


 $dbconn = pg_connect("host=ec2-54-243-107-66.compute-1.amazonaws.com dbname=publishing user=penqubzduicfyj password=b56764297b8becbbf73a2f8bdeaeb44a04469643cf87bb28150d8b111e95589d" dbname=d5ia4h1qdpcnbi)
    or die('Could not connect: ' . pg_last_error());
 
//mysqli_select_db("smartswitch", $con);

$status = "SELECT on_off FROM lightStatus ORDER BY id desc LIMIT 1" ;//write here the value from which we need to print ";
$result = pg_query($status) or die('Query failed: ' . pg_last_error());
$data = pg_free_result($result);
if (!empty($data)) {
    echo "<table>\n";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

} else {
    echo "0 results";
}

pg_close($dbconn);
?>
