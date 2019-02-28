<?php

//carefull with the changes, is not used to check same value, but to upload slider1 value to database
//Carefull with the modifications, it is used as well when on the initialOffer

  include("commonSlider.inc");

//Checks the ppnr of the participant
/*
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
	}
else {
*/
	$koek=readcookie("theCookie");
	$ppnr=$koek[0];


  /*
	}
updateTableOne("ppnummers","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);
  */

  /*
  if ($ppnr % 2 == 0){
  	$partner=$ppnr-1;
  } else {
  	$partner=$ppnr+1;
  }
  */
  $trial=lookUp("subjects","ppnr='$ppnr'","trial");
  $partner=findPartner($ppnr,$trial);

  $valuePartner=lookUp("subjects","ppnr='$partner'","sValue");
  $value = $_REQUEST["v"];
  updateTableOne("subjects","ppnr='$ppnr'","sValue","$value");


  //ALL this is already done in javascript
  //TODO: Case when there is no partner!!!!
  /*
  if ($value==$valuePartner) {
      $Outcome = "Equal";
  } else {
      $Outcome = "Not Equal";
  }
  echo $Outcome;
  */



?>
