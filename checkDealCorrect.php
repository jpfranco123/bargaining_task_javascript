<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
	$ppnr=$koek[0];
  $trial=lookUp("subjects","ppnr='$ppnr'","trial");
  $partner=findPartner($ppnr,$trial);

  $agreement1= lookUp("trialInfo","ppnr1='$ppnr' and trial='$trial'","agreement");
  $sValue1= lookUp("trialInfo","ppnr1='$ppnr' and trial='$trial'","sValue");

  $agreement2= lookUp("trialInfo","ppnr1='$partner' and trial='$trial'","agreement");
  $sValue2= lookUp("trialInfo","ppnr1='$partner' and trial='$trial'","sValue");

  //0: No deal
  //1: deal
  //2: Not found
  if ($agreement1==0 && $agreement2==0){
    $deal=1;
  } elseif ($agreement1==1 && $agreement2==1 && $sValue1==$sValue2) {
    $deal=1;
  } elseif ($agreement2=="") {
    $deal=2;
  } else{
    $deal=0;
  }

  echo $deal;
?>
