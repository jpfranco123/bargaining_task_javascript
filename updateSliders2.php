<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);


$sValue=lookUp("subjects","ppnr='$partner' and trial='$trial'","sValue");
//$sValue=lookUp("subjects","ppnr='$partner'","sValue");
$prevSvalue2 = $_REQUEST["v2"];

if ($sValue == "") {
  $sValue = $prevSvalue2;
}


echo $sValue;


?>
