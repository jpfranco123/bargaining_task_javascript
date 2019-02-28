<?php
include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

$otherSaved = lookUp("subjects","ppnr=$partner and trial=$trial","started");
$iSaved = lookUp("subjects","ppnr=$ppnr and trial=$trial","started");


$bothSaved= $otherSaved + $iSaved;
echo $bothSaved;

 ?>
