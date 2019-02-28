<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

//echo updateTableOne("trialInfo","ppnr1=$ppnr and trial=$trial","videoSaved","1");

updateTableOne("trialInfo","ppnr1=$ppnr and trial=$trial","videoSaved","1");



?>
