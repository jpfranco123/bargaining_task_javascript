<?php
include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

//updateTableOne("subjects"," ppnr='$ppnr' AND trial='$trial' ","timeBothStartedVideo",$timeBothVideo);

$otherStartedTime = lookUp("subjects","ppnr='$partner' and trial='$trial'","timeBothStartedVideo");
$iStartedTime = lookUp("subjects","ppnr='$ppnr' and trial='$trial'","timeBothStartedVideo");

$otherStartedTimeInt=intval($otherStartedTime);
$iStartedTimeInt=intval($iStartedTime);

$otherBigger=$otherStartedTimeInt-$iStartedTimeInt;

if ($otherStartedTime=="" || $otherStartedTime==0){
  echo 0;
} else{
  //$bothStartedTime= max($otherStartedTime,$iStartedTime);
  //echo $bothStartedTime;
  if($otherBigger>0){
    $bothStartedTime=$otherStartedTimeInt;
  } else {
    $bothStartedTime=$iStartedTimeInt;
  }
  echo $bothStartedTime;
}


 ?>
