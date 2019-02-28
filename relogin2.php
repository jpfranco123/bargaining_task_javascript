<?php
include "commonSlider.inc";
//check for required fields
if (!isset($_REQUEST['reloginpp'])) {
	//no subjectnumber filled in
	header("Location: begin.html");
	echo "<html><body>No Subject id.</body></html>";
	exit;
}
else {
	$ppnummer=$_REQUEST['reloginpp'];
}

if (lookUp("subjects","ppnr='$ppnummer'","ppnr")==""){
	//apparently no relogin, get back
	echo "<html><body>Subject id does not exist!</body></html>";
	exit();
}
else {
	writecookie("theCookie",$ppnummer);
}
//send to the right page
$currentpage=lookUp("subjects","ppnr='$ppnummer'","currentpage");
header("Location: ".$currentpage);
// voor geval iets misgaat
echo "ppnr: ".$ppnummer."";
?>
