<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
	$ppnr=$koek[0];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");

  deleteRow("trialInfo","ppnr1='$ppnr' and trial='$trial'");
  //insertRecord("trialInfo","ppnr1, ppnr2, trial, timeStartScript, timeStartVideo,endTime,sValue,agreement,pie,payoff,videoSaved","\"$ppnr\", \"$partner\", \"$trial\", \"$timeStartScript\", \"$timeStartVideo\", \"$endTime\", \"$sValue\", \"$agreement\", \"$thePie\", \"$payoff\",'0' ");

?>
