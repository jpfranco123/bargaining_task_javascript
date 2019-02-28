<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
  $ppnr=$koek[0];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");
  $partner=findPartner($ppnr,$trial);

  $sValue=lookUp("subjects","ppnr='$ppnr'","sValue");

  //$sValue2=lookUp("subjects","ppnr='$partner'","sValue");
  $prevSvalue2 = $_REQUEST["v2"];
  $sValue2=lookUp("subjects","ppnr='$partner' and trial='$trial'","sValue");
  if ($sValue2 == "") {
    $sValue2 = $prevSvalue2;
  }

  $timeSlider = $_REQUEST["v"];

  insertRecord("sliderLog","ppnr1, ppnr2, time, sValue1, sValue2,trial","\"$ppnr\", \"$partner\", \"$timeSlider\", \"$sValue\", \"$sValue2\", \"$trial\"");



  echo $sValue;

?>
