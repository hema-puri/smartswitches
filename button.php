<?php
//$file = "buttonStatus.txt";
//$handle = fopen($file,'w+');

$dbconn = pg_connect("host=ec2-54-243-107-66.compute-1.amazonaws.com dbname=publishing user=penqubzduicfyj password=b56764297b8becbbf73a2f8bdeaeb44a04469643cf87bb28150d8b111e95589d" dbname=d5ia4h1qdpcnbi)
    or die('Could not connect: ' . pg_last_error());


//mysqli_select_db("smartswitch", $con);
if (isset($_POST['on']))
{

$sql = "INSERT INTO lightStatus (on_off) VALUES ('ON');";
$dbconn->pg_query($sql);
//fwrite($handle,$onstring);
//fclose($handle);
print "
<html>
<body>
<title>Smart Switches</title>
<style type=text/css>
h1{
	padding-left: 300px;
}
h2{
	position: absolute;
	top: 100px;
	left: 450px;
}
</style>
<h1>Internet of Things Implementation</h2>
<h2>The Device has been Turned ON </h2>
</body>
</html>
";
}
else if(isset($_POST['off']))
{
$offstring = "OFF";
$sql = "INSERT INTO lightStatus (on_off)
VALUES ('OFF');";
$dbconn->pg_query ($sql);
//fwrite($handle, $offstring);
//fclose($handle);
print "
<html>
<body>
<title>Smart Switches</title>
<style type=text/css>
h1{
	padding-left: 300px;
}
h2{
	position: absolute;
	top: 100px;
	left: 450px;
}
</style>
<h1>Internet of Things Implementation</h2>
<h2>The Device has been Turned OFF </h2>
</body>
</html>
";
}

pg_close($dbconn);

?>
