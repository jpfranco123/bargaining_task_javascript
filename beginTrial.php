<?php

//You input the trial they are currently in: It erases data for the trial and goes to next trial.
include "commonSlider.inc";

if (!isset($_REQUEST['ppnr'])) {
	echo "<html><body>No ppnr!</body></html>";
	exit;
} elseif (!isset($_REQUEST['trial'])) {
	echo "<html><body>No trial!</body></html>";
	exit;
}
else {
	$ppnr=$_REQUEST['ppnr'];
	$trial=$_REQUEST['trial'];
}

if (lookUp("subjects","ppnr='$ppnr'","ppnr")==""){
	echo "<html><body>ppnr not found!</body></html>";
	exit();
}

setcookie("theCookie", $ppnr);
updateTableOne("subjects","ppnr='$ppnr'","trial","$trial");
deleteRow("trialInfo","ppnr1='$ppnr' and trial='$trial'");
header("Location: waitingPage.php");
exit();




?>
