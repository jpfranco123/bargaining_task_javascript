<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

$timeStartPayoff = $_REQUEST["v"];


updateTableOne("trialInfo"," ppnr1='$ppnr' AND trial='$trial' ","timeStartedPayoff","$timeStartPayoff");

?>
