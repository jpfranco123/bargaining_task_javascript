<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
	$ppnr=$koek[0];

  $sValue=lookUp("subjects","ppnr='$ppnr'","sValue");

  $timeStartScript = $_REQUEST["v"];
  $timeStartVideo = $_REQUEST["v2"];
  $endTime= $_REQUEST["v3"];
  $agreement= $_REQUEST["v4"];
  $bothStartedTime = $_REQUEST["v5"];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");
  $partner=findPartner($ppnr,$trial);

  $thePie=pieSize($ppnr,$trial);

  if ($agreement==1) {
    if (knowPie($ppnr,$trial)) {
      $payoff = $thePie - $sValue;
    } else {
      $payoff = $sValue;
    }
  } else {
    //this happens when no agreement and when there is a mistake
    $payoff=0;
  }


  insertRecord("trialInfo","ppnr1, ppnr2, trial, timeStartScript, timeStartVideo,endTime,sValue,agreement,pie,payoff,videoSaved,timeStartedBoth","\"$ppnr\", \"$partner\", \"$trial\", \"$timeStartScript\", \"$timeStartVideo\", \"$endTime\", \"$sValue\", \"$agreement\", \"$thePie\", \"$payoff\",'0',\"$bothStartedTime\" ");

?>
