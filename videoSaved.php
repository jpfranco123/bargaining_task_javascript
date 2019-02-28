<?php
include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

$otherSaved = lookUp("trialInfo","ppnr1=$partner and trial=$trial","videoSaved");
$iSaved = lookUp("trialInfo","ppnr1=$ppnr and trial=$trial","videoSaved");
$bothSaved= $otherSaved + $iSaved;
echo $bothSaved;

 ?>
