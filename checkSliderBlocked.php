<?php
  //Sets blocked=1 for me and checks the other participant
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
  $ppnr=$koek[0];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");
  $partner=findPartner($ppnr,$trial);


  $otherBlocked=lookUp("subjects","ppnr='$partner' AND trial='$trial'","blocked");

  echo $otherBlocked;

?>
