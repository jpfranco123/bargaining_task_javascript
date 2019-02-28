<?php
include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

$timeBothVideo=$_REQUEST["v"];
updateTableOne("subjects"," ppnr='$ppnr' AND trial='$trial' ","timeBothStartedVideo",$timeBothVideo);

 ?>
