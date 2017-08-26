<?
####################################################################
# Do we need a Licence ? I think No, feel free to modify this file #
# as long as it is free for all                                    #
####################################################################
//phpinfo();

// configure your database here
$host     = "192.168.178.63";
$database = "fhem";
$user     = "fhem";
$password = "geheim";

################################################################################
# dont change anything below this line, only if you know what you are doing ;) #
################################################################################
$con = mysqli_connect($host, $user, $password, $database);

$device = "Terrarium.Sensor2";
$output = "";
$strSQL = "SELECT * FROM current WHERE DEVICE = '" . $device . "' AND (READING = 'temperature' OR READING = 'dewpoint' OR READING = 'humidity')";
$query = mysqli_query($con, $strSQL);
while($result = mysqli_fetch_array($query)){
	if($output != "") $output .= ", ";
	$output .= '"'.$result['READING'].'" : "'.htmlspecialchars($result['VALUE']).'"';
}
echo "{\"" . $device . "\":{" . $output . "}";

mysqli_close($con);
?>
