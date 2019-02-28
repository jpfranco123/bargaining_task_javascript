<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

$otherOnRoom = lookUp("subjects","ppnr=$partner and trial=$trial","ppnr");

if ($otherOnRoom==$partner){
  echo 1;
} else {
  echo 0;
}

?>
