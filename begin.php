<?php
include "commonSlider.inc";
////check for required fields
if (!isset($_REQUEST['ppnummer'])) {
	echo "<html><body>No number!</body></html>";
	exit;
}
else {
	$pp2=$_REQUEST['ppnummer'];
}

if (lookUp("subjects","ppnr='$pp2'","ppnr")<>""){
	echo "<html><body>Participant is already logged in.</body></html>";
	exit();
}

setcookie("theCookie", $pp2);

$initialSliderValue=startValue($pp2,1);

$IPA=$_SERVER['REMOTE_ADDR'];

insertRecord("subjects","ppnr,sValue,session,blocked,trial,started,subID","\"$pp2\",\"$initialSliderValue\",\"$session\",'0','1','0','$IPA' ");
//insertRecord("subjects","ppnr,sValue,session,blocked,trial,started,subID","\"$pp2\",\"$initialSliderValue\",\"$session\",'0','1','0','$IPA' ");

insertRecord("paymentSession","ppnr"," \"$pp2\" ");

$begininstructies="Location: instructions1.php";
header($begininstructies);
exit();

?>
