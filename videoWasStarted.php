<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

//$startedTime = $_REQUEST["v"];

//echo updateTableOne("trialInfo","ppnr1=$ppnr and trial=$trial","videoSaved","1");
//updateTableOne("subjects"," ppnr='$ppnr' AND trial='$trial' ","startedTime",$startedTime);
updateTableOne("subjects"," ppnr='$ppnr' AND trial='$trial' ","started","1");

//updateTableOne("trialInfo","ppnr1=$ppnr and trial=$trial","videoStarted","1");



?>
